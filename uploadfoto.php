<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se o campo 'photo' está presente
    if (isset($_POST['photo']) && isset($_POST['userId'])) {
        $photo = $_POST['photo'];
        $userId = $_POST['userId'];

        // Remove o prefixo data:image/jpeg;base64,
        $photo = str_replace('data:image/jpeg;base64,', '', $photo);
        $photo = str_replace(' ', '+', $photo);
        $photoData = base64_decode($photo);

        // Conectar ao banco de dados
        $mysqli = new mysqli('localhost', 'root', '', 'ap_controleacesso');

        if ($mysqli->connect_error) {
            die('Erro na conexão: ' . $mysqli->connect_error);
        }

        // Atualizar a foto no banco de dados
        $stmt = $mysqli->prepare("UPDATE ac_users SET foto64 = ? WHERE id = ?");
        $stmt->bind_param('si', $photoData, $userId);

        if ($stmt->execute()) {
            echo 'Foto atualizada com sucesso!';
        } else {
            echo 'Erro ao atualizar foto: ' . $mysqli->error;
        }

        $stmt->close();
        $mysqli->close();
    } else {
        echo 'Dados não encontrados.';
    }
} else {
    echo 'Método inválido.';
}
?>