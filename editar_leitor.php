<?php
include('conexao.php');

if (isset($_POST['id']) && isset($_POST['ip'])) {
    $id = $_POST['id'];
    $novoIp = $_POST['ip'];

    $sql_update = "UPDATE `ac_leitores` SET `ip` = ? WHERE `id` = ?";
    if ($stmt = mysqli_prepare($con_apca, $sql_update)) {
        mysqli_stmt_bind_param($stmt, "si", $novoIp, $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "IP atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar IP.";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Erro na preparação da consulta.";
    }
} else {
    echo "Dados inválidos.";
}

mysqli_close($con_apca);
?>
