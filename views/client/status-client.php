<?php
                        
                        if($orderStatus == 0){
                            echo '<div class="step active"> <span class="icon"><div class="wow fadeInDown"> <i class="fa fa-check"></i> </div> </span> <span class="text">Pedido Realizado</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text">Pedido Confirmado</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text"> Pedido em Preparo</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Saiu para entrega </span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-gift" aria-hidden="true"></i> </span> <span class="text">Pedido Entregue</span> </div>';
                            }
                            else if($orderStatus == 1){
                                echo '<div class="step active"> <span class="icon"><div class="wow fadeInDown"> <i class="fa fa-check"></i> </div> </span> <span class="text">Pedido Realizado</span> </div>
                                        <div class="step active"> <span class="icon"><div class="wow fadeInDown"> <i class="fa fa-check"></i> </div> </span> <span class="text">Pedido Confirmado</span> </div>
                                        <div class="step"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text"> Pedido em Preparo</span> </div>
                                        <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Saiu para entrega </span> </div>
                                        <div class="step"> <span class="icon"> <i class="fa fa-gift" aria-hidden="true"></i> </span> <span class="text">Pedido Entregue</span> </div>';
                            }
                            else if($orderStatus == 2){
                                echo '<div class="step active"> <span class="icon"> <div class="wow fadeInDown"> <i class="fa fa-check"></i> </div> </span> <span class="text">Pedido Realizado</span> </div>
                                        <div class="step active"> <span class="icon"> <div class="wow fadeInDown"> <i class="fa fa-check"></i> </div> </span> <span class="text">Pedido Confirmado</span> </div>
                                        <div class="step active"> <span class="icon"> <div class="wow fadeInDown"> <i class="fa fa-check"></i> </div> </span> <span class="text"> Pedido em Preparo</span> </div>
                                        <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Saiu para entrega </span> </div>
                                        <div class="step"> <span class="icon"> <i class="fa fa-gift" aria-hidden="true"></i> </span> <span class="text">Pedido Entregue</span> </div>';
                            }
                            else if($orderStatus == 3){
                                echo '<div class="step active"> <span class="icon"> <div class="wow fadeInDown"> <i class="fa fa-check"></i> </div>  </span> <span class="text">Pedido Realizado</span> </div>
                                        <div class="step active"> <span class="icon"> <div class="wow fadeInDown"> <i class="fa fa-check"></i> </div>  </span> <span class="text">Pedido Confirmado</span> </div>
                                        <div class="step active"> <span class="icon"> <div class="wow fadeInDown"> <i class="fa fa-check"></i> </div>  </span> <span class="text"> Pedido em Preparo</span> </div>
                                        <div class="step active"> <span class="icon"> <div class="wow fadeInDown"> <i class="fa fa-truck"></i> </div>  </span> <span class="text"> Saiu para entrega </span> </div>
                                        <div class="step"> <span class="icon"> <i class="fa fa-gift" aria-hidden="true"></i> </span> <span class="text">Pedido Entregue</span> </div>';
                            }
                            else if($orderStatus == 4){
                                echo '<div class="step active"> <span class="icon">  <div class="wow fadeInDown"> <i class="fa fa-check"></i> </div> </span> <span class="text">Pedido Realizado</span> </div>
                                        <div class="step active"> <span class="icon">  <div class="wow fadeInDown"> <i class="fa fa-check"></i> </div> </span> <span class="text">Pedido Confirmado</span> </div>
                                        <div class="step active"> <span class="icon">  <div class="wow fadeInDown"> <i class="fa fa-check"></i> </div> </span> <span class="text"> Pedido em Preparo</span> </div>
                                        <div class="step active"> <span class="icon">  <div class="wow fadeInDown"> <i class="fa fa-truck"></i> </div> </span> <span class="text"> Saiu para entrega </span> </div>
                                        <div class="step active"> <span class="icon">  <div class="wow fadeInDown"> <i class="fa fa-gift" aria-hidden="true"></i> </div> </span> <span class="text">Pedido Entregue</span> </div>';
                            } 
                            else if($orderStatus == 5){
                            echo '<div class="step active"> <span class="icon"> <div class="wow fadeInDown"> <i class="fa fa-check"></i> </div> </span> <span class="text">Pedido Realizado</span> </div>
                            <div class="step deactive"> <span class="icon"> <div class="wow pulse"> <i class="fa fa-times"></i> </div> </span> <span class="text">Pedido Cancelado</span> </div>';
                            }
                            else {
                                echo '<div class="step deactive"> <span class="icon"> <i class="fa fa-times"></i> </span> <span class="text">Pedido Cancelado</span> </div>';
                            }

                        ?>