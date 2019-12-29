	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h2 id="titulo">Editar Identificador</h2>
				<hr />
				<?php
					if(isset($_POST['btnAtualizarIdentificador'])){
						if(!empty(trim($_POST['identificador'])) && !empty(trim($_POST['operadora'])) && !empty(trim($_POST['emissao']))&& !empty(trim($_POST['vencimento'])) && !empty(trim($_POST['filial_cobranca']))&& !empty(trim($_POST['filial_instalacao']))){
							echo $identificador->atualizaIdentificador($_POST['id'], $_POST['identificador'], $_POST['operadora'], $_POST['emissao'], $_POST['vencimento'], $_POST['filial_cobranca'], $_POST['filial_instalacao']);
						}else{
							echo "<div class='alert alert-danger'>Favor preencher todos os campos corretamente!</div>";
						}					
					}
				?>
				<form action="" method="POST">
					<div class="form-group">
						<label>Identificador</label>
						<input type="text" name="identificador" class="form-control"  value="<?php echo $identificador->retornaInformacaoIdentificador($_GET['id'], 'identificador'); ?>"/>
						<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
					</div>
					<div class="form-group">
						<label>Operadora</label>
						<select name="operadora" class="form-control">
							<?php 
								$id = $identificador->retornaInformacaoIdentificador($_GET['id'], 'operadora');
								echo $operadora->retornaOperadora($id); 
							?>
						</select>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Emissão</label>
								<select name="emissao" class="form-control">
									<?php
										$dia = $identificador->retornaInformacaoIdentificador($_GET['id'], 'emissao');
										echo $acao->retornaDia($dia);
									?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Vencimento</label>
								<select name="vencimento" class="form-control">
									<?php
										$dia = $identificador->retornaInformacaoIdentificador($_GET['id'], 'vencimento');
										echo $acao->retornaDia($dia);
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Filial (cobrança)</label>
						<select name="filial_cobranca" class="form-control">
							<?php 
								$id = $identificador->retornaInformacaoIdentificador($_GET['id'], 'filial');
								echo $filial->retornaFilial($id);
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Filial (instalação)</label>
						<select name="filial_instalacao" class="form-control">
							<?php 
								$id = $identificador->retornaInformacaoIdentificador($_GET['id'], 'filial_instalacao');
								echo $filial->retornaFilial($id);
							?>
						</select>
					</div>
					<input type="submit" value="Atualizar" class="btn btn-success" name="btnAtualizarIdentificador">
				</form>
			</div>
		</div>
	</div>