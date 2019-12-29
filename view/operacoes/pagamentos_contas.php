	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h2 id="titulo">Pagamento de Conta</h2>
				<hr />
				<?php
					if(isset($_POST['btnOperacaoPagamento'])){
						if(!empty($_POST['identificador']) && !empty($_POST['valorContratado']) && !empty($_POST['mes']) && !empty($_POST['ano'])){
							echo $pagamento->pagContas($_POST['identificador'], $_POST['mes'], $_POST['ano'], $_POST['valorContratado'], $_POST['valorExcedente']);
						}else{
							echo "<div class='alert alert-danger'>Preencha todos os campos corretamente!</div>";
						}
					}
				?>
				<form action="" method="POST">
					<div class="form-group">
						<label>Contrato</label>
						<input type="hidden" name="identificador" id="identificador" name="identificador">
						<input type="text" id="acIdentificador" class="form-control"  autofocus/>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label>Operadora</label>
								<input type="text" class="form-control" id="operadora" disabled />
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Emissao</label>
								<input type="text" class="form-control" id="emissao" disabled />
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Vencimento</label>
								<input type="text" class="form-control" id="vencimento" disabled />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Filial</label>
								<input type="text" class="form-control" id="filial" disabled />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Mês</label>
								<select name="mes" class="form-control">
									<option value=""> ---- </option>
									<?php
										$mes = 12;
										for($i = 1; $i <= $mes; $i++){
											echo "<option value='".$i."'>".$i." - ".$acao->retornaMes($i)."</option>";
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Ano</label>
								<select name="ano" class="form-control">
									<option value=""> ----- </option>
									<?php
										$ano = date('Y');
										for($i = $ano - 2; $i <= $ano + 2; $i++){
											echo "<option value='".$i."'>".$i."</option>";
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Valor Contratado</label>
								<input type="text" name="valorContratado" class="form-control money" />
							</div>
						</div>
						<div class="col-md-3">
							<label>Excedente</label>
							<input type="text" name="valorExcedente" class="form-control money" />
						</div>
					</div>
					<input type="submit" value="Cadastrar" class="btn btn-success" name="btnOperacaoPagamento" />
				</form>
			</div>
		</div>
	</div>