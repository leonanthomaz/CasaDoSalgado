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

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  
  $tamanho_max = 4194304; // 4 megabytes
  //$MB = $tamanho_max/4096/4096;

  if (empty($_FILES['imagem']['name'])) {
    echo "<script>alert('Você não selecionou nenhuma imagem!');</script>";
    echo "<script>window.location = '../../views/admin/register-product.php'</script>";
  }
  if ($_FILES['imagem']['size'] > $tamanho_max) {
      echo "<script>alert('Tamanho máximo da imagem é de 5 MEGAS!');</script>";
      echo "<script>window.location = '../../views/admin/register-product.php'</script>";
  }
  if(empty($_POST['produto'] && ($_POST['valor_unitario'] && ($_POST['descricao'] && ($_POST['categoria']))))){
    echo "<script>alert('Não deixe os campos em branco!');</script>";
    echo "<script>window.location = '../../views/admin/register-product.php'</script>";
  }else{
    $ext = explode('.', $_FILES['imagem']['name']);
    $ext = end($ext);
    $filename = "../../views/public/img/".time(). '.' .$ext; // destino e nome do ficheiro, neste caso será na mesma pasta onde está este código php
    move_uploaded_file($_FILES['imagem']['tmp_name'], $filename);
    $produto = $_POST['produto'];
    $valor_unitario = $_POST['valor_unitario'];
    $descricao = $_POST['descricao'];
    $foto =  $filename;
    $categoria = $_POST['categoria'];
    
    // DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
    date_default_timezone_set('America/Sao_Paulo');
    // CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
    $dataLocal = date('Y/m/d H:i:s', time());
    
    $sql = $pdo->prepare("INSERT INTO produtos (produto, valor_unitario, descricao, imagem, categoria, dt_cadastro_produto) 
    VALUES ('$produto','$valor_unitario','$descricao','$foto', '$categoria', '$dataLocal' )");// aqui coloca o que quiser na base de dados
    $sql->execute();
  }

  if($sql == true){
    echo "<script>alert('Produto cadastrado com sucesso!');</script>"; 
    echo "<script>window.location = '../../views/admin/register-product.php'</script>";
  }else{
  echo "<script>alert('Algo deu errado... Verifique os campos e tente novamente!');</script>";
  }
}
?>

