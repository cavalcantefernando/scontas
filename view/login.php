<div class="row">
	<div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4 login">
		<center>
			<br />
			<img src="img/logo_port.gif" />
			<br />
			<h3> Sistema de Controle de Contas</h3>
		</center>
		<hr />
		<?php
			if(isset($_POST['btnLogin'])){
				if(!empty($_POST['usuario']) && !empty($_POST['senha'])){
					echo $usuario->login($_POST['usuario'], $_POST['senha']);
				}else{
					echo "<div class='alert alert-danger'>Os campos devem ser preenchidos!</div>";
				}
			}
		?>
		<form method="POST">				
			<div class="form-group">
				<label>Usu&aacute;rio</label>
				<input type="text" class="form-control" name="usuario" />
			</div>
			<div class="form-group">
				<label>Senha</label>
				<input type="password" class="form-control" name="senha" />
			</div>
			<input type="submit" value="Entrar" class="btn btn-success btn-block" name="btnLogin">
		</form>
	</div>
</div>