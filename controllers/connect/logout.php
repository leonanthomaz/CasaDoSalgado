<?php
// Inicializando a sessão
session_start();
 
// Removendo todas as variáveis de sessão
$_SESSION = array();
 
// Destruindo a sessão.
session_destroy();
 
// Redirecionando para a página principal
header("location: ../../index.php");
exit;
?>