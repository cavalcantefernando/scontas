	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h2 id="titulo">Editar Contrato</h2>
				<hr />
				<?php
					if(isset($_POST['btnAtualizaContrato'])){
						echo $contrato->atualizaContrato($_POST['id_contrato'], $_POST['contrato'], $_POST['contratada'], $_POST['contratante'], $_POST['data_inicial'], $_POST['vencimento'], $_POST['valor'], $_POST['fidelidade'], $_POST['tipo_cobranca'], $_POST['status'], $_POST['observacao']);											
					}
				?>
				<form action="" method="POST">
					<div class="form-group">
						<label>Contrato</label>
						<input type="text" name="contrato" class="form-control" value="<?php echo $contrato->retornaInformacao($_GET['id'], 'contrato'); ?>" required  autofocus/>
						<input type="hidden" name="id_contrato" value="<?php echo $_GET['id']; ?>" />
					</div>
					<div class="form-group">
						<label>Contratada</label>
						<select name="contratada" class="form-control" required>
							<?php
								echo $operadora = $operadora->retornaOperadora2($contrato->retornaInformacao($_GET['id'], 'id_contratada'), 'contrato');
							?>

						</select>
					</div>
					<div class="form-group">
						<label>Contratante (Filial)</label>
						<select name="contratante" class="form-control" required>
							<?php
								echo $filial->retornaFilial($contrato->retornaInformacao($_GET['id'], 'id_contratante'));
							?>
						</select>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Data inicial</label>
								<input type="date" name="data_inicial" class="form-control" value="<?php echo date("Y-m-d", strtotime($contrato->retornaInformacao($_GET['id'], 'data_inicial'))); ?>"  required />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Vencimento</label>
								<select name="vencimento" class="form-control" required>
									<?php echo $acao->retornaDia($contrato->retornaInformacao($_GET['id'], 'vencimento')); ?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Valor</label>
								<input type="text" name="valor" class="form-control" value="<?php echo number_format($contrato->retornaInformacao($_GET['id'], 'valor'), 2); ?>"  required />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Fidelidade</label>
								<select name="fidelidade" class="form-control" required>
									<?php echo $acao->sfidelidade($contrato->retornaInformacao($_GET['id'], 'fidelidade')); ?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Tipo de Cobrança</label>
								<select name="tipo_cobranca" class="form-control" required>
									<?php echo $acao->stipocobrancas($contrato->retornaInformacao($_GET['id'], 'id_tipocobranca'));?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Status</label>
								<select name="status" class="form-control" required>
									<?php echo $acao->sstatus($contrato->retornaInformacao($_GET['id'], 'status')); ?>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Observações</label>
								<textarea class="form-control" name="observacao"><?php echo $contrato->retornaInformacao($_GET['id'], 'observacao'); ?></textarea>
							</div>
						</div>
					</div>
					
					<input type="submit" value="Atualizar" class="btn btn-success" name="btnAtualizaContrato">
				</form>
			</div>
		</div>
	</div>