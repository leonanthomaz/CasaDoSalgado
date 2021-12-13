<?php
session_start();
include_once "../config/config.php";
?>

<?php include("./includes/header.php"); ?>

<br><div class="wow fadeInDown">
        <div class="img-card">
            <a href="#">
                <img src="../views/img/logo.png"/> 
            </a> 
        </div>
    </div><br><br>
    <div class="titulo"><h2 style="color: white;">Encomendas</h2></div><br>

    <div class="bloco-body-encomendas"><br>
        

        <?php
        if(isset($_SESSION['sucessoEncomenda'])):
        ?>
        <div class="bloco-box"><br>
        <div class="notification is-danger">
        <?php
        echo $_SESSION['sucessoEncomenda'] = '<div class="text-center"><strong style="color: green"> Encomenda solicitada com sucesso!</strong></div><br>';
        ?>
        </div>
        </div>
        <?php
        endif;
        unset($_SESSION['sucessoEncomenda']);
        // Destrua a sessão.
        //session_destroy();
        ?>

        <div class="">
        <form method="POST" action="./send-encomenda.php">

                <div class="form-group">
                    <input type="hidden" name="cliente" class="form-control" value="<?php if(isset($_SESSION["username"])) echo $_SESSION["username"] ?>">
                    <input type="hidden" name="id_cliente" class="form-control" value="<?php if(isset($_SESSION["id"])) echo $_SESSION["id"] ?>">                
                </div><br>

                <div class="form-group">
                    <strong>Opções</strong><br>
                    <div class="text-center">
                    <select name="opcao" class="form-control" value="">
                        <option value=0>Selecione a quantidade</option>
                        <option value=1>300 salgadinhos (R$300,00)</option>
                        <option value=2>500 salgadinhos (R$500,00)</option>
                        <option value=3>1000 salgadinhos (R$1000,00)</option>
                    </select>
                    </div>     
                </div><br>
            
                <div class="form-group">
                    <strong>Selecione a Data:</strong><br>
                    <input type="date" name="data_escolhida" class="form-control" value="">
                </div><br> 

                <div class="form-group">
                <div class="text-center">
                    <strong>Sabores disponíveis:</strong><br><br>
                    <div class="text-center">
                    <strong>Coxinha</strong>
                    <input type="checkbox" name="sabor[]" value=Coxinha>
                    <strong>Risole</strong>
                    <input type="checkbox" name="sabor[]" value=Risole>
                    <strong>Enroladinho</strong>
                    <input type="checkbox" name="sabor[]" value=Enroladinho>
                    <strong>Kibe</strong>
                    <input type="checkbox" name="sabor[]" value=Kibe>
                    </div>  
                </div>   
                </div><br>

                <div class="form-group">
                    <strong>Deseja fazer alguma observação?</strong><br><br>
                    <textarea class="form-control" name="observacao" id="exampleFormControlTextarea1" placeholder="Ex: Porção mista sem camarão ou presunto. Se precisa de troco. etc." rows="3"></textarea>
                </div><br>

                <input type='hidden' name='ativo' value='1'><br>

                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <img src="../views/img/logo.png" style="width: 90px; margin-top:20px"/> 
                            <h4 style="color: black;" class="modal-title text-center" id="myModalLabel"> Condições de Encomenda</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <ul>
                                    <li style="color: black;">
                                    Ao realizar o pedido, o pagamento de 50% do valor deverá ser efetuado em 48h, caso contrário, seu pedido será cancelado.
                                    </li >
                                    <li style="color: black;">
                                    Após a solicitação, entraremos em contato para combinar a melhor forma do pagamento do sinal.
                                    </li>
                                    <li style="color: black;">
                                    Você poderá cancelar seu pedido em até 48h horas após a confirmação do pagamento.
                                    </li>
                                    <li style="color: black;">
                                    O pagamento do sinal poderá ser feito apenas via Pix, em dinheiro ou em cartão de débito.
                                    </li>
                                    <li style="color: black;">
                                    Caso não haja o pagamento do sinal, seu pedido será automaticamente cancelado.
                                    </li>
                                    <li style="color: black;">
                                    Atenderemos as solicitações de encomendas até 23 de dezembro para o Natal.
                                    </li>
                                    <li style="color: black;">
                                    Para as festas de Réveillon aceitaremos pedidos somente até o dia 29/12 do ano vigente.
                                    </li>
                                </ul>
                            
                            </div>				  
                        </div>
                    </div>
                </div>

                <hr class="mb-4">
                <div class="container text-center">
                <strong>Forma de Pagamento</strong><br><br>
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

                 <!-- Button trigger modal -->
                 <a data-toggle="modal" data-target="#myModal">
                    <button>Leia os termos</button>
                </a>

                <div class="form-group">
                    <div class="form-check">
                    <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3" required>
                    <label class="form-check-label" for="invalidCheck3">
                        Concordo com os termos
                    </label>
                    <div class="invalid-feedback">
                        Aceite as condições antes de prosseguir
                    </div>
                    </div>
                </div>
                <button class="enviar-encomenda" id="submit" type="submit">Finalizar Encomenda</button>

                <?php
                

                ?>

            </form>
        </div><br>
    </div>



<?php include("./includes/footer.php"); ?>
