
<div class="container" style="margin: auto;">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <?php foreach($products as $product) : ?>
        <div class="col" style="min-width: 300px;">
        <div class="wow fadeInDown">
          <div class="bloco-carrinho_item">
            <div class="img_dashboard">
              <img src="<?php echo $product['imagem']?>"  width="100%" height="225"  role="img">
            </div><br>
            <div class="titulo-item"><h3 class="card-title"><?php echo $product['produto']?></h3></div><br>
            <div class="descricao"><p><i><?php echo $product['descricao']?></i></p></div>
              <div class="valor"><h5>R$<?php echo number_format($product['valor_unitario'], 2, ',', '.')?></h5></div><br>
                <div><i class="fa fa-hourglass" aria-hidden="true"></i> Tempo médio para entrega: 20 a 30 minutos</div><br>
               <!-- Button trigger modal -->
                <a data-toggle="modal" data-target="#AlertaSabores">
                Como personalizar? Clique aqui <i class="fas fa-arrow-right"></i> <i class="fas fa-exclamation-triangle" style="color:gold; cursor: pointer;"></i>
                </a><br><br>
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