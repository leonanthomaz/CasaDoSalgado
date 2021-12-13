<?php
session_start();
include_once '../../models/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../lib/vendor/autoload.php';
$mail = new PHPMailer(true);

?>

<?php
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($dados['SendRecupSenha'])) {
    //var_dump($dados);
    $query_usuario = "SELECT id, username, email 
                FROM users 
                WHERE email =:email  
                LIMIT 1";
    $result_usuario = $pdo->prepare($query_usuario);
    $result_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
    $result_usuario->execute();

    if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
        $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        $chave_recuperar_senha = password_hash($row_usuario['id'], PASSWORD_DEFAULT);
        //echo "Chave $chave_recuperar_senha <br>";

        $query_up_usuario = "UPDATE users 
                    SET recuperar_senha =:recuperar_senha 
                    WHERE id =:id 
                    LIMIT 1";
        $result_up_usuario = $pdo->prepare($query_up_usuario);
        $result_up_usuario->bindParam(':recuperar_senha', $chave_recuperar_senha, PDO::PARAM_STR);
        $result_up_usuario->bindParam(':id', $row_usuario['id'], PDO::PARAM_INT);

        if ($result_up_usuario->execute()) {
            //Insira o caminho do seu projeto para, do inicio do link até a extensão PHP para que funcione.
            $link = "https://casadossalgadosabv.000webhostapp.com/login/update_password.php?chave=$chave_recuperar_senha";

            try {
                /*$mail->SMTPDebug = SMTP::DEBUG_SERVER;*/
                $mail->CharSet = 'UTF-8';
                $mail->isSMTP(); 
                $mail->SMTPDebug = 0; //2para debugar com mensagem 
                $mail->Host = "smtp.gmail.com"; 
                $mail->Port = 587;
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth = true;
                $mail->Username   = 'casadossalgadosabv@gmail.com';
                $mail->Password   = 'Casa@0904';
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->setFrom('casadossalgadosabv@gmail.com', 'Atendimento | Casa dos Salgados');
                $mail->addAddress($row_usuario['email'], $row_usuario['username']);

                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Recuperar senha';
                $mail->Body    = 'Prezado(a) ' . $row_usuario['username'] .".<br><br>Você solicitou alteração de senha.<br><br>Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: <br><br><a href='" . $link . "'>" . $link . "</a><br><br>Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.<br><br>";
                $mail->AltBody = 'Prezado(a) ' . $row_usuario['username'] ."\n\nVocê solicitou alteração de senha.\n\nPara continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: \n\n" . $link . "\n\nSe você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.\n\n";

                $mail->send();

                $_SESSION['msg_rec'] = "
                    <div class='box-alert-recouver-pass'>
                        <div class='text-center'>
                            <strong style='color: green'>
                            Enviado e-mail com instruções para recuperar a senha. Acesse a sua caixa de e-mail para recuperar! Se não conseguir visualizar, consulte sua caixa de spam!
                            </strong>
                        </div>
                    </div><br><br>";
                //header("Location: ./recuperar_senha.php");
            } catch (Exception $e) {
                $_SESSION['msg_rec'] = "
                <div class='box-form'>
                    <div class='text-center'>
                        <strong style='color: red'> Ops! E-mail não enviado! Tente novamente. Mailer Error: {$mail->ErrorInfo}!</strong>
                    </div>
                </div>";
            }
        } else {
            $_SESSION['msg_rec'] =  "
            <div class='box-form'>
                <div class='text-center'>
                    <strong style='color: red'>Erro: Tente novamente!</strong>
                </div>
            </div>";
        }
    } else {
        $_SESSION['msg_rec'] = "
        <div class='box-form'>
            <div class='text-center'>
                <strong style='color: red'>Erro: Usuário não encontrado!</strong>
            </div>
        </div>";
    }
}
?>