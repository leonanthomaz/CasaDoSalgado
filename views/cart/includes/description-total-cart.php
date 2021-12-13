<?php
    $valorSemFrete =  "R$".number_format($totalCarts, 2, ',', '.')."";
    $TaxaDeEntrega ="R$".number_format($frete, 2, ',', '.')."";
    $SomaFinal = $totalCarts + $frete;
    $ValorFinal = "R$".number_format($SomaFinal, 2, ',', '.')."";
    $checkout = "
    <div>
    <h5>Valor da compra: $valorSemFrete</h5><br>
    <h5>Taxa de entrega: $TaxaDeEntrega</h5><br>
    <div class='sep'></div><br>
    <h5 class='valorfinal'><b>Valor Final: $ValorFinal </b></h5>
    </div>
    ";
?>