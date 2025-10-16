<?php
session_start();

if (!$_SESSION['login']) {
    session_destroy();
    header('Location: form-login.php');
    exit;
}

$hostname = "localhost";
$bancodedados = "ap_controleacesso";
$usuario = "root";
$senha = "";
$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idServer = $_POST['text'];

    // Verificar se o ID do cliente existe no campo id_server
    $sql = "SELECT foto64 FROM ac_users WHERE id_server = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $idServer);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fotoBase64 = $row['foto64'];

        // Fazer a requisição para a API da Intelbras
        $device_ip = '10.0.0.193';
        $username = 'admin';
        $password = '10101993@1993';

        $url = "http://{$device_ip}/cgi-bin/AccessFace.cgi?action=updateMulti";

        $payload = json_encode([
            "FaceList" => [
                [
                    "UserID" => $idServer,
                    "PhotoData" => [$fotoBase64]
                ]
            ]
        ]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Erro na requisição: ' . curl_error($ch);
        } else {
            echo "<script>alert('Foto atualizada com sucesso!'); window.location.href = 'atualizarface.php';</script>". $response;
        }
        curl_close($ch);
    } else {
        echo "<script>alert('ID do cliente não encontrado.'); window.location.href = 'atualizarface.php';</script>";
    }
    $stmt->close();
}
$mysqli->close();
?>
