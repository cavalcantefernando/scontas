	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h2 id="titulo">Editar Operadora</h2>
				<hr />
				<?php
					if(isset($_POST['btnAtualizarOperadora'])){
						if(!empty(trim($_POST['operadora']))){
							echo $operadora->atualizaOperadora($_POST['id'], $_POST['operadora']);
						}else{
							echo "<div class='alert alert-danger'>Favor preencher todos os campos corretamente!</div>";
						}					
					}
				?>
				<form action="" method="POST">
					<div class="form-group">
						<label>Operadora</label>
						<input type="text" name="operadora" class="form-control"  value="<?php echo $operadora->retornaInformacaoOperadora($_GET['id'], 'operadora'); ?>"/>
						<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
					</div>
					<input type="submit" value="Atualizar" class="btn btn-success" name="btnAtualizarOperadora">
				</form>
			</div>
		</div>
	</div>