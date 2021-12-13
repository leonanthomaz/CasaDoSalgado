<!DOCTYPE HTML>


    <html lang="pt-br">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Leonan Thomaz de Oliveira">
    <meta name="generator" content="Hugo 0.88.1">
    <link rel="icon" href="./assets/logo.png"/>    
    <title>Casa do Salgado | Lanchonete ABV</title>
    
    <link rel="icon" href="https:/scontent-gig2-1.xx.fbcdn.net/v/t39.30808-6/251692057_109632531520840_5755192643604770113_n.png?_nc_cat=106&ccb=1-5&_nc_sid=973b4a&_nc_ohc=Zh9FR2kvM5cAX9vJGw-&_nc_ht=scontent-gig2-1.xx&oh=2f463c72bbf387b844b8cb277b3b1a30&oe=61A872A8" type="image/x-icon" />


    <link rel="canonical" href="https:/getbootstrap.com/docs/5.1/examples/product/">

    

    <!-- Fonts -->
    <link rel="stylesheet" href="https:/fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https:/use.fontawesome.com/releases/v5.7.2/css/all.css">
    
    <link href="https:/cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">



    <!-- Favicons -->
    
    <link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <meta name="theme-color" content="#7952b3">

    <head>
        <!-- Bootstrap core CSS -->
        <link href="../../views/public/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../views/public/css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../views/public/css/normalize.css">
        <link rel="stylesheet" type="text/css"  href="../../views/public/css/animate.css">
        <link  href="../../views/public/css/cart.css" rel="stylesheet">
        <link  href="../../views/public/css/itens-cart.css" rel="stylesheet">
        <link  href="../../views/public/css/styles.css" rel="stylesheet">
        <script src="../../views/public/js/dist/wow.js"></script>
        <script src="../../views/public/js/dist/wow.min.js"></script> 
    </head>

    

<!-- Cada pagina um body individual para o loading -->
<body class="body">
    
   <!-- Construindo..   -->

  <!-- Loading -->
  <div id="preloader">
      <div class="inner">
        <div class="text-center">
          <h2> Carregando...</h2>
          <div class="bolas">
            <div></div>
            <div></div>
            <div></div>
            <div></div>                 
          </div>
        </div>
      </div>
  </div>



  <style>

  /* Estilização loading */
  .body {
    overflow: hidden; 
  }
  
  #preloader {
      position:fixed;
      top:0;
      left:0;
      right:0;
      bottom:0;
      background-color: #640057d8; /* cor do background que vai ocupar o body */
      z-index:999; /* z-index para jogar para frente e sobrepor tudo */
      color: white;
      font-family:'Luckiest Guy', cursive;
      font-weight: bold;
  }
  #preloader .inner {
      position: absolute;
      top: 50%; /* centralizar a parte interna do preload (onde fica a animação)*/
      left: 50%;
      transform: translate(-50%, -50%);  
  }


  .bolas > div {
    display: inline-block;
    background-color: #ffee00;
    width: 23px;
    height: 23px;
    border-radius: 100%;
    margin: 3px;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    animation-name: animarBola;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
    
  }
  .bolas > div:nth-child(1) {
      animation-duration:0.75s ;
      animation-delay: 0;
  }
  .bolas > div:nth-child(2) {
      animation-duration: 0.75s ;
      animation-delay: 0.12s;
  }
  .bolas > div:nth-child(3) {
      animation-duration: 0.75s  ;
      animation-delay: 0.24s;
  }

  .bolas > div:nth-child(4) {
      animation-duration: 0.75s  ;
      animation-delay: 0.36s;
  }
  
  @keyframes animarBola {
    0% {
      -webkit-transform: scale(1);
      transform: scale(1);
      opacity: 1;
    }
    16% {
      -webkit-transform: scale(0.1);
      transform: scale(0.1);
      opacity: 0.7;
    }
    33% {
      -webkit-transform: scale(1);
      transform: scale(1);
      opacity: 1; 
    } 
  }
  </style>
