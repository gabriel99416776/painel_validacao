<?php
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: form-login.php');
    exit();
}

$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
$success = isset($_SESSION['success']) ? $_SESSION['success'] : false;

unset($_SESSION['message']);
unset($_SESSION['success']);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trocar Senha</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script>
        function redirectToLogin() {
            setTimeout(function() {
                window.location.href = 'form-login.php';
            }, 2500);
        }
    </script>
</head>
<body>
    <div class="container mt-4">
        <h1>Trocar Senha</h1>
        <?php if (!empty($message)): ?>
            <div class="alert <?php echo $success ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                <?php echo $message; ?>
            </div>
            <?php if ($success): ?>
                <script>redirectToLogin();</script>
            <?php endif; ?>
        <?php endif; ?>
        <form action="trocarsenha.php" method="post">
            <div class="mb-3">
                <label for="novaSenha" class="form-label">Nova Senha</label>
                <input type="password" class="form-control" id="novaSenha" name="novaSenha" required>
            </div>
            <div class="mb-3">
                <label for="confirmarSenha" class="form-label">Confirmar Nova Senha</label>
                <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha" required>
            </div>
            <button type="submit" class="btn btn-primary">Trocar Senha</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
