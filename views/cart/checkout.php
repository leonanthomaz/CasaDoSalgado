<?php
session_start();
include_once "../../models/config.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login/login.php");
    exit;
}
?>

<?php require_once "./includes/header.php"; ?>

<?php
include "../../models/classes/classes.php";
//Chamando a instância
$listarUsuario = new UsuarioCliente();
$usuarios = $listarUsuario->listarUsuariosCliente($pdo);

$carrinho = $_SESSION['dados'];

include "../../controllers/functions/global-functions/time.php";
$dataLocal;

?>

<div class="bloco-geral-checkout">
<div class="container">
  <div class="py-5 text-center">

  <div class="wow fadeInDown">
    <?php include "../public/includes/logo-amarelo.php"; ?>
  </div><br>

  <h2>Finalizar Pedido</h2>
  </div>
  <div class="text-center">
  </div>
  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
          <div class="text-center">
          <span class="">Seu carrinho</span>
          </div>
          <span class="badge badge-secondary badge-pill"><i class="fa fa-shopping-cart" style="font-size:16px;"></i> <?php echo count($carrinho) ?></span>
        </h4>
      <form method="POST" action="../../controllers/actions/actions-cart/finalize_order.php" class="needs-validation" novalidate>
      <?php $_SESSION['checkout'] = array(); ?>
      <?php foreach($usuarios as $usuario): ?>
      <?php foreach($carrinho as $key): ?>

      <?php include "../public/includes/local-name.php";?>

      <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">Produto:</h6>
            <span class="text-muted"><?php echo $key['Produto'] ?></span>
            <input type="hidden" name="idProduto" value="<?php echo $key['idProduto'] ?>" >
            <h6 class="my-0">Preço:</h6>
            <span class="text-muted">R$<?php echo number_format($key['Preco_Unitario'], 2, ',', '.') ?></span>
            <h6 class="my-0">Quantidade:</h6>
            <span class="text-muted"><?php echo $key['Quantidade'] ?>x</span>
            <input type="hidden" name="Quantidade" value="<?php echo $key['Quantidade'] ?>" >
          </div>
        </li>
        <?php
        array_push(
        $_SESSION['checkout'],
        array(
        'idProduto' =>  $key['idProduto'],
        'Quantidade' =>  $key['Quantidade'],
        'Total' =>  $key['Total'],
        )	
        );
        ?>
        
        <?php endforeach;?>
      </ul>
      <li class="list-group-item d-flex justify-content-between">
        <span>Subtotal:</span>
        <strong><?php echo $key['valorSemFrete'] ?></strong>
      </li>
      <li class="list-group-item d-flex justify-content-between">
        <span>Taxa de entrega:</span>
        <strong name="localidade"><?php echo "R$".number_format($key['frete'], 2, ',', '.')."" ?></strong>
        <input type="hidden" name="frete" value="<?php echo $key['frete'] ?>" >
        <input type="hidden" name="local" value="<?php echo $key['local'] ?>" >
      </li>
      <li class="list-group-item d-flex justify-content-between">
        <span>Total:</span>
        <strong><?php echo "R$".number_format($key['Total'], 2, ',', '.')."" ?></strong>
        <input type="hidden" name="Total" value="<?php echo $key["Total"] ?>" >
      </li>
    </div>
    <div class="container marketing">
      <hr class="featurette-divider" style="color:white;">
    </div>
    <div class="col-md-8 order-md-1">
      <div class="text-center">
      <h4 class="mb-3">Confirme seus Dados</h4>
      </div>
      
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Cliente</label>
            <input type="text" class="form-control" id="firstName" name="cliente" placeholder="" value="<?php echo $usuario['cliente'] ?>" required>
            <div class="invalid-feedback">
            <span class="invalid-feedback"><?php echo $cliente_err; ?></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Nome</label>
            <input type="text" class="form-control" id="firstName" name="username" placeholder="" value="<?php echo $usuario['username'] ?>" required>
            <div class="invalid-feedback">
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="telefone">Telefone</label>
            <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="" value="<?php echo $usuario['telefone'] ?>" required>
            <div class="invalid-feedback">
            </div>
          </div>
        </div>
        
        <div class="mb-3">
          <label for="email">Email <span class="text-muted"></span></label>
          <input type="email" class="form-control" id="email" name="email"  placeholder="you@example.com" value="<?php echo $usuario['email'] ?>">
          <div class="invalid-feedback">
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Endereço</label>
          <input type="text" class="form-control" id="address" name="endereco"  placeholder="1234 Main St" required value="<?php echo $usuario['endereco'] ?>">
          <div class="invalid-feedback">
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Ponto de Referência</label>
          <input type="text" class="form-control" id="address" name="ponto"  placeholder="1234 Main St" required value="<?php echo $usuario['ponto'] ?>">
          <div class="invalid-feedback">
          </div>
        </div><br>

        <div class="form-group">
          <strong><label>Sua região ainda é: <?php echo $local ?></label>?</strong>
          <p>Se não for, atualize em "Meu perfil" clicando aqui: <a class="btn btn-danger btn-sm" href="../client/update-local.php">Atualizar região</a></p>
          <input type="hidden" name="localidade" value="<?php echo $usuario["localidade"] ?>" >
        </div><br>
        
        <hr class="mb-4">
        <div class="container text-center">
        <h4 class="mb-3">Pagamento</h4>
        <div class="wow fadeInDown">

            <fieldset class="radio-image">
              <div class="row">

                <div class="col">
                  <strong>Dinheiro</strong><br>
                  <label for="dinheiro">
                    <input type="radio" name="pagamento" id="dinheiro" value="1" checked required>
                    <img src="https://cdn-icons-png.flaticon.com/512/1570/1570904.png" width="50" alt="Dinheiro">
                  </label>
                </div>

                <div class="col">
                  <strong>Cartão</strong><br>
                  <label for="cartao">
                    <input type="radio" name="pagamento" id="cartao" value="2" required>
                    <img src="https://cdn-icons-png.flaticon.com/512/522/522559.png" width="50" alt="Cartão">
                  </label>
                </div>
                
                <div class="col">
                  <strong>Pix</strong><br>
                  <label for="pix">
                    <input type="radio" name="pagamento" id="pix" value="3" required>
                    <img src="https://logospng.org/download/pix/logo-pix-icone-1024.png" width="50" alt="Pix">
                  </label>
                </div>

              </div>
          </fieldset>
        </div>
        </div><br>
        
        <hr class="mb-4">
        <div class="form-group">
            <strong>Deseja fazer alguma observação?</strong><br><br>
            <textarea class="form-control" name="observacao" id="exampleFormControlTextarea1" placeholder="Ex: Porção mista sem camarão ou presunto. Se precisa de troco. etc." rows="3"></textarea>
        </div><br>
        <button onclick="javascript:return confirm('Deseja realmente finalizar seu pedido?');" class="btn btn-danger btn-lg btn-block" style="color: white;" type="submit">Finalizar Pedido</button><br><br>
        </div><br>

        <style>
          	.radio-image label > input{ 
            visibility: hidden; 
          }

          .radio-image label > input + img{ 
            cursor:pointer;
            border:4px solid #EEE;
            border-radius: 50%;
            padding:10px;
            background: #d8d8d8;

          }
          .radio-image label > input:checked + img{ 
            border:4px solid #e90707;

          }

        </style>

        <a href="./cart.php" style="color: white; text-decoration:none;"><i class="fa fa-arrow-left" aria-hidden="true" style="color: white; font-size:16px; margin-left: 10px;"></i> Voltar ao carrinho</a>

      </div><br>
      </form>
    </div>
  </div><br>

  <?php endforeach;?>


</div>
</div><br>


<?php include "./includes/footer.php"; ?>
