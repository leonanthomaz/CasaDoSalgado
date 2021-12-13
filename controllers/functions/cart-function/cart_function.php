<?php 

if(!isset($_SESSION['carrinho'])) {
	$_SESSION['carrinho'] = array();
}

function addCart($id, $quantity) {
	if(!isset($_SESSION['carrinho'][$id])){ 
		$_SESSION['carrinho'][$id] = $quantity; 
	}
}

function deleteCart($id) {
	if(isset($_SESSION['carrinho'][$id])){ 
		unset($_SESSION['carrinho'][$id]); 
	} 
}

function updateCart($id, $quantity) {
	if(isset($_SESSION['carrinho'][$id])){ 
		if($quantity > 0) {
			$_SESSION['carrinho'][$id] = $quantity;
		} else {
		 	deleteCart($id);
		}
	}
}

function getContentCart($pdo) {
	
	$results = array();
	
	if($_SESSION['carrinho']) {
		
		$cart = $_SESSION['carrinho'];
		$products =  getProductsByIds($pdo, implode(',', array_keys($cart)));

		foreach($products as $product) {
			//var_dump($product);

			$results[] = array(
			'id' => $product['id_produto'],
			'name' => $product['produto'],
			'price' => $product['valor_unitario'],
			'desc' => $product['descricao'],
			'IMG' => $product['imagem'],
			'quantity' => $cart[$product['id_produto']],
			'subtotal' => $cart[$product['id_produto']] * $product['valor_unitario'],
			);
			
		}
	}
	
	return $results;
	
}

function getTotalCart($pdo) {
			
	$total = 0;

	foreach(getContentCart($pdo) as $product) {
		$total += floatval($product['subtotal']) ;
	} 

	return floatval($total);
}


