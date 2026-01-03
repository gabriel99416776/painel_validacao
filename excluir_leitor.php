<?php
include 'conexao.php';

$senhaCorreta = '10101993';

$id = $_POST['id'] ?? null;
$senha = $_POST['senha'] ?? null;

if (!$id || !$senha) {
    http_response_code(400);
    echo 'DADOS_INVALIDOS';
    exit;
}

if ($senha !== $senhaCorreta) {
    http_response_code(401);
    echo 'SENHA_INCORRETA';
    exit;
}

$stmt = $con_apca->prepare("DELETE FROM ac_leitores WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo 'OK';
} else {
    echo 'ERRO_DELETE';
}
