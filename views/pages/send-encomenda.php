<?php
session_start();
include "../config/config.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    //ok
    $id_cliente = $_POST['id_cliente'];
    $cliente = $_POST['cliente'];
    $opcao = $_POST['opcao'];
    $data_escolhida = $_POST['data_escolhida'];
    //$horario_escolhido = $_POST['horario_escolhido'];
    $observacao = $_POST['observacao'];
    $ativo = $_POST['ativo'];
    $Pagamento = $_POST['pagamento'];

    //ok
    date_default_timezone_set('America/Sao_Paulo');
    $dataLocal = date('Y/m/d H:i:s', time());
    $hora = date("H:m");
    $abre = "10:00";
    $fecha = "12:00";

    $VesperaDeNatal = '2021-12-24';
    $Natal = '2021-12-25';
    $VesperaDeAnoNovo = '2021-12-30';
    $AnoNovo = '2021-12-31';

    //ok
    $sql = $pdo->prepare("SELECT data_escolhida FROM encomendas WHERE data_escolhida = '$data_escolhida'");
    $sql->execute();
        if($sql->rowCount() >= 3){
        echo $_SESSION['erroData'] = "<script>alert('Esta data já atingiu o limite maximo. Por favor, escolha uma nova data.');</script>";
        //echo "<script>window.location = './encomendas.php'</script>";
        unset($sql);
        exit;
    }

    /*
    //ok
    $sql = $pdo->prepare("SELECT horario_escolhido FROM encomendas WHERE data_escolhida = '$data_escolhida'");
    $sql->execute();
    if($sql->rowCount() >= 1){
        echo $_SESSION['erroHorario'] = "<script>alert('Horario ja escolhido nesta data.');</script>";
        //echo "<script>window.location = './encomendas.php'</script>";
        unset($sql);
        exit;
    }

    /*
    if($sql->rowCount() >= 1){
    echo $_SESSION['erroHorario'] = "<script>alert('Horario ja escolhido nesta data.');</script>";
    //echo "<script>window.location = './encomendas.php'</script>";
    unset($sql);
    exit;
    
    }
    */

    /*
    if($hora <= $abre || $hora >= $fecha){
        echo $_SESSION['erroHorarioDeFuncionamento'] = "<script>alert('Horario de Funcionamento de 10h as 12h');</script>";
        //echo "<script>window.location = './encomendas.php'</script>";
        unset($sql);
        exit;
    }
    */

    //$date = '2021-12-12';
    $timestamp = strtotime($data_escolhida);
    $weekday= date("l", $timestamp );
    $normalized_weekday = strtolower($weekday);
    //echo $normalized_weekday ;
    if (($normalized_weekday == "saturday") || ($normalized_weekday == "sunday")) {
        echo $_SESSION['erroFDS'] = "<script>alert('Não atendemos fim de semana');</script>";
        //echo "<script>window.location = './encomendas.php'</script>";
        unset($sql);
        exit;
    }
    
    if($data_escolhida == $VesperaDeNatal || $data_escolhida == $Natal || $data_escolhida == $VesperaDeAnoNovo || $data_escolhida == $AnoNovo){
        echo $_SESSION['erroFestas'] = "<script>alert('Não atendemos em véspera de Natal, Natal, Vespera de Ano Novo e Ano Novo.');</script>";
        //echo "<script>window.location = './encomendas.php'</script>";
        unset($sql);
        exit;
    }

    //ok
    if(empty($_SESSION['erroData'] && $_SESSION['erroHorarioDeFuncionamento'] && $_SESSION['erroFDS'] && $_SESSION['erroFestas'])){

        if(isset($_POST['sabor'])){
            $listaSabores = $_POST['sabor'];
            $sabores = implode(", ", $listaSabores); 
            //var_dump($sabores);         
        }

        $sql = $pdo->prepare("INSERT INTO encomendas (id_cliente, cliente, opcao, data_escolhida, sabores, observacao,  pagamento, ativo, data_encomenda) 
        VALUES ('$id_cliente','$cliente','$opcao','$data_escolhida', '$sabores','$observacao', '$Pagamento', '$ativo',  '$dataLocal' )");  
        $sql->execute();
    }

    if($sql == true){
    $_SESSION['sucessoEncomenda'] = true;
    echo "<script>window.location = './encomendas.php'</script>";
    }else{
        echo "<script>alert('erro!');</script>";
    }
    
     
    
}


