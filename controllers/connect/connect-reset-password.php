<?php
// Inicialização de sessão
session_start();

// Verificando se o usuário já está logado, em caso afirmativo, redireciono para a página de boas-vindas
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../index.php");
    exit;
}
 
// Incluindo arquivo de configuração
require_once "../../models/config.php";
 
// Definindo variáveis e inicializando com valores vazios
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processando dados do formulário quando o formulário é enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validando nova senha
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Por favor insira a nova senha.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "A senha deve ter pelo menos 6 caracteres.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validando e confirmando a senha
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por favor, confirme a senha.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "A senha não confere.";
        }
    }
        
    // Verificando os erros de entrada antes de inserir no banco de dados
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Preparando uma declaração de atualização
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        
        if($stmt = $pdo->prepare($sql)){
            // Vinculando as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);
            
            // Definindo parâmetros
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Tentando executar a declaração preparada
            if($stmt->execute()){
            // Criando alerta de senha atualizada com sucesso e redirecionando a pagina de login
            echo"<script>alert('Senha atualizada com sucesso!');</script>";
            echo "<script type='text/javascript'>window.top.location='../../views/client/update_profile.php';</script>"; exit;
            session_destroy();

            }else{
                // Ou mensagem de erro de execução
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechando declaração
            unset($stmt);
        }
    }
    
    // Fechando conexão
    unset($pdo);
}
?>
