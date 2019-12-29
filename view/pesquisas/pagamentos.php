	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h2 id="titulo">Pesquisa de Pagamentos</h2>
				<hr />			
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="row">
					<div class="col-md-12">
						<form method="post">
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
				<table class="table table-stripped">
					<thead>
						<tr>
							<th>#</th>
							<th>Identificador</th>
							<th>Filial</th>
							<th>Operadora</th>
							<th>Mês</th>
							<th>Ano</th>
							<th>Valor</th>
						</tr>
					</thead>
					<tbody>
						<?php if(isset($_POST['identificador'])) echo $pagamento->pesquisaPagamentos($_POST['identificador'] , $_SESSION['s_contas_permissao']); ?>
			</div>
		</div>
		
	</div>