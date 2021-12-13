<?php

if(isset($pagamento)){
if($pagamento == 1){
    $formaDePagamento = "<div style='color: green;'>Pagamento em Dinheiro</div>";
  }else if($pagamento == 2){
    $formaDePagamento = "<div style='color: blue;'>Pagamento em Cartão</div>";
  }else if($pagamento == 3){
    $formaDePagamento = "<div style='color: purple;'>Pagamento via Pix</div>";
  }
}


if(isset($Pedido['pagamento'])){
  if($Pedido['pagamento'] == 1){
    $formaDePagamento = "<div style='color: green;'>Pagamento em Dinheiro</div>";
  }else if($Pedido['pagamento'] == 2){
    $formaDePagamento = "<div style='color: blue;'>Pagamento em Cartão</div>";
  }else if($Pedido['pagamento'] == 3){
    $formaDePagamento = "<div style='color: purple;'>Pagamento via Pix</div>";
  }else{
    $formaDePagamento = "Não reconhecido";
  }
}
?>