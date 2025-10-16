<?php
header('Content-Type: text/plain; charset=UTF-8');

$path_base = $_SERVER['DOCUMENT_ROOT'];
include($path_base . '/painel_validacao/conexao.php'); // $con_apca

// ===== helpers
function norm_dev($s)
{
    $s = strtolower(trim((string)$s));
    if ($s === '' || $s === 'notfound' || $s === '0' || $s === 'n/a' || $s === 'na' || $s === 'none') return null;
    return $s;
}
function esc($c, $s)
{
    return mysqli_real_escape_string($c, (string)$s);
}

// ===== entrada
$id_evento = $_POST['qevento'] ?? '';
$id_evento = preg_replace('/\D+/', '', $id_evento); // só dígitos
if ($id_evento === '') {
    echo 'erro_evento';
    exit;
}

// 1) GARANTIA: todos os leitores com device_1 e device_2 válidos
$sql_chk = "
  SELECT 1 FROM ac_leitores
  WHERE
    ( NULLIF(TRIM(device_1),'') IS NULL
      OR LOWER(TRIM(device_1)) IN ('notfound','n/a','na','none','0')
    )
    OR
    ( NULLIF(TRIM(device_2),'') IS NULL
      OR LOWER(TRIM(device_2)) IN ('notfound','n/a','na','none','0')
    )
  LIMIT 1
";
$chk = mysqli_query($con_apca, $sql_chk);
if (!$chk) {
    echo 'erro_bd';
    exit;
}
if (mysqli_num_rows($chk) > 0) {
    echo 'erro_devices';
    exit;
}

// 2) MONTA PAYLOAD e envia leitores ao servidor remoto (OBRIGATÓRIO)
$rows = [];
$q = "SELECT id, ip, evento, device_1, device_2 FROM ac_leitores WHERE ativo='sim'";
$r = mysqli_query($con_apca, $q);
if (!$r) {
    echo 'erro_bd';
    exit;
}

$hoje  = date('Y-m-d');
$agora = date('H:i:s');

while ($o = mysqli_fetch_assoc($r)) {
    $d1 = norm_dev($o['device_1']);
    $d2 = norm_dev($o['device_2']);
    foreach ([$d1, $d2] as $dev) {
        if (!$dev) continue;
        $rows[] = [
            'leitor_id' => (int)$o['id'],
            'deviceid'  => $dev,
            'iplocal'   => $o['ip'],
            'idevento'  => $id_evento,
            'data'      => $hoje,
            'hora'      => $agora,
        ];
    }
}
$payload = ['leitores' => $rows];

$remoteUrl   = 'https://semax.eurekha.com.br/byface/recv_leitores.php';
$bearerToken = 'AP360_10101993'; // <<< ajuste

$ch = curl_init($remoteUrl);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_HTTPHEADER     => [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $bearerToken
    ],
    CURLOPT_POSTFIELDS     => json_encode($payload, JSON_UNESCAPED_UNICODE),
    CURLOPT_CONNECTTIMEOUT => 5,
    CURLOPT_TIMEOUT        => 15,
]);
$resp_envio = curl_exec($ch);
$err_envio  = curl_error($ch);
$code_envio = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
curl_close($ch);

// valida retorno do servidor
$ok_envio = false;
if (!$err_envio && $code_envio >= 200 && $code_envio < 300) {
    $js_env = json_decode($resp_envio, true);
    if (is_array($js_env) && !empty($js_env['ok'])) {
        $ok_envio = true;
    }
}
if (!$ok_envio) {
    echo 'erro_envio';
    exit;
}

// 3) PEGA DADOS DO EVENTO remoto
$url_ev = "https://semax.eurekha.com.br/byface/f_dadosev.php?ev=" . $id_evento;
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => $url_ev,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_CONNECTTIMEOUT => 5,
    CURLOPT_TIMEOUT => 10,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
]);
$response = curl_exec($curl);
$err_ev   = curl_error($curl);
$code_ev  = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
curl_close($curl);

if ($err_ev || $code_ev < 200 || $code_ev >= 300) {
    echo 'erro_evento';
    exit;
}

$dados      = json_decode($response, true);
$ev_idsis   = isset($dados['ev_idsis']) ? intval($dados['ev_idsis']) : 0;
$ev_nome    = $dados['ev_nome']    ?? '';
$ev_dataini = $dados['ev_dataini'] ?? '';

if ($ev_idsis <= 0 || $ev_nome === '') {
    echo 'erro_evento';
    exit;
}

// 4) Atualiza tabela local do evento e retorna NOME (sucesso)
$sql_ev = "
  UPDATE ac_evento
     SET idsis = '" . esc($con_apca, $ev_idsis) . "',
         nome = '" . esc($con_apca, $ev_nome) . "',
         data_ini = '" . esc($con_apca, $ev_dataini) . "'
   WHERE id = 1
   LIMIT 1
";
$ok_upd = mysqli_query($con_apca, $sql_ev);
if (!$ok_upd) {
    echo 'erro_bd';
    exit;
}

// SUCESSO: retorna só o nome como antes
echo $ev_nome;
