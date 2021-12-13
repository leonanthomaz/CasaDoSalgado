<?php
// Inicialize a sessão
session_start();

require_once "../../models/config.php";

// Verifique se o usuário está logado, se não, redirecione-o para uma página de login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login/login.php");
    exit;
}
?>
 
 <?php include("./includes/header.php"); ?>


 <?php include("./includes/whatsapp.php"); ?>


 <div class="navibar-color">
<nav class="navbar navbar-expand-lg navbar-dark ">  <div class="container-fluid">
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
          <a class="nav-link" aria-current="page" href="./main-client-area.php"><i class="far fa-edit"></i> Minha área</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="./my-orders.php"><i class="far fa-file-alt"></i> Meus Pedidos</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" href="./update_profile.php"><i class="fa fa-user" aria-hidden="true"></i> Minhas informações</a>
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

<main>
<div class="body-cliente-area"><br>
      <div class="text-center">
        <div class="wow fadeInDown">
            <a href="#">
            <?php include_once "../public/includes/logo-amarelo.php"; ?> 
            </a> 
        </div>          
      </div>

    <?php
    require_once "../../models/classes/classes.php";
    //Chamando a instância
    $listarUsuario = new UsuarioCliente();
    $lista = $listarUsuario->listarUsuariosCliente($pdo);
      
    foreach($lista as $user):
    $usuario = array(
    'cliente' => $user['cliente'],
    'localidade' => $user['localidade'],
    );

    //var_dump($linha);
    include "../public/includes/local-name.php"
    ?>

    <div class="titulo"><h5 style="color: white;"><b><?php echo htmlspecialchars($user["cliente"]); ?></b>, insira sua nova região abaixo!</h5></div><br>

      <div class="card"><br>
        <div class="bloco_cliente"><br>
           <div class="text-center">
            <div class="index-descricao"><h3 style="color:black">Minha<span style="color:gold"> Região</span></h3></div><br>
          </div>
            
            <form action="../../controllers/actions/actions-client/send-client-update-local.php" enctype="multipart/form-data" method="POST">
  
              <div class="text-center">
                <strong><label>Sua região ainda é: <?php echo $local ?>?</strong>
                <p>Se não for, marque sua nova região abaixo</p>
                <select name="localidade" class="form-control">
                    <option value="<?php echo $user['localidade'] ?>">Atualizar Região</option>
                    <?php include "../public/includes/list-select-local.php" ?>
                </select><br>
                <button onclick="javascript:return confirm('Deseja realmente atualizar sua região?');" class="btn btn-warning" name="enviar_local" type="submit">Atualizar perfil</button>
              </div>
            </form><br>
        </div>
      </div><br><br>

      <?php endforeach; ?>

      <div class="text-center">
        <div class="titulo"><h5 style="color: white;">Está tudo certo e não precisa atualizar?</h5><br> 
          <a class="btn btn-warning" href="../cart/checkout.php">Clique aqui para finalizar seu pedido!</a>
        </div>
        </div><br><br><br>
</div>
</main>


<?php include("./includes/footer.php"); ?>
