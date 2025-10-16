<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conexão com o banco de dados
    $hostname = "localhost";
    $bancodedados = "clientes";
    $usuario = "root";
    $senha = "";
    $mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

    if ($mysqli->connect_error) {
        die("Erro de conexão: " . $mysqli->connect_error);
    }

    // Captura os dados do formulário
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $foto = $_FILES['foto']['tmp_name'];

    // Verifica se o email e CPF existem no banco de dados
    $stmt = $mysqli->prepare("SELECT * FROM `cliente-cadastro` WHERE email = ? AND cpf = ?");
    $stmt->bind_param('ss', $email, $cpf);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email e CPF existem, então atualiza a foto
        if (is_uploaded_file($foto)) {
            // Converte a foto para base64
            $fotoBase64 = base64_encode(file_get_contents($foto));

            // Atualiza a foto no banco de dados
            $stmt = $mysqli->prepare("UPDATE `cliente-cadastro` SET foto64 = ? WHERE email = ? AND cpf = ?");
            $stmt->bind_param('sss', $fotoBase64, $email, $cpf);

            if ($stmt->execute()) {
                echo "<script>alert('Foto atualizada com sucesso!'); window.location.href = 'clientecadastrado.php';</script>";
            } else {
                echo "Erro ao atualizar a foto: " . $stmt->error;
            }
        } else {
            echo "Erro ao carregar o arquivo.";
        }
    } else {
        // Email ou CPF não existem no banco de dados
        echo "<script>alert('Email ou CPF inexistente no Banco de Dados'); window.location.href = 'clientecadastrado.php';</script>";
    }

    $stmt->close();
    $mysqli->close();
}
?>
