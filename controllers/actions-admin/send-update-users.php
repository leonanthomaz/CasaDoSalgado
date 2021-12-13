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

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    

    $id = $_POST['id'];
    $cliente = $_POST['cliente'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $ponto = $_POST['ponto'];
    $localidade = $_POST['localidade'];

    $_SESSION['erro_perfil_atualizado'] = "";
    if(empty($_POST["cliente"])){
        $_SESSION['erro_perfil_atualizado'];
    }
    if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($username))){
        $_SESSION['erro_perfil_atualizado'];
    }if(empty(trim($telefone))){
        $_SESSION['erro_perfil_atualizado'];
    } elseif(!preg_match('/^[0-9]{11}$/', trim($telefone))){
        $_SESSION['erro_perfil_atualizado'];
    }if(empty(trim($email))){
        $_SESSION['erro_perfil_atualizado'];
    }elseif(!preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', trim($_POST["email"]))){
        $_SESSION['erro_perfil_atualizado'];
    }


    if(empty($cliente && $username && $email && $telefone && $endereco && $ponto && $localidade) || $localidade == 0){
    //if(empty($localidade) || $localidade == 0){
        $_SESSION['erro_perfil_atualizado'];
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

if($stmt == true){
    echo "<script>alert('Perfil atualizado com sucesso!');</script>";
    echo "<script>window.location = '../../views/admin/update-users.php'</script>";
}else{
    echo "<script>alert('Erro ao atualizar perfil. Verifique os campos e tente novamente!');</script>";
}
