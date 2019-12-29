	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h2 id="titulo">Cadastro de Operadora</h2>
				<hr />
				<?php
					if(isset($_POST['btnCadastrarOperadora'])){
						if(!empty(trim($_POST['operadora'])) && !empty($_POST['tipo'])){
							echo $operadora->cadastraOperadora($_POST['operadora'], $_POST['tipo']);
						}else{
							echo "<div class='alert alert-danger'>Favor preencher o campo corretamente</div>";
						}						
					}
				?>
				<form method="POST">
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label>Operadora</label>
								<input type="text" name="operadora" class="form-control" required  autofocus/>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Tipo</label>
								<select name="tipo" class="form-control" required>
									<option value=""> -------- </option>
									<option value="1"> Telefonia </option>
									<option value="2"> Contrato </option>
								</select>
							</div>
						</div>
					</div>
					<input type="submit" value="Cadastrar" class="btn btn-success" name="btnCadastrarOperadora">
				</form>
			</div>
		</div>
	</div>