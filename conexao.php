<?php
// Conexão com o banco de dados
$hostname = "localhost";
$bancodedados = "ap_controleacesso";
$usuario = "root";
$senha = "";

$con_apca = mysqli_connect($hostname, $usuario, $senha, $bancodedados) or die("Erro - Falha na conexão apca");



?>
