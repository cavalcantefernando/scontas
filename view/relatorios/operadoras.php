	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h2 id="titulo">Relatório de Operadoras</h2>
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
							<th>Operadora</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							if(isset($_GET['pg']))
								echo $operadora->relatorioOperadoras($_GET['pg']);
							else
								echo $operadora->relatorioOperadoras(0);

						?>
			</div>
		</div>
	</div>