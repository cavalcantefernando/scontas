	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h2 id="titulo">Pesquisa de Identificadores</h2>
				<hr />			
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<form method="POST">
							<div class="form-group">
								<input name="identificador" placeholder="Identificador" class="form-control"/>
							</div>
						</form>
					</div>
				</div>
				<hr />
			</div>
		</div>		
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<table class="table table-stripped tabela-dashboard">
					<thead>
						<tr>
							<th>#</th>
							<th>Identificador</th>							
							<th>Operadora</th>
							<th>Emissão</th>
							<th>Vencimento</th>
							<th>Filial (cobrança)</th>
							<th>Filial (instalação)</th>
						</tr>
					</thead>
					<tbody>
						<?php if(isset($_POST['identificador'])) echo $identificador->pesquisaIdentificadores( $_POST['identificador'] );?>
					</tbody>
			</div>
		</div>
		
	</div>