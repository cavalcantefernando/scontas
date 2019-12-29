	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<h2 id="titulo">Meus dados</h2>
				<hr />
				<?php
					if(isset($_POST['btnAtualizaUsuario'])){
						if(!empty($_POST['senha']) && !empty($_POST['confirma_senha']) && $_POST['senha'] == $_POST['confirma_senha']){
							echo $usuario->atualizaUsuario($_POST['id'], $_POST['senha']);
						}else{
							echo "<div class='alert alert-danger'>As senhas não podem ser diferentes!</div>";
						}
					}
				?>
				<form action="" method="POST">
					<div class="form-group">
						<label>Usuário</label>
						<input type="hidden" name="id" value="<?php echo $_SESSION['s_contas_id_usuario']; ?>">
						<input type="text" id="usuario" name="usuario" class="form-control"  value="<?php echo $usuario->retornaInformacaoUsuario($_SESSION['s_contas_id_usuario'], 'usuario'); ?>"/>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Senha</label>
								<input type="password" class="form-control" name="senha" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Confirma Senha</label>
								<input type="password" class="form-control" name="confirma_senha" />
							</div>
						</div>
					</div>
					<input type="submit" value="Atualizar" class="btn btn-success" name="btnAtualizaUsuario" />
				</form>
			</div>
		</div>
	</div>