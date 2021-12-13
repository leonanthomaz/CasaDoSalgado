<?php 
session_start();
require_once "../../models/config.php";
if(isset($_SESSION["username"]) && is_array($_SESSION["username"])){

    $adm  = $_SESSION["username"][1];
    $nome = $_SESSION["username"][0];
}else{
  echo "<script>window.location = '../index.php'</script>";
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
          <a class="nav-link dropdown-toggle" style="color: white;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

<div class="body-adm"><br>


  <!-- Logo principal -->
  <?php include_once "../public/includes/logo-amarelo.php"; ?> 

   <div class="text-center"><h2 style="color: white;">Bloco total de usuários cadastrados no sistema:</h2><br></div>
    <div class="text-center">
      <div class="box-form-dashuser">
        <h5>Pesquisar Usuário</h5>
        <div class="form-group">
          <form method="POST" action="search-users.php"><br>
            <input class="form-control" type="text" name="search-users" placeholder="Pesquisar"><br>
            <input class="botao-procurar-usuarios" type="submit" value="Procurar">
          </form><br>
        </div>
      </div>
    </div>

    <?php if($adm): ?>

      <?php
      include "../../models/classes/classes.php";
      //Chamando a instância
      $listarUsuario = new ListaUsuarioADM();
      $usuarios = $listarUsuario->listarUsuariosADM($pdo);
      ?>
      <?php foreach($usuarios as $usuario): ?>

      <?php include "../public/includes/local-name.php";?>

      <div class="bloco-show-users">
       <h5 style="color: purple;">Usuário</h5><br>
        <span><b>ID:</b> <?php echo $usuario["id"]; ?></span><br>
        <span><b>Cliente: </b> <?php echo $usuario["cliente"];?> </span><br>
        <span><b>Nome de usuário:</b> <?php echo $usuario["username"]; ?></span><br>
        <span><b>Email: </b> <?php echo$usuario['email']; ?></span><br>
        <span><b>Telefone: </b> <?php echo $usuario['telefone']; ?> </span><br>
        <span><b>Endereço: </b> <?php echo $usuario['endereco']; ?> </span><br>
        <span><b>Ponto de Referência: </b><?php echo $usuario['ponto']; ?> </span><br>
        <span><b>Região onde mora (atual): </b><?php echo $local; ?> </span><br>
        <span><b>Data do cadastro: </b><?php echo (new DateTime($usuario["created_at"]))->format('H:i:s d/m/Y') ?></span><br>
        <?php 
        if($usuario['adm']  == $adm){
            echo '<span style="color: green">Usuário é um administrador</span>';
        }else{
            echo'<span style="color: red">Usuário não é administrador</span>';
        }
        ?>
      </div><br>
    <?php endforeach; ?>

  <?php endif; ?>  
</div>

<?php include "./includes/footer.php"; ?>
