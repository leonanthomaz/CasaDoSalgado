<?php
session_start();
include_once "../../models/config.php";
require_once "../../controllers/functions/cart-function/cart_function.php";
require_once "../../controllers/functions/product_function/product_function.php";
require_once "../../controllers/functions/global-functions/opening-hours.php";
require_once "../../controllers/functions/client-functions/stages-of-the-day.php";

?>

<?php require_once "./includes/header.php"; ?>

<?php include "../pages/includes/navbar.php"; ?>

<?php if(isset($_SESSION["loggedin"])): ?>
<?php include "../pages/includes/icone-cart.php"; ?>
<?php endif; ?>

<div class="text-center"><br>

  <?php include_once "../public/includes/logo-amarelo.php"; ?>

  <h3 style="color: white; font-size: 220%;">Combos</h3><br>

  <?php include "../pages/includes/modal-sabores.php"; ?>

  <div class="wow bounceInLeft"><div class="categoria">
        <div class="sessao_categorias"><a href="./salgadinhos.php">Porções</a></div>
        <div class="sessao_categorias"><a href="#">Combos</a></div>
        <div class="sessao_categorias"><a href="./bebidas.php">Bebidas</a></div>
  </div></div><br>

  <?php 	
  $products = getCombo($pdo);
  ?>

  <main>
    <?php include "../pages/includes/cart-box.php"; ?>
  </main>

</div>

<?php require_once "./includes/footer.php"; ?>