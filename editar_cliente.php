<?php
//Biblioteca phpqrcode para gera qrcode


// Conexão com o banco de dados
$hostname = "localhost";
$bancodedados = "ap_controleacesso";
$usuario = "root";
$senha = "";
$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

// Consulta para pegar o numero total de usuarios
$consulta = "SELECT nome, qrcode, foto64 FROM ac_users";
$resultado = $mysqli->query($consulta) or die($mysqli->error);


// Consulta para saber em NUMEROS, o total de usuarios
$totalConsulta = "SELECT COUNT(*) as total FROM ac_users";
$totalResultado = $mysqli->query($totalConsulta) or die($mysqli->error);
$totalRow = $totalResultado->fetch_assoc();
$totalUsuarios = $totalRow['total']


// Consulta para buscar o codigo QRcode

?>

<?php

session_start();
if (!$_SESSION['login']) {
    session_destroy();
    header('Location: form-login.php');
}

$nome = $_SESSION['login']['nome'];
$permissao_id = $_SESSION['login']['permissao_id'];

?>

<!doctype html>
<html lang="pt-br">

<head>
    <link rel="icon" href="img/logo-guia.png">
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html" charset="iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Clientes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poetsen+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    .dropdown-font-size {
        font-size: 20px;
    }

    section {
        margin-top: 30px;
    }

    section .container {
        margin-bottom: 50px;
    }

    nav {
        background-image: linear-gradient(to bottom, #967ADC 0%, #967adc87 0%, #ffffff 100%);

    }

    nav .btn-custom-input {
        color: #000;
        font-weight: bold;
    }

    nav .btn-custom-input:hover {
        background-color: #967ADC;
    }

    nav .search-custom {
        border: 1px solid;
        box-shadow: 1px 1px 1px #000;
    }

    .toggle-arrow.rotate {
        transform: rotate(90deg);
    }


    section .btn-custom-section {
        color: #ffff;
        background-color: #967ADC;
        border: none;
        border-radius: 20px;
        padding: 10px 20px;
        font-weight: bold;
    }

    section .btn-custom-section:hover {
        background-color: #000;
        transition: .3s ease-in-out;
    }

    section .btn-custom-section:not(:hover) {
        transition: .4s;
    }

    section .card-header {
        font-family: 'Poetsen one', sans-serif, serif;
        font-size: 18px;
        font-weight: 100;
        letter-spacing: 1px;
    }

    section .card-body h5 {
        font-size: 30px;
        font-family: 'Poppins', sans-serif, serif;
    }


    section i {
        font-size: 100px;
        padding-right: 40px;

    }

    section form {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
    }

    section .formulario-editar {
        display: flex;
        flex-direction: column;
        gap: 20px;

        padding: 50px 50px;

        color: black;
        border-radius: 20px;
        font-weight: 600;
        font-size: 25px;
    }

    section .formulario-editar p {
        text-align: center;
        font-size: 35px;
        -webkit-text-stroke-width: .5px;
        -webkit-text-stroke-color: black
    }

    section .botao-form {
        display: flex;
        gap: 10px;
        justify-content: center;
        flex-direction: column;
        width: 50%;
        margin-left: 25%;
        gap: 40px;

    }

    section .formulario-editar button {
        color: #ffff;
        background-color: #967ADC;
        border: none;
        border-radius: 20px;
        padding: 5px 10px;
    }
</style>

<body>

    <?php
    include('header.php');
    ?>

    <section>
        <?php include('topo.php') ?>

        <form action="">
            <div class="formulario-editar">
                <p>Editar Dados do Cliente</p>
                <div>
                    <label for="">Selecionar o ID do Cliente :</label>
                    <input type="number" name="" id="" required>
                </div>

                
                <div class="botao-form">
                    <div id="camera">
                        <video id="video" width="520" height="400" autoplay></video><br>
                        <button type="button" id="capturar" class="botao-facial">Capturar Foto</button>
                    </div>

                    <div id="output" style="margin-top:20px;">
                        <canvas id="canvas" width="320" height="240" style=" border:1px solid black;" class="imagem-canva-tirada"></canvas>
                    </div>

                    <input type="hidden" id="imagem-base64" name="foto_base64">
                    <button type="submit" class="botao-cadastrar">ENVIAR</button>


                </div>
            </div>


        </form>
    </section>





    <!-- CDN do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./capturarfoto.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- Manipulação DOM -->
    <script src="fotoFacial.js"></script>
    <script src="pesquisarUser.js"></script>

    <script src="scripts.js"></script>


</body>


<script>
    function isMobile() {
        // Verifica a largura da tela
        if (window.innerWidth <= 800) {
            return true;
        }

        // Verifica a user agent string
        const userAgent = navigator.userAgent || navigator.vendor || window.opera;
        return /android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(userAgent.toLowerCase());
    }

    function redirectToMobileVersion() {
        if (isMobile()) {
            // Substitua 'mobile.html' pelo nome do arquivo da versão móvel do seu site
            window.location.href = "./cadastromobile.php";
        }
    }

    window.onload = function() {
        redirectToMobileVersion();
    };
</script>

</body>

</html>