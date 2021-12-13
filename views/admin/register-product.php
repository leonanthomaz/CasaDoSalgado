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
        <a class="nav-link " href="./orders.php"><i class='bx bx-bookmark nav_icon'></i> Pedidos</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle"  href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class='bx bx-user nav_icon'></i> Usuários
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="./dashboard_users.php">Todos usuários</a>
          <a class="dropdown-item" href="./atualizar-usuario.php">Atualizar usuário</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color: white;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

<div class="body-adm"><br>
  
  <!-- Logo principal -->
  <?php include_once "../public/includes/logo-amarelo.php"; ?> 
  
    <div class="text-center"><h3 style="color:white; font-family: 'Fredoka One', cursive; font-size: 250%">Cadastrar<span style="color:gold; font-family: 'Fredoka One', cursive;"> Produto</span></h3></div><br>

    <div class="box-form-dash">
      <div class="box-form-dashuser-inside">
      <form method="POST" enctype="multipart/form-data" action="../../controllers/actions-admin/send-product.php">
          <div class="text-center">
              <h3 style="color: white;">Produto</h3>
          </div><br>
          <div class="form-group">
              <strong>Nome do Produto</strong><br>
              <input type="text" name="produto" class="form-control" value="">
          </div><br>
          <div class="form-group">
              <strong>Valor do Produto (R$)</strong><br>
              <input type="number" step="0.01" name="valor_unitario" class="form-control" value="">
          </div><br>
          <div class="form-group">
              <strong>Descrição (max 100 caracteres)</strong><br>
              <input type="text" name="descricao" class="form-control" value="">
          </div><br>
          <div class="form-group">
              <strong>Imagem</strong><br>
              <input type="file" name="imagem" class="form-control" value="">
          </div><br>
          <div class="form-group">
              <strong>Categoria</strong><br>
              <select name="categoria" class="form-control" value="">
                  <option>Selecione a categoria</option>
                  <option value=1>Porções</option>
                  <option value=2>Bebidas</option>
                  <option value=3>Combos</option>
                  <option value=4>Yakisobas</option>
              </select>
          </div><br>
          <input class="btn btn-warning" type="submit" value="Cadastrar Produto"/>
      </form>
      </div>
    </div>

</div>

<?php include "./includes/footer.php"; ?>
