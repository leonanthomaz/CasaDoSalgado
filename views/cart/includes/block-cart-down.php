    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <div class="box-form">
                    <div class="text-center">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="card-checkout"><b><i class="fa fa-cart-plus" aria-hidden="true"></i> Finalizar Carrinho</b></h2><br>
                        <span class="badge badge-secondary badge-pill"></span>
                    </h4>
                    </div>
                    <div class="box-gotocheckout">
                        <ul class="list-group mb-3">
                        <div class="checkout">
                        <div class="text-center"><br>
                            <small class="text-muted">
                            <?php 
                            if($totalCarts){
                                echo "$checkout";
                            }else{
                                echo "$carrinhoVazio";
                            }
                            ?>
                            </small>
                        </div><br>
                        </div>
                        <div class="text-center">
                        <?php
                            if($totalCarts >= 12):?>
                                <a onclick="javascript:return confirm('Certo. Agora confirme seus dados para finalizar seu pedido. Deseja prosseguir?');" class="btn btn-danger" id="enviar" name="enviar" href="./checkout.php">Finalizar Carrinho</a>

                            <?php endif;?> 
                            <?php if($totalCarts <= 12):?>
                                <script>alert('Apenas aceitamos compras acima de R$12,00!')</script>
                        <?php endif;?><br><br>
                        <a class="btn btn-info btn-sm" href="../../views/pages/dashboard.php">Continuar Comprando</a><br><br>
                        </div>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>