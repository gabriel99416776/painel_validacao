<?php
header('Content-Type: text/plain; charset=UTF-8');

$path_base = 'c:/wamp64/www/';
include($path_base.'ap_controleacesso/bd.php');
include($path_base.'ap_controleacesso/ibras_functions.php');

$ip_leitor = $_POST['qip'] ?? '';
if (!filter_var($ip_leitor, FILTER_VALIDATE_IP)) {
    http_response_code(400);
    echo "ip_invalido";
    exit;
}

$le_us = "admin";
$le_pw = "10101993@1993";

// 1) Tenta limpar
$del = ibras_dellusers($ip_leitor, $le_us, $le_pw);

// 2) Tenta pegar MACs (se falhar, vai cair como notfound)
$macs = ibras_get_physical_addresses($ip_leitor, $le_us, $le_pw);

$dev1 = 'notfound';
$dev2 = 'notfound';
if (empty($macs['error'])) {
    $mac_eth0 = $macs['eth0']  ?? ($macs['en0']   ?? null);            // cabo
    $mac_wifi = $macs['eth2']  ?? ($macs['wlan0'] ?? ($macs['wifi0'] ?? null)); // wi-fi
    if ($mac_eth0) $dev1 = strtolower($mac_eth0);
    if ($mac_wifi) $dev2 = strtolower($mac_wifi);
    if (!$mac_eth0 && $mac_wifi) { $dev1 = $dev2; $dev2 = 'notfound'; }
}

// 3) Atualiza na tabela pelo IP
$dev1_sql = "'" . mysqli_real_escape_string($con_ac, $dev1) . "'";
$dev2_sql = "'" . mysqli_real_escape_string($con_ac, $dev2) . "'";
$ip_sql   = "'" . mysqli_real_escape_string($con_ac, $ip_leitor) . "'";
mysqli_query($con_ac, "
    UPDATE ac_leitores
       SET device_1={$dev1_sql}, device_2={$dev2_sql}
     WHERE ip={$ip_sql}
     LIMIT 1
");

// 4) Resposta clara
if (!$del['ok']) {
    // exemplos de errno: 7 (couldn't connect), 28 (timeout)
    echo "erro|offline=" . ($del['errno'] ?: 0) .
         "|http=" . $del['http_code'] .
         "|msg=" . ($del['error'] !== '' ? $del['error'] : 'falha na limpeza') .
         "|device_1={$dev1}|device_2={$dev2}";
} else {
    echo "OK|limpo=" . $del['body'] . "|device_1={$dev1}|device_2={$dev2}";
}
