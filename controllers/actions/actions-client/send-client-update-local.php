<?php
session_start();
include_once "../../../models/config.php";

// Verifique se o usuário está logado, se não, redirecione-o para uma página de login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    if($_SESSION['loggedin'] != $_SESSION['id']['loggedin'])
    header("location: ../../../index.php");
    exit;
}

//var_dump($_POST['enviar_profile']);

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_SESSION['id'];
    $localidade = $_POST['localidade'];
    if(empty($localidade) || $localidade == 0){
    //if(empty($localidade) || $localidade == 0){
        echo "<script>alert('Por favor, insira sua nova região.');</script>";
    }else{
        $stmt = $sql = $pdo->prepare("UPDATE users SET localidade = :localidade WHERE id = '$id'");
        $stmt->bindParam(':localidade', $localidade);
        $sql->execute();
    }

}

if($sql == true){
    echo "<script>alert('Região atualizada com sucesso!');</script>";
    echo "<script>window.location = '../../../views/cart/cart.php'</script>";
}else{
    echo "<script>alert('Erro ao atualizar região. Verifique os campos e tente novamente!');</script>";
}
