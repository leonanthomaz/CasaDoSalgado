<?php
// Inicialize a sessão
session_start();
// Verifique se o usuário está logado, se não, redirecione-o para uma página de login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    //header("location: ./login/login.php");
    header("location: ../../index.php");
    exit;
}

require_once "../../models/config.php";
require_once "../../controllers/functions/cart-function/cart_function.php";
require_once "../../controllers/functions/product_function/product_function.php";

//ação do carrinho
include "../../controllers/functions/cart-function/cart-control.php";

//classe Usuario
include "../../models/classes/classes.php";

//Chamando a instância
$listarUsuario = new UsuarioCliente();
$lista = $listarUsuario->listarUsuariosCliente($pdo);

//Mapeando a taxa de entrega
include "../../controllers/functions/global-functions/delivery-tax.php";

$resultsCarts = getContentCart($pdo);
$totalCarts  = getTotalCart($pdo);

//var_dump($resultsCarts);

?>

<?php require_once "./includes/header.php"; ?>

<?php require_once "../cart/includes/navbar-cart.php"; ?>

<div class="body-cart">
<div class="col">

	<?php include "../cart/includes/block-cart-up.php"; ?>

	<?php if($resultsCarts) : ?>

	<div class='wow fadeInDown'>
	<form id="form-carrinho" action="cart.php?acao=up" method="post">

		<?php 
		$_SESSION['dados'] = array();
		$usuario = $_SESSION['username'];
		$userid = $_SESSION['id'];
		
		foreach($resultsCarts as $key => $result) : 
		?>

		<?php include "../cart/includes/block-cart-body.php"; ?>

		<?php include "./includes/description-total-cart.php"; ?>

		<?php
		array_push(
		$_SESSION['dados'],
		array(
		'idProduto' =>  $result['id'],
		'Produto' =>  $result['name'],
		'Quantidade' =>  $result['quantity'],
		'Preco_Unitario' =>  $result['price'],
		'valorSemFrete' => $valorSemFrete,
		'local' => $local,
		'frete' =>  $frete,
		'Total' =>  $SomaFinal,
		)	
		);
		//var_dump($_SESSION['dados']);
		endforeach;?>

		
		</div>

		<?php include "../cart/includes/block-cart-down.php"; ?>

	</form><br>
	
	<?php endif?>
</div>
</div>

<?php include "./includes/footer.php"; ?>


