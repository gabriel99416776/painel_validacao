<?php
//Biblioteca phpqrcode para gera qrcode


// Conexão com o banco de dados
$hostname = "localhost";
$bancodedados = "ap_controleacesso";
$usuario = "root";
$senha = "";
$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

// Consulta para pegar o numero total de usuarios
$consulta = "SELECT DISTINCT card_name FROM ac_validados WHERE card_name IS NOT NULL AND card_name <> '' ORDER BY card_name ASC";
$resultado = $mysqli->query($consulta) or die($mysqli->error);



// Consulta para saber em NUMEROS, o total de usuarios
$totalConsulta = "SELECT COUNT(DISTINCT card_name) as total FROM ac_validados WHERE card_name IS NOT NULL AND card_name != ''";
$totalResultado = $mysqli->query($totalConsulta) or die($mysqli->error);
$totalRow = $totalResultado->fetch_assoc();
$totalValidados = $totalRow['total'];


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






    @media (max-width: 992px) {

        section h2 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 527px) {
        section h2 {
            font-size: 1.4rem;
        }
    }

    @media (max-width: 493px) {
        section h2 {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 1032px) {
        section .cards-gerais {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            align-items: center;
            justify-content: center;
        }
    }

    @media (max-width: 550px) {
        section .table-custom .campo-pesquisar button {
            font-size: 16px;
            padding: 2px 4px;
            margin-top: 5px;
        }

        section .table-custom .campo-pesquisar input {
            width: 100px;
        }
    }



    section table {

        margin: auto;
        text-align: center;

    }

    section .table-custom {
        max-width: 95%;
    }

    section a {
        text-decoration: none;
        color: #ffff;
    }

    section table .campo-pesquisar button {
        border-radius: 10px;
        background-color: #967ADC;
        color: #ffff;
        border: none;
        padding: 5px 14px;
        font-size: 18px;
    }

    section table .campo-pesquisar input {
        padding-left: 10px;
        border-radius: 5px;
        padding: 5px;
    }

    section table .campo-pesquisar input:focus {
        box-shadow: 0 0 0 0;

        outline: 0;
    }

    section .total-clientes {
        margin-left: 40px;
    }

    .accordion {
        width: 90%;
        margin: auto;
    }

    .accordion .editarFoto {
        width: 80px;
        margin: auto;
        padding: 5px 10px;
        border: none;
        background-color: #967ADC;
        color: #ffffff;
        border-radius: 10px;
    }

    @media (max-width: 769px) {
        .accordion .editarFoto {
            margin: 30px auto;
        }
    }

    @media (max-width: 768px) {
        .accordion .fotoFacial {
            display: flex;
            justify-content: center;
        }
    }

    .accordion .fotoFacial {
        margin-top: 60px;
    }

    .inputPesquisarClientes {
        margin-right: 17px;
        margin-bottom: 10px;
        width: 50%;
        padding: 5px;
        border-radius: 10px;


    }

    .inputPesquisarClientes:focus {
        outline: 0;
    }

    .accordion-item {
        border-color: #967ADC !important;
        border-left: 2px solid #967ADC !important;
        border-top: 2px solid #967ADC !important;

    }

    .accordion-button {
        background-color: #14fc0363 !important;
        font-weight: 600;
        box-shadow: none !important;
    }

    .linha {
        width: 80%;
        margin: 30px auto;
        border-color: #967ADC;
        border-width: 5px;
        border-radius: 10px;
        margin-top: 40px;
    }

    .list-group {
        width: 80%;
        margin: auto;
        font-size: 24px;
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
        <div class="d-flex justify-content-between">
            <h2 class="total-clientes">Total : <?php echo $totalValidados; ?></h2>
            <input type="search" name="" id="" placeholder="Digite o Nome" class="inputPesquisarClientes">

        </div>
        <hr class="linha">
        <li class="list-group-item list-group-item-action active" aria-current="true">Validados</li>
        <div class="list-group">
            <ul>
                <?php
                if ($resultado->num_rows > 0) {
                    while ($row = $resultado->fetch_assoc()) {
                        echo '<li class="list-group-item list-group-item-action bg-success text-white">';
                        echo htmlspecialchars($row['card_name']);
                        echo '</li>';
                    }
                }
                ?>
        </div>

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