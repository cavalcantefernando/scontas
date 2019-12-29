	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h2 id="titulo">Relatório de Pagamentos de Contratos</h2>
				<hr />
				<?php
					if(isset($_GET['act']) && $_GET['act'] == "exportar"){
						$funcao->exportaExcelPagamentos();
					}
				?>				
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
							<th>Contratada</th>
							<th>Mês</th>
							<th>Ano</th>
							<th>Valor</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							if(isset($_GET['pg']))
								echo $pagamento->relatorioPagContratos($_GET['pg']);
							else
								echo $pagamento->relatorioPagContratos(0);

						?>
			</div>
		</div>
	</div>