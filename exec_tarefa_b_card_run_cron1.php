<?php

$path_base = 'c:/xampp/htdocs/';

// conecta ao bando de dados
include($path_base.'/ap_controleacesso/bd.php');

// functions intelbras
include($path_base.'/ap_controleacesso/ibras_functions.php');

$today_data = date("Y-m-d");
$today_hora = date("H:i:s");

// dados do leitor
$le_us = "admin";
$le_pw = "10101993@1993";

// para ip manual
//$le_ip = "192.168.1.108";
//$le_us = "admin";
//$le_pw = "10101993@1993";

$tstamp_ini = time();
$qlim = 10;

//$deleta_users = ibras_dellusers($le_ip,$le_us,$le_pw);
//exit;

// pega tarefas b
$sql_le = " SELECT `ac_tarefas_b`.`id`, `ac_leitores`.`ip`, `ac_tarefas_b`.`leitor`, `ac_tarefas_b`.`qids`, `ac_tarefas_b`.`portaria`, `ac_tarefas_b`.`linha_inicial`, `ac_tarefas_b`.`limit_inicial`, `ac_tarefas_b`.`limit_itens`, `ac_tarefas_b`.`u_exec` FROM `ac_tarefas_b` INNER JOIN `ac_leitores` ON `ac_tarefas_b`.`leitor` = `ac_leitores`.`id`  WHERE `ac_tarefas_b`.`u_exec` = 'sim' AND `ac_tarefas_b`.`f_exec` = 'nao' AND `ac_tarefas_b`.`qids` != '' AND `ac_tarefas_b`.`leitor` = '1' ORDER BY `ac_tarefas_b`.`id` ASC limit 0,$qlim ";
$exe_le = mysqli_query($con_ac, $sql_le);
$tot_le = mysqli_num_rows($exe_le);

if ($tot_le == 0) {
echo "Nenhuma Tarefa Encontrada.";
exit;
}

echo "\n";

$le = 0;
// lista todos as tarefas do servidor
while ($data_le=mysqli_fetch_array($exe_le)) {
$le++;

// dados da tarefa
$id_taf_b = $data_le['id'];
$leitor = $data_le['leitor'];
$portaria = $data_le['portaria'];
$linha_ini = $data_le['linha_inicial'];
$limit_ini = $data_le['limit_inicial'];
$limit_max = $data_le['limit_itens'];
$qids = $data_le['qids'];

$ip_leitor = $data_le['ip'];
$le_ip = $ip_leitor;

echo "id_taf $id_taf_b / le $leitor ";

$ar_ids_us = array();

// pega 10 usuarios nao cadastrados neste leitor
$sql_usle = " SELECT `id_server`, `tipo`, `foto64`, `qrcode`, `nfc` FROM `ac_users` WHERE `id_server` IN ($qids)  ";
$exe_usle = mysqli_query($con_ac, $sql_usle);
$tot_usle = mysqli_num_rows($exe_usle);

if ( $tot_usle > 0 ) {

$ar_usersfoto[$id_taf_b] = array();
$ar_userscard[$id_taf_b] = array();

$uk = 0;
while ($data_usle=mysqli_fetch_array($exe_usle)) {
$uk++;

// dados dos usuarios
$us_id = $data_usle['id_server'];
$us_tipo = $data_usle['tipo'];

$ar_ids_us[] = $us_id;

$imageData = $data_usle['foto64'];
$imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
$imageData = str_replace(' ', '+', $imageData);

$us_qrcode = $data_usle['qrcode'];
$us_nfc = $data_usle['nfc'];

if ($us_tipo == "foto") {
// INSERE FOTO
         $ar_usersfoto[$id_taf_b][] = array(
         "UserID" => $data_usle['id_server'],
         "PhotoData" => [$imageData]
         );
// INSERE CARD TBM
         $ar_userscard[$id_taf_b][] = array(
         "UserID" => $data_usle['id_server'],
         "CardNo" => $us_qrcode,
         "CardType" => 0,
         "CardStatus" => 0
         );
}

if ($us_tipo == "qr") {
         $ar_userscard[$id_taf_b][] = array(
         "UserID" => $data_usle['id_server'],
         "CardNo" => $us_qrcode,
         "CardType" => 0,
         "CardStatus" => 0
         );
}

//echo "aqui $us_id $us_nome <p>";

} // fim do while usuarios

echo " / ";
echo implode(",", $ar_ids_us);
echo " ";

//////// PARA FOTO
$ar_intfoto = $ar_usersfoto[$id_taf_b];
$qtd_foto = count($ar_intfoto);

if ($qtd_foto > 0) {

$insert_fotos = ibras_addface($le_ip, $le_us, $le_pw, $ar_intfoto);
$limp_fotos = preg_replace('/\s+/u', '', $insert_fotos);

echo " / RT_FT $limp_fotos";

if ($limp_fotos == "OK") {
// update na tarefa b
mysqli_query($con_ac, " UPDATE `ac_tarefas_b` SET `f_exec` = 'sim', `f_exec_erro` = 'nao', `f_exec_erro_cod` = '', `f_exec_erro_tstamp` = '0' WHERE `ac_tarefas_b`.`id` = '".$id_taf_b."' ");
} else {
$tstamp_a = time();
mysqli_query($con_ac, " UPDATE `ac_tarefas_b` SET `f_exec` = 'sim', `f_exec_erro` = 'sim', `f_exec_erro_cod` = '".$limp_fotos."', `f_exec_erro_tstamp` = '".$tstamp_a."' WHERE `ac_tarefas_b`.`id` = '".$id_taf_b."' ");
}

} else {
// se nao tem foto, coloca f_exec pra ok
mysqli_query($con_ac, " UPDATE `ac_tarefas_b` SET `f_exec` = 'sim', `f_exec_erro` = 'nao', `f_exec_erro_cod` = '', `f_exec_erro_tstamp` = '0' WHERE `ac_tarefas_b`.`id` = '".$id_taf_b."' ");

}

// PARA QR CODE
$ar_intcard = $ar_userscard[$id_taf_b];
$qtd_card = count($ar_intcard);

if ($qtd_card > 0) {

$insert_card = ibras_addcard($le_ip, $le_us, $le_pw, $ar_intcard);
$limp_card = preg_replace('/\s+/u', '', $insert_card);

echo " / RT_CR $limp_card";

if ($limp_card == "OK") {
// update na tarefa b
mysqli_query($con_ac, " UPDATE `ac_tarefas_b` SET `c_exec` = 'sim', `c_exec_erro` = 'nao', `c_exec_erro_cod` = '', `c_exec_erro_tstamp` = '0' WHERE `ac_tarefas_b`.`id` = '".$id_taf_b."' ");
} else {
$tstamp_b = time();
mysqli_query($con_ac, " UPDATE `ac_tarefas_b` SET `c_exec` = 'sim', `c_exec_erro` = 'sim', `c_exec_erro_cod` = '".$limp_card."', `c_exec_erro_tstamp` = '".$tstamp_b."' WHERE `ac_tarefas_b`.`id` = '".$id_taf_b."' ");
}

} else {
// se nao tem card, coloca c_exec pra ok
mysqli_query($con_ac, " UPDATE `ac_tarefas_b` SET `c_exec` = 'sim', `c_exec_erro` = 'nao', `c_exec_erro_cod` = '', `c_exec_erro_tstamp` = '0' WHERE `ac_tarefas_b`.`id` = '".$id_taf_b."' ");

}

echo "\n";

} // fim do if achou n o sincronizados


} // fim do while

$tstamp_fim = time();
$tstamp_dif = $tstamp_fim-$tstamp_ini;

echo "\n";
echo "T Ini $tstamp_ini \n";
echo "T Fim $tstamp_fim \n";
echo "T EXEC $tstamp_dif segundos \n";

$ips = ($qlim*10)/$tstamp_dif;
$ips = number_format($ips, 2, '.', '');

$ipm = ($ips*60);
$ipm = number_format($ipm, 2, '.', '');

$iph = ($ipm*60);
$iph = number_format($iph, 2, '.', '');

echo "SEG $ips  \n";
echo "MIN $ipm  \n";
echo "HOR $iph  \n";


?>
