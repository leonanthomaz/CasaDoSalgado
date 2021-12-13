<?php 
session_start();
require_once "../../models/config.php";
if(isset($_SESSION["username"]) && is_array($_SESSION["username"])){
    $adm  = $_SESSION["username"][1];
    $nome = $_SESSION["username"][0];
}else{
  echo "<script>window.location = '../../index.php'</script>";
}
?>

<?php include "./includes/header.php"; ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
  <a class="navbar-brand" href="#"><img src="../../views/public/img/casaamarela.png" width="100"/></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="./dashboard_adm.php"><i class='bx bx-bar-chart-alt-2 nav_icon'></i> Dashboard</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" href="./orders.php"><i class='bx bx-bookmark nav_icon'></i> Pedidos</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class='bx bx-user nav_icon'></i> Usuários
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="./dashboard_users.php">Todos usuários</a>
          <a class="dropdown-item" href="./update-users.php">Atualizar usuário</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fab fa-product-hunt"></i> Produtos
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="./update-product.php">Atualizar Produtos</a>
          <a class="dropdown-item" href="./register-product.php">Cadastrar Produtos</a>
          </div>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="./stats.php"><i class='bx bx-bar-chart-alt-2 nav_icon'></i> Estatítiscas</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="../../controllers/connect/logout.php" id=""><i class='bx bx-log-out nav_icon'></i> Sair</a>
        </li>
        <li class="nav-item">
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="body-cliente-area"><br>
      <!-- Logo principal -->
      <?php include_once "../public/includes/logo-amarelo.php"; ?> 

      <!-- Titulo e data e hora local -->
      <div class="text-center">
      <div class="cliente-descricao"><h3 style="color:white; font-size: 250%">Histórico de<span style="color:gold;"> Pedidos</span></h3></div><br>
      <div><b>Hora atual:</b> <?php date_default_timezone_set('America/Sao_Paulo');
          echo date('H:i:s d/m/Y '); ?></div>
      </div>
      
      <!-- Campo de pesquisa de usuários -->
      <div class="text-center">
      <div class="box-form-dashuser"><br>
        <h5>Pesquisar Pedido</h5>
        <div class="form-group">
          <form method="POST" action="search-orders.php">
          <select name='search-orders' class='form-control'>
              <?php include "../public/includes/list-select-status.php"; ?>
            </select><br>
            <input class="botao-procurar-usuarios" type="submit" value="Procurar">
          </form>
        </div>
      </div>
      </div><br>

    <!-- Bloco atualizar e imprimir pagina -->
    <div class="col-sm-8">						
        <a href="" class="btn btn-primary"><i class="material-icons">&#xE863;</i> <span>Atualizar</span></a>
        <a href="#" onclick="window.print()" class="btn btn-info"><i class="material-icons">&#xE24D;</i> <span>Print</span></a>
    </div>
   
    <?php
      //Receber o número da página
      $pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
      $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

      //Setar a quantidade de registros por página
      $limite_resultado = 2;

      // Calcular o inicio da visualização
      $inicio = ($limite_resultado * $pagina) - $limite_resultado;

      $query_usuarios = "SELECT * FROM users as u  join pedidos as pe on u.id = pe.id_usuario ORDER BY pe.id DESC LIMIT $inicio, $limite_resultado";
      $result_usuarios = $pdo->prepare($query_usuarios);
      $result_usuarios->execute(); 


      if (($result_usuarios) AND ($result_usuarios->rowCount() != 0)) {
        while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) :
          extract($row_usuario);
          ?>

        <?php          
          include "../public/includes/orderStatus.php";
          include "./includes/local-name-orders.php";
          include "../public/includes/payment.php";
        ?>

          <div class=''>
            <div class='bloco-show-cliente'><br>
              <div class='bloco_cliente'><br>
                <div class='pedido_numero'><h4>Pedido:<?php echo $id ?> </h4></div><br>
                  <div class="text-center">
                  <i class='bx bx-bookmark nav_icon'></i><strong> Status do Pedido:</strong><?php echo $StatusInfo ?><br>
                  <?php
                  if($cancelamento == 1){
                    echo "
                    <div class='info-status'>
                    <strong><b>Observação: </b></strong><strong style='color: red;'>Cancelado pelo usuário!</strong>
                    </div><br>
                    ";
                  }
                  ?>
                  </div>
                  <i class="fa fa-user" aria-hidden="true"></i><strong> Cliente: </strong><?php echo $cliente ?><br>
                  <i class="fas fa-flag"></i><strong> Nome de usuário: </strong><?php echo $username ?><br>
                  <i class="fa fa-lock" aria-hidden="true"></i><strong> Identificação: </strong><?php echo $id_usuario ?><br>
                  <div class='bloco-descricao-pedido'>
                  <i class="far fa-edit"></i><strong style='color: purple;'> Itens do pedido: </strong><hr>

                  <?php include "../../controllers/functions/adm-functions/listagem-itens-orders-adm.php"; ?>

                  </div><br>

                  <strong><i class="fas fa-money-bill-alt"></i> Subtotal: </strong><?php echo "R$" .number_format($SubTotal, 2, ',', '.'). ""  ?><br>
                  <hr>
                  <strong><i class="fas fa-money-bill-alt"></i> Taxa de entrega: </strong><?php echo "R$" .number_format($frete, 2, ',', '.'). ""  ?><br>
                  <hr>
                  <strong><i class="fas fa-money-bill-alt"></i> Total: </strong><?php echo "R$" .number_format($total, 2, ',', '.'). "" ?><br>
                  <hr>
                  <strong><i class="fas fa-map-marker-alt"></i> Local do Pedido: </strong><?php echo $localidade ?><br>
                  <hr>
                  <strong><i class="fas fa-cash-register"></i> Forma de pagamento: </strong> <?php echo $formaDePagamento ?>
                  <hr>
                  <strong><i class="fas fa-exclamation-circle"></i> Observação: </strong><?php echo $observacao ?><br>
                  <hr>
                  <strong><i class="fa fa-calendar" aria-hidden="true"></i> Data e Hora do Pedido: </strong> <?php echo (new DateTime($dt_pedido))->format('d/m/Y H:i:s') ?><br>
                  <hr>

                  <div class="text-center"><br>
                  <h3 style="color: gold;">Atualizar<span style="color: purple; font-size: 100%"> Status:</span></h3>
                  </div>
                  <div class='formulario_adm'>
                  <form method='POST' action='orders.php'>
                  <div class='form-group'>
                  <input type='hidden' name='finalizarpedido' value='<?php echo $id ?>'><br>
                  <select  name='mudarStatus' class='form-control'>
                    <?php include "../public/includes/list-select-status.php"; ?>
                  </select><br>
                  <div class='text-center'><button onclick="javascript:return confirm('Deseja realmente alterar o status deste pedido?');" type='submit' class='btn btn-warning btn-sm' name='finalizaStatus' value='finalizarStatus' >ENVIAR</button></div>
                  </div><br>
                  </form>
                  </div> <br>

                  <?php
                  require_once "../../controllers/actions-admin/update-status-orders.php";
                  ?>

                  <hr>
              </div>
            </div>
          </div>
          <hr>
        <?php endwhile; ?>

        <?php
        include "../public/includes/pages-orders.php";
      }
      else{
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
        
<?php include "./includes/footer.php"; ?>
