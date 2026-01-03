<style>
    body{
        background-color: #f8f9fa;
    }
    nav{
        background-color: #edf2fb;
        border-bottom: 7px solid #288EFF;
    }
    .navbar-nav{
        margin-right: 40px;
    }
    .nav-link {
        color: #000;
        font-size: 17px;
        font-weight: 600;
       
    }

    a {
        color: #fff;
        text-transform: uppercase;
        text-decoration: none;
        letter-spacing: 0.15em;

        display: inline-block;
        padding: 15px 20px;
        position: relative;
    }

    a:after {
        background: none repeat scroll 0 0 transparent;
        bottom: 0;
        content: "";
        display: block;
        height: 2px;
        left: 50%;
        position: absolute;
        background: #604BFF;
        transition: width 0.3s ease 0s, left 0.3s ease 0s;
        width: 0;
    }

    a:hover:after {
        width: 100%;
        left: 0;
    }

    @media screen and (max-height: 300px) {
        ul {
            margin-top: 40px;
        }
    }
</style>



<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">

        <!-- LOGO -->
        <a class="navbar-brand" href="#">
            <img src="img/eurekha.png" alt="">
        </a>

        <!-- BOTÃO OFFCANVAS -->
        <button class="navbar-toggler d-lg-none border-0" type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU DESKTOP -->
        <div class="collapse navbar-collapse d-none d-lg-flex">
            <ul class="navbar-nav ms-auto gap-2">
                <li class="nav-item">
                    <a class="nav-link nav-btn" href="#">🏠︎ Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-btn" href="#">📱 Leitores</a>
                </li>
            </ul>
        </div>

    </div>
</nav>



<!-- OFFCANVAS (somente mobile) -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    Dropdown
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                </ul>
            </li>
        </ul>

        <form class="d-flex mt-3">
            <input class="form-control me-2" type="search" placeholder="Search">
            <button class="btn btn-outline-success">Search</button>
        </form>
    </div>
</div>





























<!-- -------------- Navegação do Header + Responsividade do Dropdown ------------ -->
<!-- <style>
    strong{
        font-weight: 600;
        font-size: 20px;
        font-style: italic;
        margin-left: 10px;
        text-transform: capitalize;
    }
    .profile-img{
        width: 45px;
    }
    .img-header{
        width: 250px;
        margin-top: 10px;
    }
</style>
<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
        <img src="img/logo-header.png" alt="" class="img-header">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                    <li class="nav-item">
                        <a class="nav-link active fs-5  fw-bold " aria-current="page" href="index.php">Inicio</a>
                    </li>
    
                    <li class="nav-item dropdown">
                        <a class="nav-link  fs-5 fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu <i class="bi bi-caret-right toggle-arrow"></i>
                        </a>
                        <ul class="dropdown-menu">
                        

                            <li><a class="dropdown-item dropdown-font-size" href="https://eurekha.com.br/admin/produtor/s_eventos.php" target="_blank"><i class="bi bi-calendar"></i> - Eventos</a></li> 

                        
                            <li><a class="dropdown-item dropdown-font-size" href="index.php"><i class="bi bi-journal-text"></i> - Resumo</a></li>
                            <li><a class="dropdown-item dropdown-font-size" href="validados.php"><i class="bi bi-bookmark-check-fill"></i> - Validados</a></li> 
                            <li><a class="dropdown-item dropdown-font-size" href="usuarios.php"><i class="bi bi-person-bounding-box"></i> - Clientes</a></li>
                            <li><a class="dropdown-item dropdown-font-size" href="clientecadastrado.php"><i class="bi bi-person-gear"></i> - Atualização de Foto</a></li>
                            <li><a class="dropdown-item dropdown-font-size" href="atualizarface.php"><i class="bi bi-person-lines-fill"></i> - Foto Em Tempo Real</a></li>
                      


                                <li><a class="dropdown-item dropdown-font-size" href="leitores.php"><i class="bi bi-reception-4"></i> - Leitores</a></li>
                                <li><a class="dropdown-item dropdown-font-size" href="cadastrofacial.php"><i class="bi bi-person-fill-add"></i> - Cadastro Facial</a></li>

                      
                            
                        </ul>
                    </li>
                    
    
                </ul>
                
                <ul class="navbar-nav mb-2 mb-lg-0 ml-auto align-items-center"> 
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bold text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="img/foto-usuario.jpg"  class="profile-img img-thumbnail rounded-circle mr-2"  alt="">
                            
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a class="dropdown-item" href="trocarsenha-form.php">Perfil</a></li>
                            <li><a class="dropdown-item" href="logout.php">Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            
        </div>
        
    </nav> -->