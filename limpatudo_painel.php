<?php

$path_base = $_SERVER['DOCUMENT_ROOT'];

// conecta ao bando de dados
include($path_base . '/painel_validacao/conexao.php');

// limpa portarias
mysqli_query($con_apca, " DELETE FROM `ac_portarias` ") or die("Erro no banco de dados!");

// limpa tarefas a
mysqli_query($con_apca, " DELETE FROM `ac_tarefas_a` ") or die("Erro no banco de dados!");

// limpa tarefas b
mysqli_query($con_apca, " DELETE FROM `ac_tarefas_b` ") or die("Erro no banco de dados!");

// limpa tarefas l
mysqli_query($con_apca, " DELETE FROM `ac_tarefas_l` ") or die("Erro no banco de dados!");

// limpa usuarios
mysqli_query($con_apca, " DELETE FROM `ac_users` ") or die("Erro no banco de dados!");

// limpa usuarios para cancelar
mysqli_query($con_apca, " DELETE FROM `ac_users_can` ") or die("Erro no banco de dados!");

// limpa usuarios sync
mysqli_query($con_apca, " DELETE FROM `ac_user_sync` ") or die("Erro no banco de dados!");

//Limpar Validados
mysqli_query($con_apca, " DELETE FROM `ac_validados` ") or die("Erro no banco de dados!");

//Zera IDusers Do leitor 1
mysqli_query($con_apca, " UPDATE `ac_leitores` SET `u_idusers` = '0' WHERE `ac_leitores`.`id` = 1; ") or die("Erro no banco de dados!");

//Zera tstamp_uacesso Do leitor 1
mysqli_query($con_apca, " UPDATE `ac_leitores` SET `tstamp_uacesso` = '0' WHERE `ac_leitores`.`id` = 1;") or die("Erro no banco de dados!");

//Zera Exec_uacesso Do leitor 1
mysqli_query($con_apca, "UPDATE `ac_leitores` SET `exec_uacesso` = '0' WHERE `ac_leitores`.`id` = 1;") or die("Erro no banco de dados!");


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//Zera tstamp_uacesso Do leitor 2
mysqli_query($con_apca, " UPDATE `ac_leitores` SET `tstamp_uacesso` = '0' WHERE `ac_leitores`.`id` = 2;") or die("Erro no banco de dados!");

//Zera Exec_uacesso Do leitor 2
mysqli_query($con_apca, "UPDATE `ac_leitores` SET `exec_uacesso` = '0' WHERE `ac_leitores`.`id` = 2;") or die("Erro no banco de dados!");

//Zera IDusers Do leitor 2
mysqli_query($con_apca, "UPDATE `ac_leitores` SET `u_idusers` = '0' WHERE `ac_leitores`.`id` = 2;") or die("Erro no banco de dados!");

echo 'OK';
