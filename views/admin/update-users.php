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

    <div class="text-center"><h3 style="color:white; font-family: 'Fredoka One', cursive; font-size: 250%">Atualizar<span style="color:gold; font-family: 'Fredoka One', cursive;"> Usuários</span></h3></div><br>

    <?php
      //Receber o número da página
      $pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
      $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
      //var_dump($pagina);

      //Setar a quantidade de registros por página
      $limite_resultado = 3;

      // Calcular o inicio da visualização
      $inicio = ($limite_resultado * $pagina) - $limite_resultado;


      $query_usuarios = "SELECT * FROM users  ORDER BY id DESC LIMIT $inicio, $limite_resultado";
      $result_usuarios = $pdo->prepare($query_usuarios);
      $result_usuarios->execute();  

      if (($result_usuarios) AND ($result_usuarios->rowCount() != 0)) {
          while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) :
              
            //var_dump($row_usuario);
            extract($row_usuario);


            include "../public/includes/local-name.php";
            //var_dump($usuario['localidade']);

          ?>

          <div class="box-form-dash">
            <div class="box-form-dashuser-inside">
          <form action="../../controllers/actions-admin/send-update-users.php" enctype="multipart/form-data" method="POST">
              <input type="hidden" name="id" value="<?php echo $id ?>" />
              <div class="text-center">
                 <h3 style="color: white;">Usuário:</h3>
              </div><br>
              <strong>Nome</strong>
              <input type="text" id="cliente" name="cliente" value="<?php echo $cliente ?>" class="form-control"><br>
              <strong>Nome de usuário</strong>
              <input type="text" id="username" name="username" value="<?php echo $username ?>" class="form-control"><br>
              <strong>Email</strong>  
              <input type="email" id="email" name="email" value="<?php echo $email ?>" class="form-control"><br>
              <strong>Telefone</strong>  
              <input type="telefone" id="telefone" name="telefone" value="<?php echo $telefone ?>" class="form-control"><br>
              <strong>Endereço</strong>  
              <input type="endereco" id="endereco" name="endereco" value="<?php echo $endereco ?>" class="form-control"><br>
              <strong>Ponto de referência</strong>  
              <input type="ponto" id="ponto" name="ponto" value="<?php echo $ponto ?>" class="form-control"><br>
              
              <div class="text-center">
                <select name="localidade" class="form-control">
                  <option value="<?php echo $localidade ?>">Selecione uma nova região</option>
                  <?php include "../public/includes/list-select-local.php"; ?>
                </select><br>

                <div class="text-center">
                <strong>Atualizar usuário</strong><br>
                <button onclick="javascript:return confirm('Deseja realmente atualizar este perfil?');" class="btn btn-warning" name="enviar_profile" type="submit">Atualizar perfil</button>
                </div>
              </div>

            </div>
          </form><br>

              <div class="text-center">
                <strong>Excluir Usuário</strong>
                <div>
                <a class="btn btn-danger btn-sm" onclick="javascript:return confirm('Deseja realmente excluir esta conta?');" href="update-users.php?d=<?php echo "$id" ?>">Deletar usuário</a>
                </div>
              </div>
          </div><br><br>

          <?php       
          include "../../controllers/actions-admin/delete-users-adm.php";
          ?>  

          <?php endwhile; ?>
          
          <?php
          //Contar a quantidade de registros no BD
          $query_qnt_registros = "SELECT COUNT(id) AS num_result FROM pedidos";
          $result_qnt_registros = $pdo->prepare($query_qnt_registros);
          $result_qnt_registros->execute();
          $row_qnt_registros = $result_qnt_registros->fetch(PDO::FETCH_ASSOC);

          //Quantidade de página
          $qnt_pagina = ceil($row_qnt_registros['num_result'] / $limite_resultado);

          // Maximo de link
          $maximo_link = 2;

          echo "<div class='text-center'>";

          echo "<a class='page-item' href='update-users.php?page=1'>Primeira</a> ";

          for ($pagina_anterior = $pagina - $maximo_link; $pagina_anterior <= $pagina - 1; $pagina_anterior++) {
              if ($pagina_anterior >= 1) {
                  echo "<a class='page-item' href='update-users.php?page=$pagina_anterior'>$pagina_anterior</a> ";
              }
          }

          echo "<a class='page-atual'>$pagina</a>";

          for ($proxima_pagina = $pagina + 1; $proxima_pagina <= $pagina + $maximo_link; $proxima_pagina++) {
              if ($proxima_pagina <= $qnt_pagina) {
                  echo "<a class='page-item' href='update-users.php?page=$proxima_pagina'>$proxima_pagina</a> ";
              }
          }

          echo "<a class='page-item' href='update-users.php?page=$qnt_pagina'>Última</a> ";
          echo "</div>";

      } else {
          echo "
          <div class='text-center'><br><br>
          <strong style='color: red;'><b>Nenhum pedido encontrado!</b></strong>
          </div>
          ";
          //echo "
          /*
          <div class='text-center'><br><br>
          <a class='page-item' href='update-users.php?page=1'>Voltar para primeira página</a>
          </div>
          */
          //";
      }

    ?>
</div>
         
<?php include "./includes/footer.php"; ?>

