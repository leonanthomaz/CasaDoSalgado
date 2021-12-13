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
          <a class="dropdown-item" href="./update-users.php">Atualizar usuário</a>
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

    <div class="text-center"><h3 style="color:white; font-family: 'Fredoka One', cursive; font-size: 250%">Atualizar<span style="color:gold; font-family: 'Fredoka One', cursive;"> Produtos</span></h3></div><br>

    <?php
      //Receber o número da página
      $pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
      $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
      //var_dump($pagina);

      //Setar a quantidade de registros por página
      $limite_resultado = 3;

      // Calcular o inicio da visualização
      $inicio = ($limite_resultado * $pagina) - $limite_resultado;


      $query_usuarios = "SELECT * FROM produtos  ORDER BY id_produto DESC LIMIT $inicio, $limite_resultado";
      $result_usuarios = $pdo->prepare($query_usuarios);
      $result_usuarios->execute();  

      if (($result_usuarios) AND ($result_usuarios->rowCount() != 0)) {
          while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) :
              
            //var_dump($row_usuario);
            extract($row_usuario);

            
          ?>

        <div class="box-form-dash">
          <div class="box-form-dashuser-inside">
          <form method="POST" enctype="multipart/form-data" action="../../controllers/actions-admin/send-update-product.php"><br>
          <div class="text-center">
              <h3 style="color: white;">Produto:</h3>
            </div><br>
            <input type="hidden" name="id_produto" class="form-control" value="<?php echo $id_produto ?>">
            <div class="form-group">
                <strong>Nome do Produto</strong><br>
                <input type="text" name="produto" class="form-control" value="<?php echo $produto ?>"/>
            </div><br>
            <div class="form-group">
                <strong>Valor do Produto (R$)</strong><br>
                <input type="number" step="0.01" name="valor_unitario" class="form-control" value="<?php echo $valor_unitario ?>"/>
            </div><br>
            <div class="form-group">
                <strong>Descrição (max 100 caracteres)</strong><br>
                <input type="text" name="descricao" class="form-control" value="<?php echo $descricao ?>"/>
            </div><br>
            <div class="form-group">
                <strong>Imagem</strong><br>
                <img src="<?php echo $imagem ?>" width="100" />
                <input type="file" name="imagem" class="form-control" <?php echo $imagem ?>/>
            </div><br>
            <div class="form-group">
              <strong>Categoria</strong><br>
              <select name="categoria" class="form-control" value="<?php echo $categoria ?>">
                  <option value="<?php echo $categoria ?>">Selecione uma nova categoria</option>
                  <option value=1>Porções</option>
                  <option value=2>Bebidas</option>
                  <option value=3>Combos</option>
                  <option value=4>Yakisobas</option>
              </select>
            </div><br><br>
            <input class="btn btn-warning" type="submit" value="Atualizar Produto"/><br>
          </form><br><br>
    
            <div class="text-center">
              <h3>Excluir Produto</h3>
              <a class="btn btn-danger btn-sm" onclick="javascript:return confirm('Deseja realmente excluir este produto?');" href="update-product.php?d=<?php echo $id_produto ?>">Deletar produto</a>
            </div>
          </div>
        </div><br><br>

             
        <?php       
        include "../../controllers/actions-admin/delete-products.php";
        ?> 

          <?php endwhile; ?>
          
          
          <?php
          //Contar a quantidade de registros no BD
          $query_qnt_registros = "SELECT COUNT(id_produto) AS num_result FROM produtos";
          $result_qnt_registros = $pdo->prepare($query_qnt_registros);
          $result_qnt_registros->execute();
          $row_qnt_registros = $result_qnt_registros->fetch(PDO::FETCH_ASSOC);

          //Quantidade de página
          $qnt_pagina = ceil($row_qnt_registros['num_result'] / $limite_resultado);

          // Maximo de link
          $maximo_link = 2;

          echo "<div class='text-center'>";

          echo "<a class='page-item' href='update-product.php?page=1'>Primeira</a> ";

          for ($pagina_anterior = $pagina - $maximo_link; $pagina_anterior <= $pagina - 1; $pagina_anterior++) {
              if ($pagina_anterior >= 1) {
                  echo "<a class='page-item' href='update-product.php?page=$pagina_anterior'>$pagina_anterior</a> ";
              }
          }

          echo "<a class='page-atual'>$pagina</a>";

          for ($proxima_pagina = $pagina + 1; $proxima_pagina <= $pagina + $maximo_link; $proxima_pagina++) {
              if ($proxima_pagina <= $qnt_pagina) {
                  echo "<a class='page-item' href='update-product.php?page=$proxima_pagina'>$proxima_pagina</a> ";
              }
          }

          echo "<a class='page-item' href='update-product.php?page=$qnt_pagina'>Última</a> ";
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
          <a class='page-item' href='update-product.php?page=1'>Voltar para primeira página</a>
          </div>
          */
          //";
      }

    ?>
</div>
         
<?php include "./includes/footer.php"; ?>
