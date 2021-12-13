<?php

foreach ($lista as $usuario){

    if ($_SESSION['id'] === $usuario['id']){
        
        $local = $usuario['localidade'];
        //Tijuaçu
        if($usuario['localidade'] == 1){
            $frete = 4;
        //Mata Machado
        }else if($usuario['localidade'] == 2){
            $frete = 4;
        //Biguá   
        }else if($usuario['localidade'] == 3){
            $frete = 4;
        //Maracaí  
        }else if($usuario['localidade'] == 4){
            $frete = 4;
        //Butui 
        }else if($usuario['localidade'] == 5){
            $frete = 4;
        //Minha Deusa 
        }else if($usuario['localidade'] == 6){
            $frete = 4;
        //Agrícola  
        }else if($usuario['localidade'] == 7){
            $frete = 4;
        //Valeriano 
        }else if($usuario['localidade'] == 8){
            $frete = 4;
        //Furnas
        }else if($usuario['localidade'] == 9){
            $frete = 5;
        //Soberbo
        }else if($usuario['localidade'] == 10){
            $frete = 7;
        //Bombeiro 
        }else if($usuario['localidade'] == 11){
            $frete = 7;
        //Gavea Pequena
        }else if($usuario['localidade'] == 12){
            $frete = 7;
        //Praça do Alto
        }else if($usuario['localidade'] == 13){
            $frete = 7;
        //Açude 
        }else if($usuario['localidade'] == 14){
            $frete = 7;
        //Casa do Prefeito
        }else if($usuario['localidade'] == 15){
            $frete = 7;
        //Taquara do Alto
        }else if($usuario['localidade'] == 16){
            $frete = 7;
        //Vista Chinesa
        }else if($usuario['localidade'] == 17){
            $frete = 7;
        //Morro do Banco
        }else if($usuario['localidade'] == 18){
            $frete = 7;
        //Itanhanga 
        }else if($usuario['localidade'] == 19){
            $frete = 8;
        //Tijuquinha 
        }else if($usuario['localidade'] == 20){
            $frete = 8;
        //Usina 
        }else if($usuario['localidade'] == 21){
            $frete = 8;
        //Estrada Velha
        }else if($usuario['localidade'] == 22){
            $frete = 8;
        }
        
    }
    
}

?>