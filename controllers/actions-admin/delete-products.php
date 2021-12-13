<?php       
    if(isset($_GET['d'])){
    $id = $_GET['d'];
    $sql = "DELETE FROM produtos WHERE id_produto = :id";
    $stmt = $pdo->prepare($sql);
    $stmt -> bindParam(':id', $id);
    $result = $stmt -> execute();
    if(!$result){
        var_dump($stmt->errorInfo());
        exit;
    }else{
        echo "<script>alert('Produto excluído com sucesso!');</script>";
        echo "<script>window.location = '../../views/admin/update-product.php'</script>";  
        }
    }
?> 