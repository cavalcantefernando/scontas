	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h2 id="titulo">Cadastro de Contrato</h2>
				<hr />
				<?php
					if(isset($_POST['btnCadastrarContrato'])){
						echo $contrato->cadastraContrato($_POST['contrato'], $_POST['contratada'], $_POST['contratante'], $_POST['data_inicial'], $_POST['vencimento'], $_POST['valor'], $_POST['fidelidade'], $_POST['tipo_cobranca'], $_POST['status'], $_POST['observacao']);											
					}
				?>
				<form action="" method="POST">
					<div class="form-group">
						<label>Contrato</label>
						<input type="text" name="contrato" class="form-control" required  autofocus/>
					</div>
					<div class="form-group">
						<label>Contratada</label>
						<select name="contratada" class="form-control" required>
							<option value=""> ------------- </option>
							<?php
								$operadora = $operadora->retornaOperadoras('contrato');
								while($l = $operadora->fetch(PDO::FETCH_ASSOC)){
									echo "<option value='".$l['id_operadora']."'>".$l['operadora']."</option>";
								}
							?>

						</select>
					</div>
					<div class="form-group">
						<label>Contratante (Filial)</label>
						<select name="contratante" class="form-control" required>
							<option value=""> ------------------ </option>
							<?php
								$rs = $filial->retornaFiliais();
								while($l = $rs->fetch(PDO::FETCH_ASSOC)){
									echo "<option value='".$l['id_filial']."'>".$l['cod_filial']." - ".$l['filial']."</option>";
								}
							?>
						</select>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Data inicial</label>
								<input type="date" name="data_inicial" class="form-control"  required />
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Vencimento</label>
								<select name="vencimento" class="form-control" required>
									<option value=""> ------- </option>
									<?php
										for($i = 1; $i <= 31; $i++){
											echo "<option value='".$i."'>".$i."</option>";
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Valor</label>
								<input type="text" name="valor" class="form-control"  required />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Fidelidade</label>
								<select name="fidelidade" class="form-control" required>
									<option value=""> ------- </option>
									<?php
										for($i = 0; $i <= 10; $i++){
											echo "<option value='".$i."'>".$i." Ano(s)</option>";
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Tipo de Cobrança</label>
								<select name="tipo_cobranca" class="form-control" required>
									<option value=""> ------- </option>
									<?php echo $acao->tipocobrancas();?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Status</label>
								<select name="status" class="form-control" required>
									<option value=""> ------- </option>
									<option value="1"> Ativo </option>
									<option value="0"> Cancelado </option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Observações</label>
								<textarea class="form-control" name="observacao"></textarea>
							</div>
						</div>
					</div>
					
					<input type="submit" value="Cadastrar" class="btn btn-success" name="btnCadastrarContrato">
				</form>
			</div>
		</div>
	</div>