<?php
// Inicialize a sessão
session_start();
// Verifique se o usuário está logado, se não, redirecione-o para uma página de login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    //header("location: ./login/login.php");
    header("location: ../../index.php");
    exit;
}
?>

<?php 
require_once "./includes/header.php";
include_once "../../models/config.php";
require_once "../../controllers/functions/cart-function/cart_function.php";
require_once "../../controllers/functions/product_function/product_function.php";
require_once "../../controllers/functions/client-functions/stages-of-the-day.php";

?>

<?php include "../public/includes/navbar.php"; ?>

<?php if(isset($_SESSION["loggedin"])): ?>
<?php include "../pages/includes/icone-cart.php"; ?>
<?php endif; ?>

  <div class="text-center"><br>

    <?php 
    include_once "../pages/includes/welcome.php";
    ?>

    <div class="" style="font-family: 'Lobster', cursive; color:white; font-size: 200%">
      <h4><i><strong><?php echo saudacao( $login ); ?>!</strong></i></h4>
    </div><br>

    <div class="wow fadeInDown">
      <?php include_once "../public/includes/logo-amarelo.php"; ?>
    </div><br>

    <?php include_once "./includes/social-network.php"; ?>
        
    <h1 style="color:white;">Como podemos te ajudar?</h1>

    <h1 style="color:yellow;">Cardápio</h1><br>

    <div class="container">
      <?php include_once "./includes/category.php"; ?>
    </div>
    
  </div>

  <div class="container marketing">
          <hr class="featurette-divider" style="color:white;">
  </div><br>

  <div class="text-center">
      <h1 style="color:white;">Deseja encomendar?</h1>
      <h2 style="color:yellow;">Chame no whatsapp!</h2><br>
      <div class="whatsapp-principal">
        <a href="https://wa.me/5521996416049" class="icoWhatsapp" title="Whatsapp">
        <div class="wow bounceInLeft"><img src="../../views/public/img/whatsapp-icon-seeklogo.com.svg" width="50"/></div>
        <h1 style="color:white;">(21) 99641-6049</h1>
        </a>
      </div>
  </div><br>
      
<?php require_once "./includes/footer.php"; ?>