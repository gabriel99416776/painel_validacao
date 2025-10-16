<?php

// Conexão com o banco de dados
$hostname = "localhost";
$bancodedados = "ap_controleacesso";
$usuario = "root";
$senha = "";
$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);


// Consulta para saber em NUMEROS, o total de usuarios
$totalConsulta = "SELECT COUNT(*) as total FROM ac_users";
$totalResultado = $mysqli->query($totalConsulta) or die ($mysqli->error);
$totalRow = $totalResultado->fetch_assoc();
$totalUsuarios = $totalRow['total'] 


?>







<!doctype html>
<html lang="pt-br">
  <head>
  <link rel="icon" href="img/logo-guia.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel de acesso</title>
<!-- Link CSS -->
    

    <!-- CDN Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>

    @import url('https://fonts.googleapis.com/css2?family=Poetsen+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

.dropdown-font-size{
    font-size: 20px;
}
section{
    margin-top: 30px;
}
section .container{
    margin-bottom: 50px;
}
nav{
    background-image: linear-gradient(to bottom, #967ADC 0%, #967adc87 0%, #ffffff 100%) !important;
   
}

nav .btn-custom-input{
    color: #000;
    font-weight: bold;
}

nav .btn-custom-input:hover{
    background-color: #967ADC;
}
nav .search-custom{
    border: 1px solid;
    box-shadow: 1px 1px 1px #000;
}

.toggle-arrow.rotate {
    transform: rotate(90deg);
}


section .btn-custom-section{
    color: #ffff;
    background-color: #967ADC;
    border: none;
    border-radius: 20px;
    padding: 10px 20px;
    font-weight: bold;
}
section .btn-custom-section:hover{
    background-color: #000;
    transition: .3s ease-in-out;
}
section .btn-custom-section:not(:hover){
    transition: .4s;
}

section .card-header{
    font-family: 'Poetsen one', sans-serif, serif;
    font-size: 18px;
    font-weight: 100;
    letter-spacing: 1px;
}
section .card-body h5{
    font-size: 30px;
    font-family: 'Poppins', sans-serif, serif;
}


section i{
    font-size: 100px;
    padding-right: 40px;
   
}






@media (max-width: 992px) {
    
    section h2{
        font-size: 1.5rem;
    }
  }
@media (max-width: 527px){
    section h2{
        font-size: 1.4rem;
    }
    section table .relatorio_ilha{
        font-size: 100%;
    }
}

@media (max-width: 493px){
    section h2{
        font-size: 1.3rem;
    }
}

@media (max-width: 1032px){
    section .cards-gerais {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        align-items: center;
        justify-content: center;
    }
}



.linha{
    width: 80%;
    margin: 0 auto; 
    border-color: #967ADC; 
    border-width: 5px;
    border-radius: 10px; 
    margin-top: 40px;
}


section .relatorio td,th{
    border: 1px solid rgb(255, 255, 255);
    border-radius: 3px;
}

section  .relatorio .relatorio_ilha{
    border: none;
    font-size: 25px;
    font-family: 'Poetsen one', sans-serif,serif;
    text-align: center;
    padding-top: 30px;
}
section .relatorio .descricao{
    background-color: #ffee009c ;
    font-size: 17px;
    font-weight: 600;
}   
section .relatorio .row-transparent{
    background-color: #ffff;
}
section .relatorio .total-relatorio{
    background-color: #967ADC;
    font-family: 'Poppins', sans-serif, serif;
    color: #ffff;
    font-weight: 700;
    font-size: 17px;
}
section table{
    width: 90%;
    margin: auto;
    text-align: center;
}


section .relatorio .tab_ing{
    background-color: #967ADC;
    color: #ffff;
    font-family: 'Poppins', sans-serif, serif;
    font-weight: 500;
    
}

.chart-container {
    width: 90%;
    height: 400px; /* Altura desejada para o gráfico */
    position: relative;
    margin: auto;
    margin-top: 30px;
    margin-bottom: 50px;
}

/* Estilo para o canvas */
canvas {
    height: 100% !important;
    width: 100% !important;
}


section a{
    text-decoration: none;
    color: #ffff;
}

section .card-tabela{
    border: 1px solid black;
    padding: auto;
    display: flex;
    align-items: center;
    padding: 0px 60px;
    border: none;
    margin-top: 30px;
    border-radius: 10px;
}
section .container-tabela-card{
    display: flex;
    justify-content: center;
    gap: 90px;
    
}
section .i-card{
    font-size: 80px;
}
section .infos{
    font-size: 20px;
    text-align: center;
    font-weight: 700;
}

section .grafico-dois{
    width: 50%;
}

</style>


<body>
  

    <?php
        include('header.php')
    ?>

    <!-- ---------- Fim da Navegação do Header --------------- -->
    
    <!---------- Area destinada ao [ID do evento] Nome do Evento - Data do Evento ----------->

    <section>
        <?php
            include('topo.php')
        ?>

    <!------------------ Fim do local de evento --------------------- -->



    <!-------- Area destinada aos Cads de Informações gerais --------->
        <div class="container">
            <div class="row ">
                <div class=" col-lg-4">
                    <div class="card mb-4 ">
                        <div class="card-header bg-success text-white">
                            Clientes Cadastrados
                        </div>
                        <div class="d-flex ">
                            <div class="card-body">
                              <h5 class="card-title mb-4"><?php  echo $totalUsuarios ?></h5>
                              
                              <a href="usuarios.php" class="btn btn-success">Acessar</a>
                            </div>
                            <i class="bi bi-person-add text-success"></i>

                        </div>
                    </div>
                </div>
                <div class=" col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                          Clientes Validados
                        </div>
                        <div class="d-flex ">
                            <div class="card-body">
                              <h5 class="card-title">1121</h5>
                              <p class="card-text"></p>
                              <a href="validados.php" class="btn btn-info text-white">Acessar</a>
                            </div>
                            <i class="bi bi-person-fill-check text-info"></i>

                        </div>
                    </div>
                </div>

              

                    <div class=" col-lg-4">
                        <div class="card mb-4">
                            <div class="card-header bg-secondary text-white">
                              Leitores
                            </div>
                            <div class="d-flex">
                                <div class="card-body">
                                  <h5 class="card-title">5/5</h5>
                                  <p class="card-text">Online/Offline</p>
                                  <a href="leitores.php" class="btn btn-secondary">Acessar</a>
                                </div>
                                <i class="bi bi-phone-vibrate text-secondary"></i>
    
                            </div>
                        </div>
                    </div>



                <div class=" col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                          Ingressos
                        </div>
                        <div class="d-flex">
                            <div class="card-body ">
                              <h5 class="card-title">1000/1000</h5>
                              <p class="card-text">Vendidos/Disponivel</p>
                              <a href="#relatorio-tabela" class="btn btn-primary">Acessar</a>
                            </div>
                            <i class="bi bi-ticket-perforated text-primary"></i>

                        </div>
                    </div>
                </div>

              



                    <div class=" col-lg-4">
                        <div class="card mb-4">
                            <div class="card-header bg-dark text-white">
                              Cadastro Facial
                            </div>
                            <div class="d-flex">
                                <div class="card-body ">
                                  <h5 class="card-title"></h5>
                                  <p class="card-text"></p>
                                  <a href="./cadastrofacial.php" class="btn btn-dark">Acessar</a>
                                </div>
                                <i class="bi bi-person-badge text-dark"></i>
    
                            </div>
                        </div>
                    </div>
                  


            </div>
        </div>

        <!-------------------- Fim dos Cards ---------------------->


        <!--------------- Linha de separação do card com a tabela ---------------->
         <hr class="linha">
        <!----------------- Fim da linha ---------------------------->


        <!--------------------- Tabela sobre o resumo de Ingressos do evento ------------------------ -->
        <div class="container-tabela-card">
            <div class="card-tabela bg-info text-white">
            <i class="bi bi-cart-plus i-card"></i>
            <div class="infos">
                <h4>
                    23412
                </h4>
                <p>Total de Ingressos</p>
            </div>
            </div>
            <div class="card-tabela bg-secondary text-white">
            <i class="bi bi-currency-dollar i-card"></i>
            <div class="infos">
                <h4>
                    20800
                </h4>
                <p>Total de Vendidos</p>
            </div>
            </div>
            <div class="card-tabela bg-success text-white">
            <i class="bi bi-check2 i-card"></i>
            <div class="infos ">
                <h4>
                    10900
                </h4>
                <p>Ingressos Validados</p>
            </div>
            </div>
        </div>
        <div class="relatorio" id="relatorio-tabela">

            <table border="1" bordercolor="#FFFFFF" cellspacing="0" cellpadding="0" width="100%">
               <tbody>
           
               <tr class="white">
                   <td colspan="3" class="relatorio_ilha">SUPERIOR SUL</td>            
                </tr>
               <tr class="descricao">
                   <td colspan="3" class="border-0 row-transparent">&nbsp;</td>
                   <td>Validados</td>
                   <td colspan="2">Percentual</td>
                    <td>Total Vendido</td>
               </tr>
               <tr class="tab_ing">
                   <td colspan="3" height="50">Superior Sul (INTEIRA)</td>
                   <td>18</td>
                   <td colspan="2">
                   <div>90,00%</div>
                   </td>
                    <td>20</td>
               </tr>
               <tr class="tab_ing">
                   <td colspan="3" height="50">Superior Sul (MEIA)</td>
                   <td>16</td>
                   <td style="padding-right:20px;" colspan="2" >
                   <div>100,00%</div>
                   </td>
                    <td>16</td>
               </tr>
               <tr class="tab_ing">
                   <td colspan="3" height="50">Superior Sul (CORTESIA)</td>
                   <td>16</td>
                   <td style="padding-right:20px;" colspan="2" >
                   <div>100,00%</div>
                   </td>
                    <td>16</td>
               </tr>
               <tr class="total-relatorio">
                   <td colspan="3" height="50">TOTAL VALIDADOS/VENDIDOS</td>
                   <td>34</td>
                   <td style="padding-right:20px;" colspan="2" >
                   <div>100,00%</div>
                   </td>
                    <td>36</td>
               </tr>
               
               
               <tr class="white">
                   <td colspan="3" class="relatorio_ilha">INFERIOR SUL</td>
                
                </tr>
               <tr class="descricao">
                   <td colspan="3" class="border-0 row-transparent">&nbsp;</td>
                   <td>Validados</td>
                   <td colspan="2">Percentual</td>
                    <td>Total Vendido</td>
               </tr>
               <tr class="tab_ing">
                   <td colspan="3" height="50">Inferior Sul (INTEIRA)</td>
                   <td>7</td>
                   <td style="padding-right:20px;" colspan="2" >
                   <div>100,00%</div>
                   </td>
                    <td>7</td>
               </tr>
               <tr class="tab_ing">
                   <td colspan="3" height="50">Inferior Sul (MEIA)</td>
                   <td>2</td>
                   <td style="padding-right:20px;" colspan="2" >
                   <div>100,00%</div>
                   </td>
                    <td>2</td>
               </tr>
               <tr class="tab_ing">
                   <td colspan="3" height="50">Inferior Sul (CORTESIA)</td>
                   <td>2</td>
                   <td style="padding-right:20px;" colspan="2" width="200">
                   <div>100,00%</div>
                   </td>
                    <td>2</td>
               </tr>
               <tr class="total-relatorio">
                <td colspan="3" height="50">TOTAL VALIDADOS/VENDIDOS</td>
                <td>34</td>
                <td style="padding-right:20px;" colspan="2" width="200">
                <div>100,00%</div>
                </td>
                 <td>36</td>
            </tr>
               <tr class="white">
                   <td colspan="3" class="relatorio_ilha">PREMIUM </td>                            
               </tr>
               <tr class="descricao">
                   <td colspan="3" class="border-0 row-transparent">&nbsp;</td>
                   <td>Validados</td>
                   <td colspan="2">Percentual</td>
                    <td>Total Vendido</td>
               </tr>
               <tr class="tab_ing">
                   <td colspan="3" height="50">Premium (INTEIRA)</td>
                   <td>2</td>
                   <td style="padding-right:20px;" colspan="2" >
                   <div >20,00%</div>
                   </td>
                    <td>10</td>
               </tr>
               <tr class="tab_ing">
                   <td colspan="3" height="50">Premium (MEIA)</td>
                   <td>5</td>
                   <td style="padding-right:20px;" colspan="2" >
                   <div >33,33%</div>
                   </td>
                    <td>15</td>
               </tr>
               <tr class="tab_ing">
                   <td colspan="3" height="50">Premium (CORTESIA)</td>
                   <td>15</td>
                   <td style="padding-right:20px;" colspan="2" >
                   <div>100,00%</div>
                   </td>
                    <td>15</td>
               </tr>
               <tr class="total-relatorio">
                <td colspan="3" height="50">TOTAL VALIDADOS/VENDIDOS</td>
                <td>34</td>
                <td style="padding-right:20px;" colspan="2" >
                <div>100,00%</div>
                </td>
                 <td>36</td>
            </tr>
               <tr class="white">
                   <td colspan="3" class="relatorio_ilha">Total Validados: 97</td>
                   <td colspan="4" class="relatorio_ilha">Total Vendidos: 166</td>
               </tr>
           </tbody></table>
        </div>

        <!------------------ Fim da Tabela de resumos ------------------------>
        <hr class="linha">



        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!------------------------- Script do grafico de validações de Ingressos ---------------->

<script>
$(document).ready(function() {
    //Get the context of the Chart canvas element we want to select
    var ctx = $("#line-chart");
    
    // Chart Options
    var chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            position: 'bottom',
        },
        hover: {
            mode: 'label'
        },
        scales: {
            xAxes: [{
                display: true,
                gridLines: {
                    color: "#f3f3f3",
                    drawTicks: false,
                },
                scaleLabel: {
                    display: false,
                    labelString: ''
                }
            }],
            yAxes: [{
                display: true,
                ticks: {
                    beginAtZero: true
                },
                gridLines: {
                    color: "#f3f3f3",
                    drawTicks: false,
                },
                scaleLabel: {
                    display: false,
                    labelString: ''
                }
            }]
        }
    };
    
    // Chart Data
    var chartData = {
        labels: ['18:00','18:10','18:20','18:30','18:40','18:50','19:00','19:10','19:20','19:30','19:40','19:50','20:00'],
        datasets: [{
            label: 'Superior Sul',
            data: [400,45,350,0,100,200,123,9,4,63,142,90,173],
            fill: false,
            borderColor: "#BCAAE9",
            pointBorderColor: "#BCAAE9",
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
        },{
            label: 'Bossa Nova',
            data: [10,20,50,302,12,30,21,19,6,91,42,123,32],
            fill: false,
            borderColor: "#99B898",
            pointBorderColor: "#99B898",
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
        },{
            label: 'Premium ',
            data: [100,231,115,392,123,30,106,15,80,88,52,134],
            fill: false,
            borderColor: "#FECEA8",
            pointBorderColor: "#FECEA8",
            pointBackgroundColor: "#FFF",
            pointBorderWidth: 2,
            pointHoverBorderWidth: 2,
            pointRadius: 4,
        }]
    };
    
    var config = {
        type: 'line',
        // Chart Options
        options : chartOptions,
        data : chartData
    };
    
    // Create the chart
    var lineChart = new Chart(ctx, config);
});
</script>
<!-------------------------------- Fim do script------------------>

<!------------- Exibir o grafico ----------------------->
<div class="chart-container">
    <h1>Validação A Cada 10 Minutos</h1>
    <canvas id="line-chart"></canvas> 

</div>

<section id="chartjs-bar-charts">
    <!-- Column Chart -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ultimos 7 dias com vendas</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                            <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                            <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
<script>
// Column chart
// ------------------------------
$(window).on("load", function(){

    //Get the context of the Chart canvas element we want to select
    var ctx = $("#column-chart");

    // Chart Options
    var chartOptions = {
        // Elements options apply to all of the options unless overridden in a dataset
        // In this case, we are setting the border of each bar to be 2px wide and green
        elements: {
            rectangle: {
                borderWidth: 2,
                borderColor: 'rgb(0, 255, 0)',
                borderSkipped: 'bottom'
            }
        },
        responsive: true,
        maintainAspectRatio: false,
        responsiveAnimationDuration:500,
        legend: {
            position: 'top',
        },
        scales: {
            xAxes: [{
                display: true,
                gridLines: {
                    color: "#f3f3f3",
                    drawTicks: false,
                },
                scaleLabel: {
                    display: true,
                }
            }],
            yAxes: [{
                display: true,
                ticks: {
                beginAtZero: true
                },
                gridLines: {
                    color: "#f3f3f3",
                    drawTicks: false,
                },
                scaleLabel: {
                    display: true,
                }
            }]
        }
    };

    // Chart Data
    var chartData = {
        labels: ['17/Jun (Seg) - [R$9300,00]','18/Jun (Ter) - [R$83700,00]','19/Jun (Qua) - [R$9000,00]','27/Jun (Qui) - [R$9300,00]','04/Jul (Qui) - [R$109800,00]','09/Jul (Ter) - [R$9000,00]','11/Jul (Qui) - [R$18000,00]'],
        datasets: [{
            label: "Vendas",
            data: [1,9,1,1,12,1,2],
            backgroundColor: "#967ADC",
            hoverBackgroundColor: "rgba(103,58,183,.9)",
            borderColor: "transparent"
        }]
    };

    var config = {
        type: 'bar',

        // Chart Options
        options : chartOptions,

        data : chartData
    };

    // Create the chart
    var lineChart = new Chart(ctx, config);
});
</script>

<div class="chart-container">
    
    
    <canvas id="column-chart" height="400"></canvas>

</div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" type="text/javascript"></script>

              
    </section>
    
              
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha383-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="scripts.js"></script>
  </body>
</html>