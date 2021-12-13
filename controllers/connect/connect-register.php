<?php
// Inicialização de sessão
session_start();

require_once("../../models/config.php");

// Verificando se o usuário já está logado, em caso afirmativo, redireciono para a página de boas-vindas
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../../views/pages/dashboard.php");
    exit;
}
 
// Definindo variáveis e inicializando com valores vazios
$cliente = $username = $telefone = $email = $endereco = $ponto = $localidade = $password = $confirm_password = "";
$cliente_err = $username_err = $telefone_err = $email_err = $endereco_err = $ponto_err = $localidade_err = $password_err = $confirm_password_err = $register_err = "";
 
// Processando dados do formulário quando o formulário é enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validando nome
    if(empty($_POST["cliente"])){
        $cliente_err = "Por favor digite seu nome.";
    } else{
        // Prepare uma declaração selecionada
        $sql = "SELECT id FROM users WHERE cliente = :cliente";
        
        if($stmt = $pdo->prepare($sql)){
            // Vinculando as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":cliente", $param_cliente, PDO::PARAM_STR);

            // Definir parâmetros
            $param_cliente = $_POST["cliente"];
    
            // Tente executar a declaração preparada
            if($stmt->execute()){
                $cliente = trim($_POST["cliente"]);
            }else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
            // Fechar declaração
            unset($stmt);
        }
    }
 
    // Validando nome de usuário
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor coloque um nome de usuário.";
    } elseif(!preg_match('/^[a-zA-Z0-9_.@]+$/', trim($_POST["username"]))){
        $username_err = "O nome de usuário pode conter apenas letras, números e sublinhados.";
    } else{
        // Preparando uma declaração selecionada
        $sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Vinculando as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Definir parâmetros
            $param_username = trim($_POST["username"]);
 
            // Executando a declaração preparada
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "Este nome de usuário já está em uso.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechando declaração
            unset($stmt);
        }
    }
    
    // Validar telefone
    if(empty(trim($_POST["telefone"]))){
        $telefone_err = "Por favor digite seu telefone.";
    } elseif(!preg_match('/^[0-9]{11}$/', trim($_POST["telefone"]))){
        $telefone_err = "Digite um telefone válido.";
    } else{

        // Preparando uma declaração selecionada
        $sql = "SELECT id FROM users WHERE telefone = :telefone";
        
        if($stmt = $pdo->prepare($sql)){
            // Vinculando as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":telefone", $param_telefone, PDO::PARAM_STR);

            // Definir parâmetros
            $param_telefone = trim($_POST["telefone"]);
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $telefone_err = "Este telefone já está em uso.";
                } else{
                    $telefone = trim($_POST["telefone"]);
                }
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechando declaração
            unset($stmt);
        }
    }

    //Validando Email

    if(empty(trim($_POST["email"]))){
        $email_err = "Por favor informe seu email.";
    }elseif(!preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', trim($_POST["email"]))){
        $email_err = "Digite um email válido.";
    }else{
    $sql = "SELECT id FROM users WHERE email = :email";

        if($stmt = $pdo->prepare($sql)){
            // Vinculando as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

            
            // Definindo parâmetros
            $param_email = trim($_POST["email"]);

            // Tentando executar a declaração preparada
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $email_err = "Este email já está em uso.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }
        }
    }

    // Validando endereço
    if(empty($_POST["endereco"])){
        $endereco_err = "Por favor coloque o endereço.";
    }else{
        // Preparando uma declaração selecionada
        $sql = "SELECT id FROM users WHERE endereco = :endereco";
        
        if($stmt = $pdo->prepare($sql)){
            // Vinculando as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":endereco", $param_endereco, PDO::PARAM_STR);

            
            // Definindo parâmetros
            $param_endereco = $_POST["endereco"];

            if($stmt->execute()){
               
            $endereco = $_POST["endereco"];
                
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechando declaração
            unset($stmt);
        }
    }

     // Validando Ponto de referência
     if(empty($_POST["ponto"])){
        $ponto_err = "Por favor coloque um ponto de referência.";
    }else{
        // Preparando uma declaração selecionada
        $sql = "SELECT id FROM users WHERE ponto = :ponto";
        
        if($stmt = $pdo->prepare($sql)){
            // Vinculando as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":ponto", $param_ponto, PDO::PARAM_STR);

            
            // Definindo parâmetros
            $param_ponto = $_POST["ponto"];

            if($stmt->execute()){
               
            $ponto = $_POST["ponto"];
                
            } else{
                $register_err = "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechando declaração
            unset($stmt);
        }
    }

    // Validando Localidade
    if(empty($_POST["localidade"])){
        $localidade_err = "Por favor, indique sua localização! Obs: Atendemos apenas no Alto da Boa Vista e adjacências.";
    }elseif($_POST["localidade"] == 0){
        $localidade_err = "Localização inválida! Obs: Atendemos apenas no Alto da Boa Vista e adjacências.";
    }else{
        

        // Preparando uma declaração selecionada
        $sql = "SELECT id FROM users WHERE localidade = :localidade";
        
        if($stmt = $pdo->prepare($sql)){
            // Vinculando as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":localidade", $param_localidade, PDO::PARAM_STR);

            // Definindo parâmetros
            $param_localidade = $_POST["localidade"];

            if($stmt->execute()){
               
            $localidade = $_POST["localidade"];
                
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechando declaração
            unset($stmt);
        }
    }

    // Validando senha
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor insira uma senha.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "A senha deve ter pelo menos 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validando e confirmando a senha
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por favor, confirme a senha.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "A senha não confere.";
        }
    }
    
    // Verificando os erros de entrada antes de inserir no banco de dados
    if (empty($cliente_err) && (empty($username_err) && (empty($telefone_err) && (empty($email_err) && (empty($endereco_err) && (empty($ponto_err) && (empty($localidade_err) && empty($password_err) && empty($confirm_password_err)))))))){
        
        // Fuso horário de Brasília
        date_default_timezone_set('America/Sao_Paulo');
        // Armazenando horário em uma variável
        $dataLocal = date('Y/m/d H:i:s', time());
        // Preparando uma declaração de inserção
        $sql = "INSERT INTO users (cliente, username, telefone, email, endereco, ponto, localidade, password, created_at) VALUES (:cliente,:username, :telefone, :email, :endereco, :ponto, :localidade, :password, '$dataLocal')";
         
        if($stmt = $pdo->prepare($sql)){
            // Vinculando as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":cliente", $param_cliente, PDO::PARAM_STR);
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":telefone", $param_telefone, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":endereco", $param_endereco, PDO::PARAM_STR);
            $stmt->bindParam(":ponto", $param_ponto, PDO::PARAM_STR);
            $stmt->bindParam(":localidade", $param_localidade, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);

            // Definindo parâmetros
            $param_cliente = $cliente;
            $param_username = $username;
            $param_telefone = $telefone;
            $param_email = $email;
            $param_endereco = $endereco;
            $param_ponto = $ponto;
            $param_localidade = $localidade;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Tentando executar a declaração preparada
            if($stmt->execute()){

                if($stmt == true){
                // Redirecionando para a página de login
                echo "<script>alert('Usuário cadastrado com sucesso! Faça login para continuar.');</script>";
                echo "<script>window.location = '../../views/login/login.php'</script>";
                }
                
            } else{
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