<?php

$email = isset($_POST['email']) ? $_POST['email'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

$dadosPdo = [
    'dns' => 'mysql:host=localhost;dbname=login',
    'usuario' => 'root',
    'senha' => ''
];

$pdo = new PDO($dadosPdo['dns'], $dadosPdo['usuario'], $dadosPdo['senha']);

$sql = "SELECT 
            nome, id, permissao_id
        FROM usuarios
        WHERE
            (email = :email)
            AND (senha = PASSWORD(:senha))";

$consulta = $pdo->prepare($sql);
$consulta->bindParam(':email', $email);
$consulta->bindParam(':senha', $senha);
$consulta->execute();

$resultado = $consulta->fetchAll();

session_start();

if ($resultado) {
    $_SESSION['login'] = [
        'nome' => $resultado[0]['nome'],
        'id' => $resultado[0]['id'],
        'permissao_id' => $resultado[0]['permissao_id']
    ];

    header('Location: index.php');
} else {
    session_destroy();
    header('Location: form-login.php?erro=1');
}
?>
