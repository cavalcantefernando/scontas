	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h2 id="titulo">Cadastro de Usuário</h2>
				<hr />
				<?php
					if(isset($_POST['btnCadastrarUsuario'])){
						echo $usuario->cadastraUsuario($_POST['usuario'], $_POST['senha'], $_POST['conf_senha'], $_POST['permissao']);										
					}
				?>
				<form action="" method="POST">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Usuário</label>
								<input type="text" name="usuario" class="form-control"  autofocus/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Permissão</label>
								<select name="permissao" class="form-control">
									<option value=""> ------------ </option>
									<option value="1">Administrador</option>
									<option value="2">Operacional</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Senha</label>
								<input type="password" name="senha" class="form-control" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Confirmar Senha</label>
								<input type="password" name="conf_senha" class="form-control" />
							</div>
						</div>
					</div>
					<input type="submit" value="Cadastrar" class="btn btn-success" name="btnCadastrarUsuario">
				</form>
			</div>
		</div>
	</div>