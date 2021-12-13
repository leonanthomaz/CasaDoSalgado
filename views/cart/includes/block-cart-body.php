<div class="container">
			<div class="card mt-5">
				<div class="card-body">
					<div class="text-center">
						<div class="bloco-carrinho">
						
						<div class="img-carrinho">
						<img src="<?php echo $result['IMG']?>" width="150"/>
						</div>

						<div class="titulo-nome-carrinho">
						<div><strong><b><?php echo $result['name']?></b></strong></div>	
						</div>

						<div class="number-carrinho">
						<div class="number-input">	
						<button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></button>
							<input type="number" min="0"  name="prod[<?php echo $result['id']?>]" value="<?php echo $result['quantity']?>" size="1" />
						<button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
						</div>
						</div>

						<div class="valor-unitario-carrinho">
						<div><b>Valor unitário:</b> R$<?php echo number_format($result['price'], 2, ',', '.')?></div>
						</div>

						<div class="valor-unitario-carrinho">
						<div><b>Subtotal:</b> R$<?php echo number_format($result['subtotal'], 2, ',', '.')?></div>
						</div>

						<div class="btn-group-justified"><br>
						<a href="cart.php?acao=del&id=<?php echo $result['id']?>"><i class="fas fa-trash-alt" style="font-size:20px"></i></a></td>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>