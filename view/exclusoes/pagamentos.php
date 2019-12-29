	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<center>
					<h2 id="titulo">Excluir Pagamento</h2>
				</center>
				<hr />
				<?php
					if(isset($_POST['btnConfirmaExclusao'])){
						if(!empty($_POST['id_pagamento'])){
							echo $funcao->excluirPagamento($_POST['id_pagamento']);
							$i = true;
							echo '<a href="index.php?page=pesquisaPagamento" class="btn btn-success btn-block"> Voltar </a>';
						}else{
							echo "<div class='alert alert-danger'>Erro ao tentar excluir!</div>";
						}
					}elseif(isset($_POST['btnRetorna'])){
						echo '<meta http-equiv="refresh" content="0; index.php?page=pesquisaPagamento">';
					}
					if(isset($i) && $i == true){
						die();
					}
				?>
				<form method="POST">
					<div class="row">
						<div class="col-md-12">
							<h1>Deseja excluir o Pagamento de nº 
									<?php echo $_GET['id']; ?> 
								no valor de R$ 
									<?php 
										$val1 = $funcao->retornaInformacaoPagamento($_GET['id'], 'valor_contratado'); 
										$val2 = $funcao->retornaInformacaoPagamento($_GET['id'], 'valor_excedente'); 
										echo number_format($val1, 2) + number_format($val2, 2); 
									?> 
								? 
							</h1>
						</div>
					</div>
					<br /><br /><br />
					<div class="row">
						<div class="col-md-6">
							<input type="hidden" name="id_pagamento" value="<?php echo $_GET['id']; ?>" />
							<input type="submit" value="Sim" class="btn btn-danger btn-block" name="btnConfirmaExclusao" />
						</div>
						<div class="col-md-6">
							<input type="submit" value="Não" class="btn btn-default btn-block" name="btnRetorna" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>