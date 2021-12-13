<?php
session_start();
include_once "../config/config.php";
require_once "../functions/cart_function.php";
require_once "../../controllers/functions/global-functions/opening-hours.php";
require_once "../../controllers/functions/client-functions/stages-of-the-day.php";
?>

<?php include("./includes/header.php"); ?>

<?php if(isset($_SESSION["loggedin"])): ?>
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
<?php endif; ?>

<div class="text-center"><br>

    <div class="wow fadeInDown">
            <div class="img-card">
                <a href="#">
                    <img src="../views/img/logo.png"/> 
                </a> 
            </div>
    </div><br>

  <h3 style="color: white; font-size: 220%;">Yakisobas</h3><br>


  <div class="wow bounceInLeft"><div class="categoria">
        <div class="sessao_categorias"><a href="./salgadinhos.php">Porções</a></div>
        <div class="sessao_categorias"><a href="./bebidas.php">Bebidas</a></div>
        <div class="sessao_categorias"><a href="./combos.php">Combos</a></div>
        <div class="sessao_categorias"><a href="./yakisobas.php">Combos</a></div>
  </div></div><br>

  <?php 	
  $products = getYakisoba($pdo);
  ?>
<main>
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <?php foreach($products as $product) : ?>
        <div class="col">
        <div class="wow fadeInDown">
          <div class="bloco-carrinho_item">
            <div class="img_dashboard">
              <img src="<?php echo $product['imagem']?>"  width="100%" height="225"  role="img">
            </div><br>
            <div class="titulo-item"><h3 class="card-title"><?php echo $product['produto']?></h3></div><br>
            <div class="descricao"><p><i><?php echo $product['descricao']?></i></p></div>
              <div class="valor"><h5>R$<?php echo number_format($product['valor_unitario'], 2, ',', '.')?></h5></div><br>
                <div><i class="fa fa-hourglass" aria-hidden="true"></i> Tempo médio para entrega: 20 a 30 minutos</div><br>
                <div class="botao">

                <?php 
                $bloqueioCliente = horarioFuncionamento();
                if ($bloqueioCliente == false){
                  echo '<p><a class="btn btn-warning" href="../cart/cart.php?acao=add&id='.$product['id_produto'].'" class="card-link">Adicionar ao Carrinho</a></p>';
                }else{
                  echo $bloqueioCliente;
                }
                ?> 
                </div>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
</main>


<?php include("./includes/footer.php"); ?>