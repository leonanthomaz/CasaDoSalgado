<?php
/* Credenciais do banco de dados */


define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'db.leonan');
define('DB_PASSWORD', 'leonan2knet');
define('DB_NAME', 'ecommerce');


/* credenciais site teste
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'id18065164_dbcdsabv');
define('DB_PASSWORD', 'Leo@2knetabv');
define('DB_NAME', 'id18065164_cdsabv');
*/


/* Conexão com o banco de dados MySQL */
try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Defina o modo de erro PDO para exceção
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Não foi possível conectar." . $e->getMessage());
}
?>