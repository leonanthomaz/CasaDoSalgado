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
    echo "<script>window.location = '../../views/admin/update-product.php'</script>";
    // Fechar declaração
    unset($stmt);
    exit;
  }
  if ($_FILES['imagem']['size'] > $tamanho_max) {
      echo "<script>alert('Tamanho máximo da imagem é de 5 MEGAS!');</script>";
      echo "<script>window.location = '../../views/admin/update-product.php'</script>";
      // Fechar declaração
      unset($stmt);
      exit;
  }else{
    $ext = explode('.', $_FILES['imagem']['name']);
    $ext = end($ext);
    $filename = "../../views/public/img/".time(). '.' .$ext; // destino e nome do ficheiro, neste caso será na mesma pasta onde está este código php
    move_uploaded_file($_FILES['imagem']['tmp_name'], $filename);
    $id_produto = $_POST['id_produto'];
    $produto = $_POST['produto'];
    $valor_unitario = $_POST['valor_unitario'];
    $descricao = $_POST['descricao'];
    $foto =  $filename;
    $categoria = $_POST['categoria'];
    
      // DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
    date_default_timezone_set('America/Sao_Paulo');
    // CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
    $dataLocal = date('Y/m/d H:i:s', time());

    $stmt = $sql = $pdo->prepare("UPDATE produtos SET produto = :produto, valor_unitario = :valor_unitario, descricao = :descricao, imagem = :imagem, categoria = :categoria, dt_cadastro_produto = '$dataLocal'  WHERE id_produto = :id_produto");
    $stmt->bindParam(':id_produto', $id_produto);
    $stmt->bindParam(':produto', $produto);
    $stmt->bindParam(':valor_unitario', $valor_unitario);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':imagem', $foto);
    $stmt->bindParam(':categoria', $categoria);
    $sql->execute();

    if($sql == true){
      echo "<script>alert('Produto atualizado com sucesso!');</script>"; 
      echo "<script>window.location = '../../views/admin/update-product.php'</script>";
    }else{
    echo "<script>alert('Algo deu errado... Verifique os campos e tente novamente!');</script>";
    }
  }
}
?>

<?php include "./includes/footer.php"; ?>

