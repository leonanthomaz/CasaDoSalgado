<?php       
      if(isset($_GET['d'])){
        $id = $_GET['d'];
    
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt -> bindParam(':id', $id);
        $result = $stmt -> execute();
        if(!$result){
            var_dump($stmt->errorInfo());
            exit;
        }else{
            echo "<script>alert('Conta excluída com sucesso!');</script>";
            echo "<script>window.location = '../../../index.php'</script>";  
            // Destrua a sessão.
            session_destroy();
            }
        }
      
      ?>