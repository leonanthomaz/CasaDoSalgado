<?php 
require_once("../../models/config.php");
require_once("../../controllers/connect/connect-login.php"); 
?>

<?php include "../login/includes/header.php"; ?>

<div class="bloco-login"><br>
    <div class="text-center">

    <!-- Logo principal -->
    <?php include_once "../public/includes/logo-amarelo.php"; ?>

    <!-- Mensagem de sucesso de erro - acesso ao login -->   
    <?php 
    if(!empty($login_err)){
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
    }
    ?><br>

    <h2>Login</h2><br>
    <strong>Por favor, preencha os campos para fazer o login.</strong><br><br>
    </div>

    <!-- Formulário login -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <strong>Nome do usuário</strong><br>
            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
            <span class="invalid-feedback" style="background: white;"><?php echo $username_err; ?></span>
        </div><br>  
        <div class="form-group">
            <strong>Senha</strong><br>
            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback" style="background: white;"><?php echo $password_err; ?></span>
        </div><br>
        <div class="text-center">
            <div class="form-group">
                <input type="submit" class="botao-enviar" value="Entrar"><br><br>
                <strong>Não tem uma conta?</strong><br>
                <a href="./register.php"><input type="button" class="botao-registrar" value="Cadastre-se agora" /></a><br><br>
                <strong>Esqueceu a senha?</strong><br>
                <a href="./recouver_password.php"><input type="button" class="botao-esqueci-senha" value="Clique aqui para recuperar" /></a>
            </div> 
        </div> 
    </form><br><br>
    
    <!-- Botão voltar -->
    <a href="../../index.php" style="color: white; font-size:24px; margin-left: 10px"><i class="fa fa-arrow-left" aria-hidden="true" ></i> <span style="color: white; font-size: 20px">Voltar ao início</span></a>

</div><br>

<?php include "../login/includes/footer.php"; ?>

