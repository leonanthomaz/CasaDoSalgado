<?php
// Inicialize a sessão
session_start();
include_once "../../models/config.php";

// Verifique se o usuário está logado, se não, redirecione-o para uma página de login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    //header("location: ./login/login.php");
    header("location: ../../index.php");
    exit;
}
?>
 
<?php include "./includes/header.php"; ?>

<?php include("./includes/whatsapp.php"); ?>
    
<div class="navibar-color">
  <nav class="navbar navbar-expand-lg navbar-dark ">  
    <div class="container-fluid">
    <a class="navbar-brand" href="../pages/dashboard.php"><img src="../public/img/casaamarela.png" alt="logo-casa-dos-salgados-amarelo" width="90"/></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../pages/dashboard.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#"><i class="far fa-edit"></i> Minha área</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="./my-orders.php"><i class="far fa-file-alt"></i> Meus Pedidos</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="./update_profile.php"><i class="fa fa-user" aria-hidden="true"></i> Minhas informações</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="../../controllers/connect/logout.php" id=""><i class="fas fa-sign-out-alt"></i> Sair</a>
            </li>
            <li class="nav-item">
            </li>
          </ul>
        </div>
    </div>
  </nav>
</div>

<div class="body-cliente-area">
  <div class="container">
      <div class="col">
          <div class="text-center">

          <!-- Logo principal -->
           <?php include_once "../public/includes/logo-amarelo.php"; ?> 

          </div>   
          <div class="text-center">
            <h3 style="color:white; font-size: 250%">Minha<span style="color:gold; font-size: 100%"> Área</span></h3>
            <br>
              <div class="bloco-caminho-cliente">
                <div class="text-center">
                    <div class="caminho-pedidos"><a href="./my-orders.php">Meus Pedidos</a></div><br> 
                    <div class="caminho-perfil"><a href="./update_profile.php">Minhas informações</a></div>
                </div>
            </div>
          </div>
      </div>
  </div>
</div><br>
         

<?php include("./includes/footer.php"); ?>
