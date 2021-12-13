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


<div class="body-adm"><br>

  <!-- Logo principal -->
  <?php include_once "../public/includes/logo-amarelo.php"; ?> 

  <?php
    $pesquisarUsuario = $_POST['search-users'];
    $query = $pdo->prepare("SELECT * FROM users WHERE username LIKE '%$pesquisarUsuario%' LIMIT 5");
    $query->execute();
  if($query->rowCount()){
    while ($usuario = $query->fetch(PDO::FETCH_ASSOC)) : 
      extract($usuario);
      //var_dump($localidade);
      ?>
      <?php include "../public/includes/local-name.php"; ?>
        <div class="bloco-show-users"> 
          <div class="text-center">
          <h3 style="color: white;">Usuário<span style="color: purple; font-size: 100%"> Encontrado:</span></h3><br><br>
          </div>
          <span><i class="fas fa-exclamation-circle"></i> <b>ID: </b> <?php echo $id ?> </span><br>
          <span><i class="fa fa-user" aria-hidden="true"></i> <b>Usuário: </b><?php echo $cliente ?></span><br>
          <span><i class="fa fa-envelope" aria-hidden="true"></i> <b>Email: </b><?php echo $email ?></span><br>
          <span><i class="fa fa-phone" aria-hidden="true"></i> <b>Telefone: </b><?php echo $telefone ?></span><br>
          <span><i class="fas fa-map-marker-alt"></i></i> <b>Endereço: </b><?php echo $endereco ?></span><br>
          <span><i class="fas fa-map-marker-alt"></i> <b>Ponto de Referência: </b><?php echo $ponto ?></span><br>
          <span><i class="fas fa-map-marker-alt"></i> <b>Região onde mora (atual): </b><?php echo $local ?></span><br>
          <span><i class="fas fa-money-bill-alt"></i> <b>Data do cadastro: </b><?php echo (new DateTime($usuario['created_at']))->format("H:i:s d/m/Y") ?></span><br>
        </div>

        <!-- Botão voltar -->
        <a href="./dashboard_users.php" style="color: white; font-size:24px; margin-left: 10px"><i class="fa fa-arrow-left" aria-hidden="true" ></i> <span style="color: white; font-size: 20px">Voltar</span></a>

    <?php endwhile; 
  }else{
  echo "
  <div class='text-center'>
  <span style='color: red;'>Usuário não encontrado!</span>
  </div>";
  }

?>
</div>

<?php include "./includes/footer.php"; ?>
