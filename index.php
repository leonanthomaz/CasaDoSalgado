<?php require_once "./views/public/includes/header.php"; ?>


<div class="navibar-color">
<nav class="navbar navbar-expand-lg navbar-dark ">
  <div class="container-fluid">
  <a class="navbar-brand" href="#"><div class="logo_header"><img src="./views/public/img/casaamarela.png" alt="logo-casa-dos-salgados-amarelo" width="90"/></div></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-utensils"></i> Cardápio
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="./views/pages/salgadinhos.php">Porções</a>
                <a class="dropdown-item" href="./views/pages/combos.php">Combos</a>
                <a class="dropdown-item" href="./views/pages/bebidas.php">Bebidas</a>
                </div>
            </li>
            <?php if(isset($_SESSION["loggedin"])): ?>
            <li class="nav-item">
                <a class="nav-link" href="./cart/cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Carrinho</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="./client/main-client-area.php"><i class="far fa-edit"></i> Minha área</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="./controllers/connect/logout.php" id=""><i class="fas fa-sign-out-alt"></i> Sair</a>
            </li>
            <?php endif; ?>
            <?php if(!isset($_SESSION["loggedin"])): ?>
              <li class="nav-item">
            <a class="nav-link" href="./views/login/login.php"><i class="fa fa-user" aria-hidden="true"></i> Login</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="./views/login/register.php"><i class="fa fa-user-plus" aria-hidden="true"></i> Cadastrar</a>
            </li>
            <?php endif; ?>

        <li class="nav-item">
        </li>
      </ul>
    </div>
  </div>
  </nav>
</div>

<div class="body-main">

<header><br>
<div class="text-center">
    <h1 style="color:white;">Bem vindo a</h1>

    <div class="wow fadeInDown">
      <div class="img-card">
          <a href="#">
              <img src="./views/public/img/logo.png"/> 
          </a> 
      </div>
    </div><br> 

    <!-- Redes Sociais -->
    <?php require_once "./views/public/includes/social-network.php"; ?>  

    <span style="color:white; font-size: 250%; font-family: 'Fredoka One', cursive;">Casa do</span><span style="color:gold; font-size: 250%; font-family: 'Fredoka One', cursive;"> Salgado</span>
</div>
</header><br>

<div class="container marketing">
  <hr class="featurette-divider" style="color:white;">
</div>

<div class="container"><br><br>
    <!-- Bloco informativo secundario - efeito vindo da direita -->

    <div class="text-center">
    <div class=""><h3 style="color:white">Sua melhor opção de salgadinhos do <span style="color:gold"> Alto da Boa Vista!</span></h3></div><br>
    </div>
    <div class="wow fadeInUp">
        <div class="text-center">
            <img src="./views/public/img/coxinha-feliz.png" width="120"/>
        </div>
    </div><br><br>

    <div class="text-center">
    <div class=""><h3 style="color:white">Trabalhamos com <span style="color:gold"> Delivery!</span></h3></div><br>
    </div>
    <div class="wow bounceInLeft">
        <div class="text-center">
            <img src="./views/public/img/motoboy.png" width="120"/> 
        </div>
    </div>
    <div class="text-center">
    <div class="" style="font-family: 'Aclonica', sans-serif; font-weight: bold; color: cyan; font-size:16px;">* Entregamos apenas no Alto da Boa Vista e adjacências!</div>
    </div><br><br>

    <div class="text-center">
    <div class=""><h3 style="color:white">Cadastre-se no nosso portal e acompanhe o status do seu <span style="color:gold"> pedido!</span></h3></div><br>
    </div>
    <div class="wow pulse">
        <div class="text-center">
            <img src="./views/public/img/time.png" width="80"/>
        </div>
    </div><br><br>


  <div class="text-center">
  <h1 style="color:gold;">Confira nosso Cardápio Virtual!</h1><br>
  </div>
  <!-- Redes Sociais -->
  <?php require_once "./views/public/includes/category.php"; ?>           
</div></div>


<div class="container marketing">
        <hr class="featurette-divider" style="color:white;">
</div><br>

  <!-- Bloco informativo secundario - Marketing -->
  <div class="container marketing">
      <div class="row featurette">
        <div class="col-md-7"><br>
        <div class=""><h3 style="color:white; font-size: 200%">Aceitamos<span style="color:gold"> encomendas!</span></h3></div><br>
        <p class="" style="font-family: 'Shippori Antique', sans-serif;">Entre em contato conosco e confira nossas condições!</p>
        <p class="" style="font-family: 'Shippori Antique', sans-serif; font-weight: bold">Obs: Aceitamos sua encomenda apenas se for feito com antecedência!</p>
        </div><br>
        <div class="col-md-5">
          <div class="index-img-row-featurette"><div class="wow fadeInDown"><img src="./views/public/img/encomenda-salgadinhos-1.jpg" alt=""  role="img"/></div></div>
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 order-md-2"><br>
        <div class=""><h3 style="color:white; font-size: 200%">Prefere pedir pelo telefone?<span style="color:gold"> Estamos a disposição!</span></h3></div><br>
        <p class="" style="font-family: 'Shippori Antique', sans-serif;">Você pode fazer login e realizar seus pedidos pelo site ou também através do nosso canal de atendimento via Whatsapp pelo número (21) 99641-6049!</p>
        </div><br>
        <div class="col-md-5 order-md-1">
        <div class="index-img-row-featurette"><div class="wow fadeInDown"><img src="./views/public/img/encomenda-salgadinhos - 2.png" alt=""  role="img" /></div></div>
        </div>
      </div>

      <hr class="featurette-divider">

        <div class="text-center">
        <h1 style="color:white;">Alguma dúvida?</h1>
        <h2 style="color:yellow;">Chame no whatsapp!</h2><br>
        <div class="whatsapp-principal">
          <a href="https://wa.me/5521996416049" class="icoWhatsapp" title="Whatsapp">
          <div class="wow bounceInLeft"><img src="./views/public/img/whatsapp-icon-seeklogo.com.svg" width="50"/></div>
          <h1 style="color:white;">(21) 99641-6049</h1>
          </a>
        </div>
        </div><br>

        <hr class="featurette-divider" style="color:white;">
      
      <div class="text-center">
            <h1 style="color:white;">Aceitamos cartões e Pix!</h1>
            <img src="./views/public/img/bandeiras.png" width="80"/><br>
            <img src="./views/public/img/logo-pix.png" width="40"/>
      </div>        
  </div>
</div>

<?php require_once "./views/public/includes/footer.php"; ?>
