<div class="text-center"><br><br>
<div class="icone-cart">
  <div id="efeito-carrinho">
  <a href="../cart/cart.php">
    <i class="fa fa-shopping-cart" style="font-size:32px;"></i>
  </a>
  </div>
  <div class="wow pulse">
  <div class="font-cart-icon">
  <span class="badge badge-secondary badge-pill">
  <?php 

  $totalCarts  = getContentCart($pdo);
  if(isset($totalCarts)){
    echo count($totalCarts);
  }
  ?>
  </span>
  </div>
  </div>
</div>
</div>