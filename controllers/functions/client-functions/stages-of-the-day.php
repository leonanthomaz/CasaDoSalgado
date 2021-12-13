<?php

function saudacao( $nome = '' ) {
    date_default_timezone_set('America/Sao_Paulo');
    $hora = date('H');
    if( $hora >= 6 && $hora <= 12 )
      return 'Bom dia' . (empty($nome) ? '' : ', ' . $nome);
    else if ( $hora > 12 && $hora <=18  )
      return 'Boa tarde' . (empty($nome) ? '' : ', ' . $nome);
    else
      return 'Boa noite' . (empty($nome) ? '' : ', ' . $nome);
}