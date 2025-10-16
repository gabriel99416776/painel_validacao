<?php
//Biblioteca phpqrcode para gera qrcode


// Conexão com o banco de dados
$hostname = "localhost";
$bancodedados = "ap_controleacesso";
$usuario = "root";
$senha = "";
$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

// Consulta para pegar o numero total de usuarios
$consulta = "SELECT card_name FROM ac_validados";
$resultado = $mysqli->query($consulta) or die($mysqli->error);

// Consulta para saber em NUMEROS, o total de usuarios
$totalConsulta = "SELECT COUNT(*) as total FROM ac_validados";
$totalResultado = $mysqli->query($totalConsulta) or die($mysqli->error);
$totalRow = $totalResultado->fetch_assoc();
$totalValidados = $totalRow['total']


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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Validados</title>
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

    
section form{
    margin-left: 25%;
    font-size: 20px;
}
section form .form-control{
    font-size: 20px;
    border: 1px solid black;
    
}
section form .file-custom{
    margin-top: 30px;
   
}
section form .botao-cadastrar{
    background-color: #967ADC;
    color: #ffff;
    padding: 3px 20px;
    border: none;
    border-radius: 10px;
    margin-top: 30px;
    margin-left: 15%;
}
section form .botao-facial{
    background-color: #967ADC;
    color: #ffff;
    padding: 3px 20px;
    border: none;
    border-radius: 10px;
    
}

section form select {
    margin: 20px 0;
    
}
section form .form-select{
    border: 1px solid black;
    
}
form .camara-input-label{
    
            padding: 10px;
            width: 70%;
            background-color: #333;
            color: #FFF;
            text-transform: uppercase;
            text-align: center;
            display: block;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="file"] {
            display: none;
            
        }
        section .enviar{
            margin-top: 20px;
        }
        section .botao-enviar-foto{
            margin-top: 20px;
            font-size: 17px;
            font-weight: 600;
        }
</style>

<body>


    <?php
    include('header.php');
    ?>

    <section>
        <?php
        include('topo.php')
        ?>


<form id="cadastro-facial" method="post" action="fotoreal.php" enctype="multipart/form-data">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="text">Digite o ID do Cliente: </label>
            <input type="text" class="form-control" id="text" name="text" placeholder="Exemplo: 99574" required>
            <button type="submit" class="btn btn-primary botao-enviar-foto">Atualizar Foto</button>
        </div>
    </div>
</form>
    </section>



    <!-- CDN do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha383-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- Manipulação DOM -->
    <script src="validados.js"></script>


    <script src="scripts.js"></script>
</body>

</html>