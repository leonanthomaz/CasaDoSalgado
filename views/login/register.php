<?php 
require_once("../../models/config.php");
require_once("../../controllers/connect/connect-register.php"); 
?>

<?php include("../login/includes/header.php"); ?>

    <div class="bloco-login"><br>
        <?php 
        if(!empty($register_err)){
            echo '<div class="alert alert-danger">' . $register_err . '</div>';
        }
        ?>
                   
        <!-- Logo principal -->
        <?php include_once "../public/includes/logo-amarelo.php"; ?>

        <div class="text-center">
            <h2>Cadastro</h2><br>
            <strong>Por favor, preencha este formulário para criar uma conta.</strong><br><br>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <strong>Como prefere ser chamado?</strong><br>
                <input type="text" name="cliente" class="form-control <?php echo (!empty($cliente_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cliente; ?>">
                <span class="invalid-feedback" style="background: white;"><?php echo $cliente_err; ?></span>
            </div><br> 
            <div class="form-group">
                <strong>Nome do usuário</strong><br>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback" style="background: white;"><?php echo $username_err; ?></span>
            </div><br> 
            <div class="row">
              <div class="col-md-6 mb-3">
                <strong>Telefone</strong><br>                            
                <input type="text" name="telefone" class="form-control <?php echo (!empty($telefone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $telefone; ?>">
                <span class="invalid-feedback" style="background: white;"><?php echo $telefone_err; ?></span>
              </div>
            </div><br> 
            <div class="form-group">
                <strong><label>E-mail</label></strong>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback" style="background: white;"><?php echo $email_err; ?></span>
            </div><br> 
            <div class="form-group">
                <strong><label>Endereço</label></strong>
                <input type="text" name="endereco" class="form-control <?php echo (!empty($endereco_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $endereco; ?>">
                <span class="invalid-feedback" style="background: white;"><?php echo $endereco_err; ?></span>
            </div><br>  
            <div class="form-group">
                <strong><label>Ponto de Referência</label></strong>
                <input type="text" name="ponto" class="form-control <?php echo (!empty($ponto_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ponto; ?>">
                <span class="invalid-feedback" style="background: white;"><?php echo $ponto_err; ?></span>
            </div><br>
            <div class="form-group">
                <strong><label>Localidade</label></strong>
                <div class="text-center">
                <select name="localidade" class="form-control <?php echo (!empty($localidade_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $localidade; ?>">
                    <option>Selecione sua região</option>
                    <?php include "../public/includes/list-select-local.php"; ?>
                </select>
                </div>     
                <span class="invalid-feedback" style="background: white;"><?php echo $localidade_err; ?></span>
            </div><br> 
            <div class="form-group">
                <strong><label>Senha</label></strong>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback" style="background: white;"><?php echo $password_err; ?></span>
            </div><br>
            <div class="form-group">
                <strong><label>Confirme a senha</label></strong>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback" style="background: white;"><?php echo $confirm_password_err; ?></span>
            </div><br>
            <div class="text-center">
            <div class="form-group">
                <input type="submit" class="botao-enviar" value="Criar Conta"><br><br>
                <input type="reset" class="botao-limpar-dados" value="Limpar Dados"><br>
            </div><br>
                <strong>Possui uma conta?</strong><br>
                <a href="./login.php"><input type="button" class="botao-registrar" value="Entre aqui" /></a><br><br>
            </div>
        </form><br><br>

        <!-- Botão voltar -->
        <a href="../../index.php" style="color: white; font-size:24px; margin-left: 10px"><i class="fa fa-arrow-left" aria-hidden="true" ></i> <span style="color: white; font-size: 20px">Voltar ao início</span></a>
    </div>

    <?php include("../login/includes/footer.php"); ?>
