
<div class="navibar-color">
<nav class="navbar navbar-expand-lg navbar-dark ">
  <div class="container-fluid">
    <a class="navbar-brand" href="../dashboard.php"><img src="../public/img/casaamarela.png" alt="logo-casa-dos-salgados-amarelo" width="90"/></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../dashboard.php"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" style="color: white;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-utensils" ></i> Cardápio
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="./salgadinhos.php">Porções</a>
                <a class="dropdown-item" href="./combos.php">Combos</a>
                <a class="dropdown-item" href="./bebidas.php">Bebidas</a>
                </div>
            </li>
            <?php if(isset($_SESSION["loggedin"])): ?>
            <li class="nav-item">
                <a class="nav-link" href="../../views/cart/cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Carrinho</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="../../views/client/main-client-area.php"><i class="far fa-edit"></i> Minha área</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="../../controllers/connect/logout.php" id=""><i class="fas fa-sign-out-alt"></i> Sair</a>
            </li>
            <?php endif; ?>
            <?php if(!isset($_SESSION["loggedin"])): ?>
              <li class="nav-item">
            <a class="nav-link" href="../../views/login/login.php"><i class="fa fa-user" aria-hidden="true"></i> Login</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="../../views/login/register.php"><i class="fa fa-user-plus" aria-hidden="true"></i> Cadastrar</a>
            </li>
            <?php endif; ?>
        <li class="nav-item">
        </li>
      </ul>
    </div>
  </div>
  </nav>
</div>