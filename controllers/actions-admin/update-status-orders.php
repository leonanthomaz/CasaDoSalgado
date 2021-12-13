<?php
    if(isset($_POST['finalizaStatus'])){

    $mudaStatus = $_POST["mudarStatus"];

    $atualizarstatus = $pdo->prepare("UPDATE pedidos SET orderStatus = '$mudaStatus' WHERE id = '".$_POST["finalizarpedido"]."' ");
    $atualizarstatus->execute(array($_POST["finalizarpedido"]));
    $linha = $atualizarstatus->rowCount();
    echo "<script>alert('Status atualizado com sucesso!');</script>";
    echo "<script>window.location = '../../views/admin/orders.php'</script>"; 

    }
?>