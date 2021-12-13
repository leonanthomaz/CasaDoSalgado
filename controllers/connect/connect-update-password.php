<?php
session_start();
ob_start();
include_once '../../models/config.php';
?>

<?php

    //caputando a chave criptografada enviada por email
    $chave = filter_input(INPUT_GET, 'chave', FILTER_DEFAULT);

    if (!empty($chave)) {

        //Se for diferente de vazia, verifica no banco se há alguma chave cadastrada
        $query_usuario = "SELECT id 
                            FROM users 
                            WHERE recuperar_senha =:recuperar_senha  
                            LIMIT 1";
        $result_usuario = $pdo->prepare($query_usuario);
        $result_usuario->bindParam(':recuperar_senha', $chave, PDO::PARAM_STR);
        $result_usuario->execute();

        //Se encontrar alguma, realiza o update
        if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (!empty($dados['SendNovaSenha'])) {
                $senha_usuario = password_hash($dados['password'], PASSWORD_DEFAULT);
                $recuperar_senha = 'NULL';

                $query_up_usuario = "UPDATE users 
                        SET password =:password,
                        recuperar_senha =:recuperar_senha
                        WHERE id =:id 
                        LIMIT 1";
                $result_up_usuario = $pdo->prepare($query_up_usuario);
                $result_up_usuario->bindParam(':password', $senha_usuario, PDO::PARAM_STR);
                $result_up_usuario->bindParam(':recuperar_senha', $recuperar_senha);
                $result_up_usuario->bindParam(':id', $row_usuario['id'], PDO::PARAM_INT);

                if ($result_up_usuario->execute()) {
                //Mensagem de sucesso ou erro de execução da operação
                $_SESSION['msg_rec'] = "
                    <div class='box-alert-recouver-pass'>
                        <div class='text-center'><br>
                            <strong style='color: green'>Senha atualizada com sucesso!</strong><br>
                        </div>
                    </div><br><br>";
                } else {
                    $_SESSION['msg_rec'] = "
                    <div class='box-form'>
                        <div class='text-center'>
                            <strong style='color: red'>Erro: Tente novamente!</strong>
                        </div>
                    </div>";
                }
            }
        }else{
        $_SESSION['msg_rec'] = "
            <div class='box-form'>
                <div class='text-center'>
                    <strong style='color: red'>Erro: Link inválido, solicite novo link para atualizar a senha!</strong>
                </div>
            </div>";
        }
    } else {
        $_SESSION['msg_rec'] = "
        <div class='box-form'>
            <div class='text-center'>
                <strong style='color: red'>Erro: Link inválido, solicite novo link para atualizar a senha!</strong>
            </div>
        </div>";
    }
?>