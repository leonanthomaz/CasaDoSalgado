	<!-- Bloco Corpo do carrinho -->
	<div class="container">
		<div class="card mt-5">
			<div class="card-body">
					<div class="text-center">
					<h4 class="d-flex justify-content-between align-items-center mb-3">
					<h2 class="card-checkout"><b><i class="fa fa-shopping-cart" style="font-size:32px;color:black"></i> Carrinho</b></h2><br>
					</h4>
					</div>
					<div class="text-center">	
					<div class="img-cart-logo">
					<?php
						if($totalCarts == ""){
							echo "<div class=''>
							<h5 style='color: red'>Seu carrinho está vazio!</h4><h5>
							</div><br>";
						}
					?>
					<a href="../pages/dashboard.php" class="btn btn-info">Voltar ao início</a>
					</div>
				</div>
		</div>
		</div>
	</div>