<?php
include 'conexao.php';

$id = $_GET['id'];

$stmt = $con_apca->prepare("SELECT id, nome, ip, portaria FROM ac_leitores WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
echo json_encode($result->fetch_assoc());
