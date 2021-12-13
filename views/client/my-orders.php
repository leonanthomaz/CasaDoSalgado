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
 
 
 <?php include("./includes/header.php"); ?>

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
            <a class="nav-link " aria-current="page" href="./main-client-area.php"><i class="far fa-edit"></i> Minha área</a>
          </li>
          <li class="nav-item">
          <a class="nav-link active" href="./my-orders.php"><i class="far fa-file-alt"></i> Meus Pedidos</a>
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

<div class="body-cliente-area"><br>

  <div class="text-center">
    <!-- Logo principal -->
    <?php include_once "../public/includes/logo-amarelo.php"; ?> 
  </div>

  <div class="text-center">
    <div class="cliente-descricao"><h3 style="color:white; font-size: 250%">Meus<span style="color:gold;"> Pedidos</span></h3></div><br>
  </div>
   
  <?php
    //Receber o número da página
    $pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
    //var_dump($pagina);

    //Setar a quantidade de registros por página
    $limite_resultado = 3;

    // Calcular o inicio da visualização
    $inicio = ($limite_resultado * $pagina) - $limite_resultado;

    $id = $_SESSION['id'];

    $query_usuarios = "SELECT * FROM users as u join pedidos as pe on u.id = pe.id_usuario AND u.id = $id ORDER BY pe.id DESC LIMIT $inicio, $limite_resultado";
    $result_usuarios = $pdo->prepare($query_usuarios);
    $result_usuarios->execute(); 


    if (($result_usuarios) AND ($result_usuarios->rowCount() != 0)) {
      while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)):
        //var_dump($row_usuario);
        extract($row_usuario);
        ?>

        <?php          
          
          include "../public/includes/orderStatus.php";


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
                <div class='bloco-descricao-pedido'>
                  <i class="far fa-edit"></i><strong style='color: purple;'> Itens do pedido: </strong><hr>
                  <?php include "../../controllers/functions/client-functions/listagem-itens-orders-client.php"; ?>
                </div><br>

                <strong><i class="fas fa-money-bill-alt"></i> Subtotal: </strong><?php echo "R$" .number_format($SubTotal, 2, ',', '.'). ""  ?><br>
                <hr>
                <strong><i class="fas fa-money-bill-alt"></i> Taxa de entrega: </strong><?php echo "R$" .number_format($frete, 2, ',', '.'). ""  ?><br>
                <hr>
                <strong><i class="fas fa-money-bill-alt"></i> Total: </strong><?php echo "R$" .number_format($total, 2, ',', '.'). "" ?><br>
                <hr>
                <strong><i class="fas fa-cash-register"></i> Forma de pagamento: </strong> <?php echo $formaDePagamento ?><br>
                <hr>
                <strong><i class="fas fa-exclamation-circle"></i> Observação: </strong><?php echo $observacao ?><br>
                <hr>
                <strong><i class="fa fa-calendar" aria-hidden="true"></i> Data e Hora do Pedido: </strong> <?php echo (new DateTime($dt_pedido))->format('d/m/Y H:i:s') ?><br>
                <hr>

                <?php
                  if($orderStatus < 3 && $cancelamento < 1){
                ?>

                <div class="text-center"><br>   
                  <a data-toggle="modal" data-target="#AlertaCancelamento">
                  <strong style="cursor: pointer;">Solicitar cancelamento</strong>
                  <i class="fas fa-exclamation-triangle" style="color:red; cursor: pointer; font-size:24px;"></i>
                  </a><br><br>
                </div>
                
                <?php include "./includes/modal-cancellation.php"; ?>
                
                <div class='status_cliente'>
                  <form method='POST' action='my-orders.php'>
                  <input type='hidden' name='finalizarpedido' value='<?php echo $id ?>'><br>
                  <button onclick="javascript:return confirm('Deseja realmente cancelar seu pedido?');" type='submit' class='btn btn-xs btn-danger alinha-btn' name='finaliza' value='finalizar'>SOLICITAR CANCELAMENTO</button>
                  </form><br><br><br>
                </div>
    
                <?php
                }else{
                    $status;
                }

                if(isset($_POST['finaliza'])){

                  $atualizarstatus = $pdo->prepare("UPDATE pedidos SET cancelamento = 1 WHERE id='".$_POST["finalizarpedido"]."' ");
                  $atualizarstatus->execute(array($_POST["finalizarpedido"]));
                  $linha = $atualizarstatus->rowCount();
              
                  if($pdo == true){
                  $atualizarstatus = $pdo->prepare("UPDATE pedidos SET orderStatus = 6 WHERE id='".$_POST["finalizarpedido"]."' ");
                  $atualizarstatus->execute(array($_POST["finalizarpedido"]));
                  $linha = $atualizarstatus->rowCount();
                  echo "<script>alert('Pedido cancelado com sucesso!');</script>";
                  echo "<script>window.location = 'my-orders.php'</script>"; 
                  }
                }
                ?>

                <div class="titulo-status"><strong> Acompanhe o status do seu pedido:</strong></div>

                <div class="bloco-status">
                    <div class="track">
                        <?php include "./status-client.php"; ?>
                    </div>
                </div><br><br>

            </div>
          </div>
        </div>
        <hr>
        
        <?php endwhile; ?>
        <?php
        //Contar a quantidade de registros no BD
        $query_qnt_registros = "SELECT COUNT(id) AS num_result FROM pedidos WHERE id_usuario = $id_usuario";
        $result_qnt_registros = $pdo->prepare($query_qnt_registros);
        $result_qnt_registros->execute();
        $row_qnt_registros = $result_qnt_registros->fetch(PDO::FETCH_ASSOC);

        //Quantidade de página
        $qnt_pagina = ceil($row_qnt_registros['num_result'] / $limite_resultado);

        // Maximo de link
        $maximo_link = 2;

        echo "<div class='text-center'>";
        echo "<a class='page-item' href='my-orders.php?page=1'>Primeira</a> ";

        for ($pagina_anterior = $pagina - $maximo_link; $pagina_anterior <= $pagina - 1; $pagina_anterior++) {
            if ($pagina_anterior >= 1) {
                echo "<a class='page-item' href='my-orders.php?page=$pagina_anterior'>$pagina_anterior</a> ";
            }
        }

        echo "<a class='page-atual'>$pagina</a>";

        for ($proxima_pagina = $pagina + 1; $proxima_pagina <= $pagina + $maximo_link; $proxima_pagina++) {
            if ($proxima_pagina <= $qnt_pagina) {
                echo "<a class='page-item' href='my-orders.php?page=$proxima_pagina'>$proxima_pagina</a> ";
            }
        }
        echo "<a class='page-item' href='my-orders.php?page=$qnt_pagina'>Última</a> ";
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


</div><br><br>   

        
<?php include("./includes/footer.php"); ?>
