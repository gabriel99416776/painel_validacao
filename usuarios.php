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
$totalUsuarios = $totalRow['total'];


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
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Clientes</title>
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
        background-color: #d3d3d352 !important;
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

    @media (max-width: 785px) {
        .custom-qrcode-foto {
            display: flex !important;
            flex-direction: column !important;

        }

        .custom-foto-accordion {
            display: flex;
            justify-content: center;
        }
    }
</style>

<body>

    <?php
    include('header.php');
    ?>

    <section>
        <?php include('topo.php') ?>
        <div class="d-flex justify-content-between">
            <h2 class="total-clientes">Total : <?php echo $totalUsuarios; ?></h2>
            <input type="search" name="" id="" placeholder="Digite para filtrar os nomes" class="inputPesquisarClientes">
        </div>
        <hr class="linha">

        <div class="accordion" id="accordionFlushExample">
            <?php
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $nome = $row['nome'];
                    $qrcode = $row['qrcode'];
                    $foto_base64 = $row['foto64'];

                    $id = preg_replace('/[^a-zA-Z0-9]/', '_', $nome);

                    echo '<div class="accordion-item">';
                    echo '<h2 class="accordion-header" id="heading' . $id . '">';
                    echo '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $id . '" aria-expanded="false" aria-controls="collapse' . $id . '">';
                    echo ($nome);
                    echo '</button>';
                    echo '</h2>';
                    echo '<div id="collapse' . $id . '" class="accordion-collapse collapse" aria-labelledby="heading' . $id . '" data-bs-parent="#accordionFlushExample">';
                    echo '<div class="accordion-body">';
                    echo '<div class="container d-flex justify-content-around custom-qrcode-foto">';
                    echo '<center><img src="https://efolia.com.br/qr/qrjob.php?num=' . htmlspecialchars($qrcode) . '" width="250"></center>';
                    echo '<div class="custom-foto-accordion">';
                    echo '<img src="data:image/jpeg;base64,' . htmlspecialchars($foto_base64) . '" width="250">';
                    echo '</div>';
                    echo '</div>';
                    echo '<center><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">ENVIAR</button></center>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "Nenhum usuário encontrado.";
            }
            ?>
        </div>
    </section>











    <!-- CDN do Bootstrap -->
    <!-- CDN do Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="./capturarfoto.js"></script>
    <!-- Manipulação DOM -->
    <script src="pesquisarUser.js"></script>

    <script src="scripts.js"></script>


    <script>
        $(document).ready(function() {
            // Função para aplicar os filtros
            function applyFilters() {
                var statusFilter = $('#filterStatus').val();
                var cadastroFilter = $('#filterCadastro').val();

                $('.accordion-item').each(function() {
                    var item = $(this);
                    var show = true;

                    // Filtra com base no status (entrou ou não)
                    if (statusFilter != 'all') {
                        if (!item.hasClass(statusFilter)) {
                            show = false;
                        }
                    }

                    // Filtra com base no cadastro (cadastrado ou não)
                    if (cadastroFilter != 'all') {
                        if (!item.hasClass(cadastroFilter)) {
                            show = false;
                        }
                    }

                    // Mostra ou oculta o item com base nos filtros
                    if (show) {
                        item.show();
                    } else {
                        item.hide();
                    }
                });
            }

            // Aplica os filtros quando o botão é clicado
            $('#applyFilters').click(function() {
                applyFilters();
            });

            // Aplica os filtros quando a seleção é alterada
            $('#filterStatus, #filterCadastro').change(function() {
                applyFilters();
            });
        });
    </script>


</body>




</html>