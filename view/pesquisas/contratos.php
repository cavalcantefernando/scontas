	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h2 id="titulo">Pesquisa de Contratos</h2>
				<hr />			
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<form method="POST">
							<div class="form-group">
								<input name="contrato" placeholder="Contrato" class="form-control"/>
							</div>
						</form>
					</div>
				</div>
				<hr />
			</div>
		</div>		
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<table class="table table-stripped">
					<thead>
						<tr>
							<th>#</th>
							<th>Contrato</th>							
							<th>Contratada</th>
							<th>Contratante</th>
							<th>Vencimento</th>
							<th>Valor</th>
							<th>Tipo de Cobrança</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php if(isset($_POST['contrato'])) echo $contrato->pesquisaContratos( $_POST['contrato'] );?>
					</tbody>
			</div>
		</div>
		
	</div>