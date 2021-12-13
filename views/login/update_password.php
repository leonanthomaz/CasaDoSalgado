
<?php require_once("../../controllers/connect/connect-update-password.php"); ?>

<?php include("../login/includes/header.php"); ?>

<div class="text-center">
    <div class="bloco-login"><br> 

        <?php 
        if (isset($_SESSION['msg_rec'])) {
        echo $_SESSION['msg_rec'];
        unset($_SESSION['msg_rec']);
        }
        ?>   

        <!-- Logo principal -->
        <?php include_once "../public/includes/logo-amarelo.php"; ?>

        <h2>Atualizar senha</h2><br><br>

        <div class="text-center">
            <form method="POST" action="">
                <?php
                $usuario = "";
                if (isset($dados['password'])) {
                    $usuario = $dados['password'];
                } ?>
                <strong>Digite uma nova senha</strong><br><br>
                <div class="form-group">
                <input type="password" name="password" placeholder="Sua nova senha é..." value="<?php echo $usuario; ?>" class="form-control">
                </div><br>
                <input class="btn btn-primary" type="submit" value="Atualizar" name="SendNovaSenha">
            </form>
            <br>
            <strong><p>Possui uma conta? <a class="btn btn-warning btn-sm" href="../../index.php">Entre aqui</a></p></strong>
        </div>
        
    </div>
</div>
    
<?php include "./includes/footer.php"; ?>

