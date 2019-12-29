	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h2 id="titulo">Editar Pagamento</h2>
				<hr />
				<?php
					if(isset($_POST['btnAtualizarPagamento'])){
						if(!empty($_POST['id_pagamento']) && !empty($_POST['valorContratado']) && !empty($_POST['mes']) && !empty($_POST['ano'])){
							echo $pagamento->atualizaPagamento($_POST['id_pagamento'], $_POST['mes'], $_POST['ano'], $_POST['valorContratado'], $_POST['valorExcedente']);
						}else{
							echo "<div class='alert alert-danger'>Preencha todos os campos corretamente!</div>";
						}
					}
				?>
				<form method="POST">
					<div class="form-group">
						<label>Identificador</label>
						<input type="hidden" name="id_pagamento" value="<?php echo $_GET['id']; ?>" />
						<input type="text" name="identificador" class="form-control" value="<?php echo $identificador->retornaInformacaoIdentificador($pagamento->retornaInformacaoPagamento($_GET['id'], 'identificador'), 'identificador'); ?>"  disabled/>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label>Operadora</label>
								<input type="text" class="form-control" id="operadora"  value="<?php echo $operadora->retornaInformacaoOperadora($identificador->retornaInformacaoIdentificador($pagamento->retornaInformacaoPagamento($_GET['id'], 'identificador'), 'operadora'), 'operadora'); ?>" disabled />
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Emissao</label>
								<input type="text" class="form-control" id="emissao"  value="<?php echo $identificador->retornaInformacaoIdentificador($pagamento->retornaInformacaoPagamento($_GET['id'], 'identificador'), 'emissao'); ?>" disabled />
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Vencimento</label>
								<input type="text" class="form-control" id="vencimento"  value="<?php echo $identificador->retornaInformacaoIdentificador($pagamento->retornaInformacaoPagamento($_GET['id'], 'identificador'), 'vencimento'); ?>" disabled />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Filial</label>
								<input type="text" class="form-control" id="filial"  value="<?php echo $filial->retornaInformacaoFilial($identificador->retornaInformacaoIdentificador($pagamento->retornaInformacaoPagamento($_GET['id'], 'identificador'), 'filial'), 'filial'); ?>" disabled />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Mês</label>
								<select name="mes" class="form-control">
									<?php
										echo $acao->retMes($pagamento->retornaInformacaoPagamento($_GET['id'], 'mes'));
									?>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Ano</label>
								<select name="ano" class="form-control">
									<?php
										echo $acao->retAno($pagamento->retornaInformacaoPagamento($_GET['id'], 'ano'));
									?>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Valor Contratado</label>
								<input type="text" name="valorContratado" value="<?php echo number_format($pagamento->retornaInformacaoPagamento($_GET['id'], 'valor_contratado'), 2); ?>" class="form-control" />
							</div>
						</div>
						<div class="col-md-3">
							<label>Excedente</label>
							<input type="text" name="valorExcedente" value="<?php echo number_format($pagamento->retornaInformacaoPagamento($_GET['id'], 'valor_excedente'), 2); ?>" class="form-control" />
						</div>
					</div>
					<input type="submit" value="Atualizar" class="btn btn-success" name="btnAtualizarPagamento" />
				</form>
			</div>
		</div>
	</div>