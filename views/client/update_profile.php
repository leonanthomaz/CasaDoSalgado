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
      </div><br> 

    <?php
    require_once "../../models/classes/classes.php";
    //Chamando a instância
    $listarUsuario = new UsuarioCliente();
    $lista = $listarUsuario->listarUsuariosCliente($pdo);
    
    foreach($lista as $user):
        $usuario = array(
        'id' => $user['id'],
        'cliente' => $user['cliente'],
        'username' => $user['username'],
        'email' => $user['email'],
        'telefone' => $user['telefone'],
        'endereco' => $user['endereco'],
        'ponto' => $user['ponto'],
        'localidade' => $user['localidade'],
        );
    require_once "../public/includes/local-name.php";
    ?>

      <div class="titulo"><h5 style="color: white;"><b><?php echo htmlspecialchars($usuario["cliente"]); ?></b>, logo abaixo estão seus dados. Mantenha-os atualizados para melhor atendê-lo(a)!</h5></div><br>

      <div class="card"><br>
        <div class="bloco_cliente"><br>
          <div class="text-center">
            <div class="index-descricao"><h3 style="color:black">Meu<span style="color:gold"> Perfil</span></h3></div><br>
          </div>
            
            <form action="../../controllers/actions/actions-client/send-client-update.php" enctype="multipart/form-data" method="POST">
              <strong>Nome</strong>
              <input type="text" id="cliente" name="cliente" value="<?php echo $usuario['cliente'] ?>" class="form-control"><br>
              <strong>Nome de usuário</strong>
              <input type="text" id="username" name="username" value="<?php echo $usuario['username'] ?>" class="form-control"><br>
              <strong>Email</strong>  
              <input type="email" id="email" name="email" value="<?php echo $usuario['email'] ?>" class="form-control"><br>
              <strong>Telefone</strong>  
              <input type="telefone" id="telefone" name="telefone" value="<?php echo $usuario['telefone'] ?>" class="form-control"><br>
              <strong>Endereço</strong>  
              <input type="endereco" id="endereco" name="endereco" value="<?php echo $usuario['endereco'] ?>" class="form-control"><br>
              <strong>Ponto de referência</strong>  
              <input type="ponto" id="ponto" name="ponto" value="<?php echo $usuario['ponto'] ?>" class="form-control"><br>
              
              <div class="text-center">
                <strong><label>Sua região ainda é: <?php echo $local ?>?</strong>
                <p>Se não for, marque sua nova região abaixo</p>
                <select name="localidade" class="form-control">
                    <option value="<?php echo $usuario['localidade'] ?>">Atualizar Região</option>
                    <?php include "../public/includes/list-select-local.php"; ?>
                </select><br>
                <button onclick="javascript:return confirm('Deseja realmente atualizar seu perfil?');" class="btn btn-warning" name="enviar_profile" type="submit">Atualizar perfil</button>
              </div>
              
            </form><br>
        </div>
      </div><br>

      <?php endforeach; ?>

      <div class="bloco-redefinir-senha"><br>
          <div class="card"><br>
            <div class="text-center">
              <h4>Clique aqui para redefinir sua senha:</h4> <br>
              <a class="btn btn-primary btn-sm" href="../login/reset-password.php">Redefinir senha</a>
          </div><br>
          </div><br>
      </div>

      <div class="bloco-excluir-perfil"><br>
        <div class="card"><br>
        <div class="text-center">
              <div class="exclusao-conta">
                  <h3 style="color: red; font-family: 'Fredoka One'">Excluir Conta</h3><br>
                  <p>Ao deletar sua conta <b>TODOS</b> os seus dados serão apagados e <b>NÃO SERÁ POSSÍVEL REATIVAR NOVAMENTE</b>.</p>
                  <p>Você poderá criar uma nova conta quando desejar.</p>
                  <p>Se mesmo assim deseja prosseguir, clique no botão abaixo.</p><br>
                  <a class="btn btn-danger btn-sm" onclick="javascript:return confirm('Deseja realmente excluir sua conta?');" href="update_profile.php?d=<?php echo "".$usuario['id']."" ?>">Deletar</a>
                </div>
          </div><br>
        </div><br>
      </div>

      <?php       
      include "../../controllers/actions/actions-client/delete-profile.php";
      ?>
              
    </section>
</div>
</main>


<?php include("./includes/footer.php"); ?>
