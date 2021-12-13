<?php
  $id = $_SESSION['id'];
  $sql = "SELECT * FROM users WHERE id = '$id'";
  $stmt = $pdo->prepare($sql);
  $resultado_user = $stmt->execute();
  $linha_user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($linha);
  foreach($linha_user as $user):
  $usuario = array(
  'id' => $user['id'],
  'cliente' => $user['cliente'],
  );
?>

<?php include "../../controllers/functions/global-functions/opening-hours.php";
$saudacao = saudacao();
$login = htmlspecialchars($usuario["cliente"]);
?>

<?php endforeach;?>
