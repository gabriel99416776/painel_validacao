<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
</head>
<body>
    <p>Saindo...</p>
    <script>
        // Limpar Local Storage
        localStorage.clear();
        // Adicionar pequeno atraso antes do redirecionamento
        setTimeout(function() {
            window.location.href = 'form-login.php';
        }, 500); // 100 milissegundos de atraso
    </script>
</body>
</html>
