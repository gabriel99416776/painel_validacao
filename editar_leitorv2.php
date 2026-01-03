<?php
include 'conexao.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$ip = $_POST['ip'];
$portaria = $_POST['portaria'];

$stmt = $con_apca->prepare("
    UPDATE ac_leitores 
    SET nome = ?, ip = ?, portaria = ?
    WHERE id = ?
");
$stmt->bind_param("sssi", $nome, $ip, $portaria, $id);

echo $stmt->execute() ? 'OK' : 'ERRO';
