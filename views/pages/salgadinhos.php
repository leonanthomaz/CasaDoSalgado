<?php
session_start();
include_once "../../models/config.php";
require_once "../../controllers/functions/cart-function/cart_function.php";
require_once "../../controllers/functions/product_function/product_function.php";
require_once "../../controllers/functions/global-functions/opening-hours.php";
require_once "../../controllers/functions/client-functions/stages-of-the-day.php";
?>

<?php include "../pages/includes/header.php"; ?>

<?php include "../pages/includes/navbar.php"; ?>

<?php if(isset($_SESSION["loggedin"])): ?>
<?php include "../pages/includes/icone-cart.php"; ?>
<?php endif; ?>

<div class="text-center"><br>

  <?php include_once "../public/includes/logo-amarelo.php"; ?>

  <h3 style="color: white; font-size: 220%;">Porções</h3><br>

  <?php include "../pages/includes/modal-sabores.php"; ?>

  <div class="wow bounceInLeft"><div class="categoria">
    <div class="sessao_categorias"><a href="#">Porções</a></div>
    <div class="sessao_categorias"><a href="./combos.php">Combos</a></div>
    <div class="sessao_categorias"><a href="./bebidas.php">Bebidas</a></div>
  </div></div><br>

  <?php 	
  $products = getPorcoes($pdo);
  ?>

  <main>
    <?php include "../pages/includes/cart-box.php"; ?>
  </main>

</div>

<?php include "../pages/includes/footer.php"; ?>
