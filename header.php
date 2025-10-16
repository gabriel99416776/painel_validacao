<?php

?>
<!-- -------------- Navegação do Header + Responsividade do Dropdown ------------ -->
<style>
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
        
    </nav>