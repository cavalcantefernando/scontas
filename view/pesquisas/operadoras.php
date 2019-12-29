	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h2 id="titulo">Pesquisa de Operadoras</h2>
				<hr />			
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<form method="POST">
							<div class="form-group">
								<input name="operadora" placeholder="Operadora" class="form-control"/>
							</div>
						</form>
					</div>
				</div>
				<hr />
			</div>
		</div>		
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<table class="table table-stripped tabela-dashboard">
					<thead>
						<tr>
							<th>#</th>							
							<th>Operadora</th>
						</tr>
					</thead>
					<tbody>
						<?php if(isset($_POST['operadora'])) echo $operadora->pesquisaOperadoras( $_POST['operadora']);?>
					</tbody>
			</div>
		</div>
		
	</div>