	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h2 id="titulo">Relatório de Identificadores</h2>
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
							<th>Operadora</th>
							<th>Emissao</th>
							<th>Vencimento</th>
							<th>Filial - Cobrança</th>
							<th>Filial - Instalação</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							if(isset($_GET['pg']))
								echo $identificador->relatorioIdentificadores($_GET['pg']);
							else
								echo $identificador->relatorioIdentificadores(0);

						?>
			</div>
		</div>
	</div>