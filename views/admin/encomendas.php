<?php 
session_start();
require_once "../config/config.php";
if(isset($_SESSION["username"]) && is_array($_SESSION["username"])){

    $adm  = $_SESSION["username"][1];
    $nome = $_SESSION["username"][0];
}else{
  echo "<script>window.location = '../index.php'</script>";
}
?>

<?php include "./includes/header.php"; ?>


<div class="body-cliente-area"><br>

      <div class="text-center">
        <div class="wow fadeInDown">
            <a href="#">
                <img src="../views/img/casaamarela.png" width="250"/> 
            </a> 
        </div>          
      </div><br>

      <div class="text-center">
      <div class="cliente-descricao"><h3 style="color:white; font-size: 250%">Histórico de<span style="color:gold;"> Encomendas</span></h3></div><br>
      </div>

      <div class="text-center">
      <div class="box-form-dashuser"><br>
        <h5>Pesquisar Pedido</h5>
        <div class="form-group">
          <form method="POST" action="search-orders.php">
            <select name='search-orders' class='form-control'>
                    <option>Selecione o Status do Pedido</option>
                    <option value=0>Pedido Realizado</option>
                    <option value=1>Pedido Confirmado</option>
                    <option value=2>Pedido em preparo</option>
                    <option value=3>Pedido a Caminho</option>
                    <option value=4>Pedido Entregue</option>
                    <option value=5>Pedido Cancelado</option>
            </select><br>
            <input class="botao-procurar-usuarios" type="submit" value="Procurar">
          </form>
        </div>
      </div>
      </div><br>

   
    <?php

    //Receber o número da página
    $pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
    //var_dump($pagina);

    //Setar a quantidade de registros por página
    $limite_resultado = 3;

    // Calcular o inicio da visualização
    $inicio = ($limite_resultado * $pagina) - $limite_resultado;


    $query_usuarios = "SELECT * FROM encomendas ORDER BY id DESC LIMIT $inicio, $limite_resultado";
    $result_usuarios = $pdo->prepare($query_usuarios);
    $result_usuarios->execute(); 


    if (($result_usuarios) AND ($result_usuarios->rowCount() != 0)) {
      while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) :
        //var_dump($row_usuario);
        extract($row_usuario);
      ?>

        <?php

        date_default_timezone_set('America/Sao_Paulo');
        $dataLocal = date('d/m/Y', time());
        $Prazo = date('d/m/Y', strtotime("+2 days",strtotime($data_encomenda)));
        echo $Prazo;
        //echo $data_encomenda;
        //echo $data_escolhida;
        if($Prazo <= $dataLocal){
            $sql = $pdo->prepare("UPDATE encomendas SET ativo = 3 WHERE id = '$id'");
            $sql->execute();
        }else{
            $sql = $pdo->prepare("UPDATE encomendas SET ativo = 2 WHERE id = '$id'");
            $sql->execute();
        }
        if($sql == true){
            echo "Encomendas atualizadas com sucesso!";
        }else{
            echo "Erro do cacete";
        } 
        
        ?>
        
      <div class=''>
        <div class='bloco-show-cliente'><br>
          <div class='bloco_cliente'><br>
            <div class='pedido_numero'><h4> Encomenda: <?php echo $id ?> </h4></div><br>

            <div class="text-center">
            <?php
            if($ativo == 1){
                $Status = "Pendente";
            }else if($ativo == 2){
                $Status = "Cancelado";
            }else if($ativo == 3){
                $Status = "Pagamento Confirmado";
            }
            ?>
            <i class='bx bx-bookmark nav_icon'></i><strong> Status do Pedido: </strong><?php echo $Status ?><br>
            <?php
            
            ?>
            </div><br>
            <i class="fa fa-user" aria-hidden="true"></i><strong> Cliente: </strong><?php echo $cliente ?><br>
            <i class="fa fa-lock" aria-hidden="true"></i><strong> Identificação: </strong><?php echo $id_cliente ?><br><br>
            <div class='bloco-descricao-pedido'>
            <i class="far fa-edit"></i><strong style='color: purple;'> Sabores escolhidos: </strong><hr>
            <?php
            if($opcao == 1){
                $item = "300 salgadinhos (R$300,00)";
            }else if($opcao == 2){
                $item = "500 salgadinhos (R$500,00)";
            }else if($opcao == 3){
                $item = "1000 salgadinhos (R$1000,00)";
            }

            if($pagamento == 1){
                $formaDePagamento = "<div style='color: green;'>Pagamento em Dinheiro</div>";
              }else if($pagamento == 2){
                $formaDePagamento = "<div style='color: blue;'>Pagamento em Cartão</div>";
              }else if($pagamento == 3){
                $formaDePagamento = "<div style='color: purple;'>Pagamento via Pix</div>";
              }else{
                $formaDePagamento = "Não informado!";
              }

            
            ?>
            <div><strong> Opção escolhida: </strong><?php echo $item ?></div>
            <div><strong> Sabores: </strong><?php echo $sabores ?></div>
            </div><br>

            <hr>
            <strong><i class="fa fa-calendar" aria-hidden="true"></i> Data: </strong><?php echo (new DateTime($data_escolhida))->format('d/m/Y') ?><br>
            <hr>
            
            <strong><i class="far fa-edit"></i> Observação: </strong><?php echo $observacao ?><br>
            <hr>
            <strong><i class="fa fa-calendar" aria-hidden="true"></i> Data da encomenda: </strong><?php echo (new DateTime($data_encomenda))->format('d/m/Y H:i:s')?>
            <hr>
            <strong><i class="fa fa-calendar" aria-hidden="true"></i> Prazo para pagamento: </strong><?php echo $Prazo?>
            <hr>
            <strong><i class="fa fa-calendar" aria-hidden="true"></i> Forma de pagamento: </strong><?php echo $formaDePagamento?>
            <hr>
            <br><br>

          </div>
        </div>
      </div>
      <hr>
        
      <?php endwhile; ?>
      <?php
      //Contar a quantidade de registros no BD
      $query_qnt_registros = "SELECT COUNT(id) AS num_result FROM encomendas";
      $result_qnt_registros = $pdo->prepare($query_qnt_registros);
      $result_qnt_registros->execute();
      $row_qnt_registros = $result_qnt_registros->fetch(PDO::FETCH_ASSOC);

      //Quantidade de página
      $qnt_pagina = ceil($row_qnt_registros['num_result'] / $limite_resultado);

      // Maximo de link
      $maximo_link = 2;

      echo "<div class='text-center'>";
      echo "<a class='page-item' href='orders.php?page=1'>Primeira</a> ";

      for ($pagina_anterior = $pagina - $maximo_link; $pagina_anterior <= $pagina - 1; $pagina_anterior++) {
          if ($pagina_anterior >= 1) {
              echo "<a class='page-item' href='orders.php?page=$pagina_anterior'>$pagina_anterior</a> ";
          }
      }

      echo "<a class='page-atual'>$pagina</a>";

      for ($proxima_pagina = $pagina + 1; $proxima_pagina <= $pagina + $maximo_link; $proxima_pagina++) {
          if ($proxima_pagina <= $qnt_pagina) {
              echo "<a class='page-item' href='orders.php?page=$proxima_pagina'>$proxima_pagina</a> ";
          }
      }
      echo "<a class='page-item' href='orders.php?page=$qnt_pagina'>Última</a> ";
      echo "</div>";
      }else{
          echo "
          <div class='text-center'><br><br>
          <div style='color: red;'>Nenhum pedido encontrado!</div>
          </div>
          ";
          //echo "
          /*
          <div class='text-center'><br><br>
          <a class='page-item' href='orders.php?page=1'>Voltar para primeira página</a>
          </div>
          */
          //";
        
      }

  ?>


         
</div>    
</div>
        
<?php include "./includes/footer.php"; ?>
