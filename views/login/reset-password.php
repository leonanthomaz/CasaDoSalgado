<?php 
require_once("../../models/config.php");
require_once("../../controllers/connect/connect-reset-password.php"); 
?>

<!-- Incluindo header -->
<?php include("../login/includes/header.php"); ?>

<div class="bloco-login">
        <!-- Logo principal -->
        <?php include_once "../public/includes/logo-amarelo.php"; ?>

        <div class="text-center">
            <h2>Redefinir Senha</h2><br>
            <strong>Por favor, preencha este formulário para redefinir sua senha.</strong><br><br>

            <!-- Formulário de atualização -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                <div class="form-group">
                    <label>Nova senha</label>
                    <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                    <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Confirme a senha</label>
                    <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                </div><br>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Redefinir"><br><br>
                </div>
            </form>
        </div>
        
        <!-- Botão voltar -->
        <a href="../client/update_profile.php" style="color: white; font-size:24px; margin-left: 10px"><i class="fa fa-arrow-left" aria-hidden="true" ></i> <span style="color: white; font-size: 20px">Voltar as minhas informações</span></a>
    </div> 
    
<!-- Incluindo footer -->
<?php include "./includes/footer.php"; ?>
