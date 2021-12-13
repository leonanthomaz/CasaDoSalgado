<!-- Conexão do formulário -->
<?php include "../../controllers/connect/connect-recouver-password.php"; ?>


<?php include("../login/includes/header.php"); ?>


<div class="bloco-login"><br>
    <div class="text-center">
        <!-- Feedback de retorno da requisição de recuperação -->
        <?php 
        if (isset($_SESSION['msg_rec'])) {
        echo $_SESSION['msg_rec'];
        unset($_SESSION['msg_rec']);
        }
        ?>

        <!-- Logo principal -->
        <?php include_once "../public/includes/logo-amarelo.php"; ?>

        <h2>Recuperar Senha</h2><br>
        
        <!-- Formulário de recuperação -->
        <form method="POST" action="">
            <?php
            $usuario = "";
            if (isset($dados['email'])) {
                $usuario = $dados['email'];
            }?>
            
            <div class="form-group">
            <strong><label>E-mail</label></strong>
            <input type="text" class="form-control" name="email" placeholder="Digite o usuário" value="<?php echo $usuario; ?>"><br>
            </div>  
        
            <input type="submit" value="Recuperar" name="SendRecupSenha" class="botao-enviar">
        </form>
        <br>

        <!-- Botão de envio ao login -->
        <strong>Lembrou?</strong><br>
        <a href="./login.php"><input type="button" class="botao-registrar" value="clique aqui!" /></a><br><br>

    </div>
    <!-- Botão voltar -->
    <a href="../../index.php" style="color: white; font-size:24px; margin-left: 10px"><i class="fa fa-arrow-left" aria-hidden="true" ></i> <span style="color: white; font-size: 20px">Voltar ao início</span></a>
</div>

<?php include("../login/includes/footer.php"); ?>


