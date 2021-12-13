<?php
require_once "../../models/classes/classes.php";

//Chamando a instância
$listarUsuario = new ListaUsuarioADM();
$usuarios = $listarUsuario->listarUsuariosADM($pdo);

foreach($usuarios as $usuario)

$listarProdutoPedido = new ItensCliente();
$ResultadoProdutoPedido = $listarProdutoPedido->listarItensCliente($pdo);

foreach ($ResultadoProdutoPedido as $prodped){
$item = array(
    'id_usuario' => $prodped['id_usuario'],
    'produto' => $prodped['produto'],
    'quantidade' => $prodped['quantidade'],
    'valor_unitario' => $prodped['valor_unitario'],
    'dt_pedido' => $prodped['dt_pedido'],

);
if($usuario['id'] === $item['id_usuario'] && $dt_pedido === $item['dt_pedido']){
echo "<strong>Produto:</strong> ".$item['produto']."<br>";
echo "<strong>Quantidade:</strong> ".$item['quantidade']."x<br>";
echo "<strong>Valor:</strong> R$".number_format($item['valor_unitario'], 2, ',', '.')."<br>";
echo "<hr>";
}
}
$SubTotal = $total - $frete;
?>