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
        <li class="nav-item">
        <a class="nav-link" href="./dashboard_users.php"><i class='bx bx-user nav_icon'></i> Usuários</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="./update-users.php"><i class='bx bx-user nav_icon'></i> Atualizar Usuário</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="./update-product.php"><i class='bx bx-user nav_icon'></i> Atualizar Produtos</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="./register-product.php"><i class='bx bx-user nav_icon'></i> Cadastrar Produtos</a>
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

<div class="body-adm"><br>

  <!-- Logo principal -->
  <?php include_once "../public/includes/logo-amarelo.php"; ?> 

  <div class="text-center"><h2 style="color: white;">Pedidos encontrados:</h2><br></div>

<?php
  $pesquisarPedido = $_POST['search-orders'];
  $queryPedido = $pdo->prepare("SELECT * FROM pedidos WHERE orderStatus LIKE '%$pesquisarPedido%' ORDER BY dt_pedido DESC LIMIT 5");
  $queryPedido->execute();
  
  if($queryPedido->rowCount()){
 
    while ($Pedido = $queryPedido->fetch(PDO::FETCH_ASSOC)):

      //var_dump($Pedido);
      include "../public/includes/payment.php";

      $orderStatus = $Pedido['orderStatus'];
      include "../public/includes/orderStatus.php";

      require_once "../../models/classes/classes.php";
      //Chamando a instância
      $listarUsuario = new ListaUsuarioADM();
      $usuarios = $listarUsuario->listarUsuariosADM($pdo);
      ?>

      <?php include "./includes/local-search-orders.php"; ?>
      
      <div class="bloco-listagem-usuarios-dashuser">  
          <strong><i class="fas fa-flag"></i>Status do Pedido: </strong><?php echo $StatusInfo ?><br>
          <?php foreach($usuarios as $usuario):?>
            <?php if ($Pedido['id_usuario'] == $usuario['id']): ?>

            <strong><i class="fas fa-exclamation-circle"></i> Identificação do Pedido: </strong><?php echo $usuario['id'] ?><br>
            <strong><i class="fa fa-user" aria-hidden="true"></i> Nome do Cliente: </strong><?php echo $usuario['cliente'] ?><br>
            <strong><i class="fa fa-phone" aria-hidden="true"></i> Telefone: </strong><?php echo $usuario['telefone'] ?><br>
            <strong><i class="fa fa-envelope" aria-hidden="true"></i> Email: </strong><?php echo $usuario['email'] ?> <br>
            <strong><i class="fas fa-map-marker-alt"></i></i> Endereço: </strong><?php echo $usuario['endereco'] ?> <br>
            <strong><i class="fas fa-map-marker-alt"></i> Ponto de Referência: </strong><?php echo $usuario['ponto'] ?> <br>
          
            <?php endif; ?>
          <?php endforeach;?>

          <strong><i class="fas fa-map-marker-alt"></i> Local do Pedido: </strong><?php echo $local ?><br>
          <strong><i class="fas fa-exclamation-circle"></i> Observação: </strong><?php echo $Pedido['observacao'] ?><br>
          <strong><i class="fas fa-money-bill-alt"></i> Taxa de entrega: </strong>R$<?php echo number_format($Pedido["frete"], 2, ',', '.') ?><br>
          <strong><i class="fas fa-money-bill-alt"></i> Total: </strong>R$<?php echo number_format($Pedido["total"], 2, ',', '.') ?><br>
          <strong><i class="fas fa-cash-register"></i> Forma de pagamento: </strong><?php echo $formaDePagamento ?><br>
          <strong><i class="fas fa-money-bill-alt"></i> Data do Pedido: </strong><?php echo (new DateTime($Pedido['dt_pedido']))->format('d/m/Y H:i:s') ?> <br>
        </div>
      </div><br>
    <?php endwhile;

  }else{
    echo "
    <div class='text-center'>
    <h3 style='color: red;'>Pedido não encontrado!</h3>
    </div>";
  }

?>
</div>

<?php include "./includes/footer.php"; ?>
