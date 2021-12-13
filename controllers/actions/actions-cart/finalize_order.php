<?php
// Inicialize a sessão
session_start();
// Verifique se o usuário está logado, se não, redirecione-o para uma página de login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../../views/login/login.php");
    exit;
}

require_once "../../../models/config.php";

$usuario = $_SESSION['username'];
$idusuario = $_SESSION['id'];
include "../../functions/global-functions/time.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    foreach($_SESSION['checkout'] as $produtos){
        $id = $_SESSION['id'];
        $stmt = $pdo->prepare("INSERT INTO pedidos_itens (id, id_usuario, id_produto, quantidade, dt_pedido) 
        VALUES (NULL,:id,:idProduto,:Quantidade,'$dataLocal')"); 
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':idProduto', $produtos['idProduto']);
        $stmt->bindParam(':Quantidade', $produtos['Quantidade']);
        $stmt->execute();
    }

    if($stmt == true){
        
        $id = $_SESSION['id'];
        $local = $_POST['local'];
        $frete = $_POST['frete'];
        $Total = $_POST['Total'];
        $Pagamento = $_POST['pagamento'];
        $observacao = $_POST['observacao'];
        $username = $_SESSION['username'];
        $idCliente = $_SESSION['id'];

        $stmt = $pdo->prepare("INSERT INTO pedidos (id, id_usuario, local, frete, total, pagamento, observacao, dt_pedido) 
        VALUES (NULL,:id, :local, :frete, :Total,:Pagamento,:observacao,'$dataLocal')");
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':local', $local);
        $stmt->bindParam(':frete', $frete);
        $stmt->bindParam(':Total', $Total);
        $stmt->bindParam(':Pagamento', $Pagamento);
        $stmt->bindParam(':observacao', $observacao);
        $stmt->execute();

        if($stmt == true){

            $id = $_SESSION['id'];
            $cliente = $_POST['cliente'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $endereco = $_POST['endereco'];
            $ponto = $_POST['ponto'];
            $localidade = $_POST['localidade'];
        
            $_SESSION['erro_enviar_checkout'] = "";
            
            if(empty($_POST["cliente"])){
                $_SESSION['erro_enviar_checkout'];
            }
            if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($username))){
                $_SESSION['erro_enviar_checkout'];
            }if(empty(trim($telefone))){
                $_SESSION['erro_enviar_checkout'];
            } elseif(!preg_match('/^[0-9]{11}$/', trim($telefone))){
                $_SESSION['erro_enviar_checkout'];
            }if(empty(trim($email))){
                $_SESSION['erro_enviar_checkout'];
            }elseif(!preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', trim($_POST["email"]))){
                $_SESSION['erro_enviar_checkout'];
            }
        
            if(empty($username && $email && $telefone && $endereco && $ponto && $localidade) || $localidade == 0){
            //if(empty($localidade) || $localidade == 0){
                $_SESSION['erro_enviar_checkout'];
            }else{
                $stmt = $sql = $pdo->prepare("UPDATE users SET cliente = :cliente, username = :username, email = :email, telefone = :telefone, endereco = :endereco, ponto = :ponto, localidade = :localidade WHERE id = '$id'");
                $stmt->bindParam(':cliente', $cliente);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':telefone', $telefone);
                $stmt->bindParam(':endereco', $endereco);
                $stmt->bindParam(':ponto', $ponto);
                $stmt->bindParam(':localidade', $localidade);
                $sql->execute();
            }
        }
    }

    $numero = "SELECT id FROM pedidos WHERE id_usuario = $id ORDER BY dt_pedido DESC LIMIT 1";
    $pedido = $pdo->prepare($numero);
    $pedido->execute();
    
    foreach($pedido as $key){
    if($sql == true){
    echo "<script>alert('Pedido realizado com sucesso! O número do seu pedido é ".$key['id']."');</script>";
    echo "<script>window.location = '../../../views/client/my-orders.php'</script>";
    unset($_SESSION['carrinho']);
    unset($_SESSION['dados']);
    unset($_SESSION['checkout']);
    exit;
    }

   }
 
} 

    




