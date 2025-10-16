<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['login'])) {
    header('Location: form-login.php');
    exit();
}

$message = "";
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novaSenha = $_POST['novaSenha'];
    $confirmarSenha = $_POST['confirmarSenha'];
    $usuarioId = $_SESSION['login']['id'];

    if ($novaSenha !== $confirmarSenha) {
        $message = "As senhas não coincidem.";
    } else {
        $dadosPdo = [
            'dns' => 'mysql:host=localhost;dbname=login',
            'usuario' => 'root',
            'senha' => ''
        ];

        try {
            $pdo = new PDO($dadosPdo['dns'], $dadosPdo['usuario'], $dadosPdo['senha']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "UPDATE usuarios SET senha = PASSWORD(:senha) WHERE id = :id";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(':senha', $novaSenha);
            $consulta->bindParam(':id', $usuarioId);

            if ($consulta->execute()) {
                $message = "Senha alterada com sucesso! Você vai ser Redirecionado em 3,2,1...";
                $success = true;
            } else {
                $message = "Erro ao alterar a senha.";
            }
        } catch (PDOException $e) {
            $message = "Erro: " . $e->getMessage();
        }
    }
    $_SESSION['message'] = $message;
    $_SESSION['success'] = $success;
    header('Location: trocarsenha-form.php');
    exit();
}
?>
