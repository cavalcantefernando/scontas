	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h2 id="titulo">Cadastro de Identificador</h2>
				<hr />
				<?php
					if(isset($_POST['btnCadastrarIdentificador'])){
						if(!empty(trim($_POST['identificador'])) && !empty(trim($_POST['operadora'])) && !empty(trim($_POST['emissao']))&& !empty(trim($_POST['vencimento'])) && !empty(trim($_POST['filial']))){
							echo $identificador->cadastraIdentificador($_POST['identificador'], $_POST['operadora'], $_POST['emissao'], $_POST['vencimento'], $_POST['filial'], $_POST['filial_instalacao']);
						}else{
							echo "<div class='alert alert-danger'>Favor preencher todos os campos corretamente!</div>";
						}					
					}
				?>
				<form action="" method="POST">
					<div class="form-group">
						<label>Identificador</label>
						<input type="text" name="identificador" class="form-control" required autofocus/>
					</div>
					<div class="form-group">
						<label>Operadora</label>
						<select name="operadora" class="form-control" required>
							<option value=""> ------------- </option>
							<?php
								$operadora = $operadora->retornaOperadoras('telefone');
								while($l = $operadora->fetch(PDO::FETCH_ASSOC)){
									echo "<option value='".$l['id_operadora']."'>".$l['operadora']."</option>";
								}
							?>

						</select>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Emissão</label>
								<select name="emissao" class="form-control" required>
									<option value=""> ------- </option>
									<?php
										for($i = 1; $i <= 31; $i++){
											echo "<option value='".$i."'>".$i."</option>";
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
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
					</div>
					<div class="form-group">
						<label>Filial (cobrança)</label>
						<select name="filial" class="form-control" required>
							<option value=""> ------------------ </option>
							<?php
								$rs = $filial->retornaFiliais();
								while($l = $rs->fetch(PDO::FETCH_ASSOC)){
									echo "<option value='".$l['id_filial']."'>".$l['cod_filial']." - ".$l['filial']."</option>";
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Filial (instalação)</label>
						<select name="filial_instalacao" class="form-control" required>
							<option value=""> ------------------ </option>
							<?php
								$rs = $filial->retornaFiliais();
								while($l = $rs->fetch(PDO::FETCH_ASSOC)){
									echo "<option value='".$l['id_filial']."'>".$l['cod_filial']." - ".$l['filial']."</option>";
								}
							?>
						</select>
					</div>
					<input type="submit" value="Cadastrar" class="btn btn-success" name="btnCadastrarIdentificador">
				</form>
			</div>
		</div>
	</div>