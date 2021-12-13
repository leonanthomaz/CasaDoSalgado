<?php 

function getProducts($pdo){
	$sql = "SELECT *  FROM produtos ORDER BY id_produto DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPorcoes($pdo){
	$sql = "SELECT * FROM produtos WHERE categoria = 2 ORDER BY id_produto DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getBebida($pdo){
	$sql = "SELECT * FROM produtos WHERE categoria = 3 ORDER BY id_produto DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCombo($pdo){
	$sql = "SELECT * FROM produtos WHERE categoria = 4 ORDER BY id_produto DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getYakisoba($pdo){
	$sql = "SELECT * FROM produtos WHERE categoria = 5 ORDER BY id_produto DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProductsByIds($pdo, $ids) {
	$sql = "SELECT * FROM produtos WHERE id_produto IN (".$ids.") ORDER BY id_produto DESC";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
