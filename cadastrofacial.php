<?php

session_start();
if(!$_SESSION['login']) {
    session_destroy();
    header('Location: form-login.php');
}
?>


<!doctype html>
<html lang="pt-br">
  <head>
  <link rel="icon" href="img/logo-guia.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro Facial</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poetsen+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap');

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
    background-image: linear-gradient(to bottom, #967ADC 0%, #967adc87 0%, #ffffff 100%);
   
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


section .btn-custom-section a{
    text-decoration: none;
    color: #ffff;
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
}

@media (max-width: 493px){
    section h2{
        font-size: 1.3rem;
    }
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

section form #imagem-capturada{
    display: none;
}

@media (max-width: 768px){
    section form .form-row{
        width: 50vh;
    }
}
@media (max-width: 558px){
    section form .form-row{
        width: 30vh;
    }
    section form video{
        width: 30vh;

    }
    section form .imagem-canva-tirada{
        width: 30vh;
    }
}
  </style>
  <body>
   
  <?php
        include('header.php');
    ?>

    <section>
        <?php
            include('topo.php');
        ?>

        


        <!---------------------------------------------- FORMULARIO ----------------------------------------->
        <form id="cadastro-facial" method="post" action="salvar_dados.php">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nome">Nome Da Pessoa: </label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="cpf">CPF: </label>
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" required>
                </div>
                <div class="form-group col-md-6">
                <select class="form-select" aria-label="Default select example" required>
                <option value="" disabled selected>Selecione a Portaria</option>
                <option value="1">1303</option>
                <option value="2">3456</option>
                <option value="3">5932</option>
                </select>
                </div>
                
                
                <div id="camera" >
                    <video id="video" width="520" height="400" autoplay></video><br>
                    <button type="button" id="capturar" class="botao-facial">Capturar Foto</button>
                </div>

                <div id="output" style="margin-top:20px;" >
                    <canvas id="canvas" width="320" height="240" style=" border:1px solid black;" class="imagem-canva-tirada"></canvas>
                </div>
                
                <input type="hidden" id="imagem-base64" name="foto_base64">
                <button type="submit" class="botao-cadastrar">Cadastrar</button>
            </div>
            </div>
        </form>

  

    </section>
    
    <script src="./capturarfoto.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 


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


<script src="scripts.js"></script>
  </body>
</html>
