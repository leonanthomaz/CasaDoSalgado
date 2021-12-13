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
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class='bx bx-user nav_icon'></i> Usuários
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="./dashboard_users.php">Todos usuários</a>
          <a class="dropdown-item" href="./atualizar-usuario.php">Atualizar usuário</a>
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
        <a class="nav-link active" href="./stats.php"><i class='bx bx-bar-chart-alt-2 nav_icon'></i> Estatítiscas</a>
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
    <?php

    date_default_timezone_set('America/Sao_Paulo');
    $dia = date('d');
    $mes = date('m');

    //var_dump($dia);

    $sql_users = $pdo->prepare("SELECT * FROM users");
    $sql_users->execute();
    $users = $sql_users->fetchAll(PDO::FETCH_ASSOC);

    $sql_pedidos = $pdo->prepare("SELECT * FROM pedidos");
    $sql_pedidos->execute();
    $pedidos = $sql_pedidos->fetchAll(PDO::FETCH_ASSOC);

    $sql_produtos = $pdo->prepare("SELECT * FROM produtos ");
    $sql_produtos->execute();
    $produtos = $sql_produtos->fetchAll(PDO::FETCH_ASSOC);
    foreach ($produtos as $produto);

    $TotaldeCancelados= $pdo->query("SELECT SUM(cancelamento) FROM pedidos")->fetchColumn();

    //Balanço Total Geral
    $somaTotalsemCancelamento = $pdo->query("SELECT SUM(total) AS total FROM pedidos")->fetchColumn();
    $SomaCancelamento = $pdo->query("SELECT SUM(total) FROM pedidos WHERE cancelamento")->fetchColumn();
    //var_dump($SomaCancelamento);
    $BalançoGeral = $somaTotalsemCancelamento - $SomaCancelamento;

    //Balanço Total Dia
    $somaTotalsemCancelamentoDia = $pdo->query("SELECT SUM(total) AS total FROM pedidos GROUP BY YEAR(`dt_pedido`), 
    DAY(`dt_pedido`) ORDER BY dt_pedido DESC")->fetchColumn();
    $SomaCancelamentoDia  = $pdo->query("SELECT SUM(total) FROM pedidos WHERE cancelamento GROUP BY YEAR(`dt_pedido`), 
    DAY(`dt_pedido`) ORDER BY dt_pedido DESC")->fetchColumn();
    $BalançoGeralDia  = $somaTotalsemCancelamentoDia  - $SomaCancelamentoDia ;
    //var_dump($BalançoGeralDia);

    //Balanço Total Mês
    $somaTotalsemCancelamentoSemana = $pdo->query("SELECT SUM(total) AS total FROM pedidos GROUP BY YEAR(`dt_pedido`), 
    WEEK(`dt_pedido`) ORDER BY dt_pedido DESC")->fetchColumn();
    $SomaCancelamentoSemana  = $pdo->query("SELECT SUM(total) FROM pedidos WHERE cancelamento GROUP BY YEAR(`dt_pedido`), 
    WEEK(`dt_pedido`) ORDER BY dt_pedido DESC")->fetchColumn();
    $BalançoGeralSemana  = $somaTotalsemCancelamentoSemana  - $SomaCancelamentoSemana ;
    //var_dump($BalançoGeralSemana);

    //Balanço Total Mês
    $somaTotalsemCancelamentoMes = $pdo->query("SELECT SUM(total) AS total FROM pedidos GROUP BY YEAR(`dt_pedido`), 
    MONTH(`dt_pedido`) ORDER BY dt_pedido DESC")->fetchColumn();
    $SomaCancelamentoMes  = $pdo->query("SELECT SUM(total) FROM pedidos WHERE cancelamento GROUP BY YEAR(`dt_pedido`), 
    MONTH(`dt_pedido`) ORDER BY dt_pedido DESC")->fetchColumn();
    $BalançoGeralMes  = $somaTotalsemCancelamentoMes  - $SomaCancelamentoMes ;
    //var_dump($BalançoGeralMes);

    $despesaDia = -60;
    $despesaSemana = -360;
    $despesaMes = -1440;


    $somaLucroDia = $BalançoGeralDia - 60;
    $somaLucroSemana = $BalançoGeralSemana - 360;
    $somaLucroMes = $BalançoGeralMes - 1440;

 
    ?>
    
  <main>
    <div class="bloco-dashboard">
      <div class="container">
          <div class="titulo-adm"><h3>Painel de controle</h3></div><br>
            <div class="bloco-estatisticas-dashboard">
              <div class="text-center"><h3><i class="fas fa-money-bill-alt"></i> Financeiro</h3></div>
              <hr>
              <div class=""><h3><i class="fa fa-calendar" aria-hidden="true"></i> Total do Dia: <?php echo "R$".number_format($BalançoGeralDia, 2, ',', '.')."" ?></h3></div><br>
              <div class=""><h3><i class="fa fa-calendar" aria-hidden="true"></i> Total da Semana: <?php echo "R$".number_format($BalançoGeralSemana, 2, ',', '.')."" ?></h3></div><br>
              <div class=""><h3><i class="fa fa-calendar" aria-hidden="true"></i> Total do Mês: <?php echo "R$".number_format($BalançoGeralMes, 2, ',', '.')."" ?></h3></div><br>
              <div class=""><h3><i class="fas fa-money-bill-alt"></i> Balanço do Dia: <?php echo "R$".number_format($somaLucroDia, 2, ',', '.')."" ?></h3></div><br>
              <div class=""><h3><i class="fas fa-money-bill-alt"></i> Balanço da Semana: <?php echo "R$".number_format($somaLucroDia, 2, ',', '.')."" ?></h3></div><br>
              <div class=""><h3><i class="fas fa-money-bill-alt"></i> Balanço do Mês: <?php echo "R$".number_format($somaLucroMes, 2, ',', '.')."" ?></h3></div><br>
              <div class=""><h3><i class='bx bx-user nav_icon'></i> Geral Total: <?php echo "R$".number_format($somaTotalsemCancelamento, 2, ',', '.')."" ?></h3></div><br>
            </div><br>
            <div class="bloco-estatisticas-dashboard">
            <div class="text-center"><h3>Despesas Fixas</h3></div>
            <hr>          
            <div class=""><h3><i class="fas fa-motorcycle"></i> Taxa do Motoboy (Diária): <?php echo "R$30,00"?></h3></div><br>
            <div class=""><h3><i class="fas fa-briefcase"></i> Taxa do Ajudante (Diária): <?php echo "R$30,00"?></h3></div><br>
            </div><br>
            <div class="bloco-estatisticas-dashboard">
              <div class="text-center"><h3>Estatítiscas Gerais</h3></div>
              <hr>
              <div class=""><h3><i class="fa fa-at" aria-hidden="true"></i> Faturamento geral c/ site: <?php echo "R$".number_format($somaTotalsemCancelamento, 2, ',', '.')."" ?></h3></div><br>            
              <div class=""><h3><i class='bx bx-user nav_icon'></i> Total de usuários cadastrados: <?php echo count($users) ?></h3></div><br>
              <div class=""><h3><i class='bx bx-bookmark nav_icon'></i> Total de pedidos registrados: <?php echo count($pedidos) ?></h3></div><br>
            </div><br>
            <div class="bloco-estatisticas-dashboard">
              <div class="text-center"><h3> Estatítiscas de Vendas do usuário</h3></div>
              <hr>
              <div class=""><h3><i class='bx bx-user nav_icon'></i> Pedidos Cancelados: <?php echo $TotaldeCancelados ?></h3></div><br>
            </div><br>
        </div>
      </div>
  </main>

</div>
      
<?php include "./includes/footer.php"; ?>
