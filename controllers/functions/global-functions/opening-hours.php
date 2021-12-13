<?php

//Função de trava ou liberação do carrinho.
function horarioFuncionamento() {
    date_default_timezone_set('America/Sao_Paulo');
    $hora = date("H:m");
    //Aqui define o horário de funcionamento, travando o botão que leva os produtos via array para o carrinho de compras.
    $abre = "18:00";
    $fecha = "23:30";
    //Condição para o Horário de Funcionamento
    if($hora < $abre || $hora > $fecha )
    //Condição verdadeira pra horário, apresenta a mensagem de funcionamento
    return "<div class='box-form' style='background: white; padding: 10px; border-radius: 10px'><h6 style='color: red'>Estamos fechados no momento. Nosso horário de atendimento é das 18h às 23h30, de segunda a sexta.</h6></div>";
      else if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
        //Condição verdadeira pra usuário logado, apresenta a mensagem para fazer login ou cadastrar
        return "<h3 style='color: red; background: white; padding: 10px; border-radius: 10px'>Faça login e peça em instantes!</h3>";
    else
      //Se todas as condições forem falsas, libera o carrinho de compras.
      return "";
}


