<!doctype html>
<html lang="en">
  <head>
  <link rel="icon" href="img/logo-guia.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="/painel_validacao/login/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <style>
      .form-floating input[type="text"]:focus,
      .form-floating input[type="password"]:focus,
      .form-floating input[type="email"]:focus {
          box-shadow: 3px 3px rgba(0, 34, 255, 0.25);
      }

      

      
      .form-control-custom {
          height: 3rem;
          font-size: 1.2rem; 
      }
      .erro-email{
        color: red;
        font-size: 18px;
        margin-bottom: 10px;
        text-align: center;
        font-weight: 600;
        font-style: italic;
      }
      .img-logo{
        width: 60vh;
      }

      .container{
        margin-top: 20vh;
      }
    </style>
  </head>
  <body>
    
    <div class="container mt-4">
      <div class="container d-flex justify-content-center mb-5">
        <img src="img/logo-login.png" alt="" class="img-logo">
      </div>
      
      
        <div class="row align-items-center">
          <div class="col-md-10 mx-auto col-lg-5">
            <form class="p-4 p-mds-5 border rounded-3 bg-light" id="loginForm" action="login.php" method="post">
             
              <div class="form-floating mb-3">
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon2"><i class="bi bi-envelope"></i></span>
                  <input type="email" class="form-control form-control-custom" name="email" id="inputLogin" placeholder="Email" required>
                </div>
              </div>
  
              <div class="form-floating mb-3">
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon3"><i class="bi bi-lock"></i></span>
                  <input type="password" class="form-control form-control-custom" name="senha" id="inputPassword" placeholder="Senha" required>
                </div>
              </div>
              <?php
                if(isset($_GET['erro'])) { ?>
                    <div class="erro-email">
                        Email ou Senha invalidos !
                    </div>
               <?php } ?>
              
  
              <button class="w-100 btn btn-lg btn-success" type="submit">Entrar</button>
            </form>
          </div>
        </div>
      </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
