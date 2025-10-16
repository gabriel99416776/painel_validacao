<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ids']) && isset($_POST['portaria'])) {
    $ids = $_POST['ids'];
    $newPortaria = $_POST['portaria'];

    $idString = implode(',', array_map('intval', $ids));
    $sql = "UPDATE `ac_leitores` SET `portaria` = '$newPortaria' WHERE `id` IN ($idString)";

    if (mysqli_query($con_apca, $sql)) {
        echo "Portarias atualizadas com sucesso!";
    } else {
        echo "Erro ao atualizar portarias: " . mysqli_error($con_apca);
    }
} else {
    echo "Dados inválidos.";
}

mysqli_close($con_apca);
?>
