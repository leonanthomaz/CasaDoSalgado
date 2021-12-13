<?php

if($orderStatus == 0){
    $StatusInfo = "<div style='color: blue;'>Pedido Realizado</div>";
  }else if($orderStatus == 1){
    $StatusInfo = "<div style='color: orange;'>Pedido Confirmado</div>";
  }else if($orderStatus == 2){
    $StatusInfo = "<div style='color: purple;'>Pedido em Preparo</div>";
  }else if($orderStatus == 3){
    $StatusInfo = "<div style='color: green;'>Pedido saiu para entrega</div>";
  }else if($orderStatus == 4){
    $StatusInfo = "<div style='color: tomato;'>Pedido Entregue</div>";
  }else if($orderStatus == 5){
    $StatusInfo = "<div style='color: red;'>Pedido Cancelado</div>";
  }

?>