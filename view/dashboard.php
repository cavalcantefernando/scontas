	<div class="container-fluid">
		<div class="row">
			<form id="myForm" method="POST">
				<div class="col-md-6">
					<?php
						if(isset($_GET['mes']) && isset($_GET['ano'])){
					  		$mes = trim($_GET['mes']); 
							$ano = trim($_GET['ano']);
						} else {
							$data = date('m/Y'); 
					  		$din = explode("/", $data);
							$mes = $din[0];
							$ano = $din[1];
						}
					?>
					<h2 style="float: left;">Contratos Pendentes - <?php echo $acao->retornaMes($mes); ?> / <?php echo $ano; ?></h2>					
					<!-- ############################################# -->
					<!-- ############################################# -->
					<div class="tabela-dashboard">
						<table class="table tabela-dashboard">
							<thead>
								<tr>
									<th>#</th>
									<th>Identificador</th>
									<th>Operadora</th>
									<th>Vencimento</th>
									<th>Filial</th>
								</tr>
							</thead>
							<tbody>
								<?php echo $acao->retornaContratosPendentes($mes, $ano);?>
							</tbody>
						</table>
					</div>
					<hr style="clear: both !important;" />
					<nav aria-label="...">
					  <ul class="pager">					  	
					  		<?php echo $acao->paginacaoContasPendentes($mes, $ano);?>
						  </ul>
					</nav>
				</div>
				<div class="col-md-6">
					<h2 style="float: left;">Contas Pendentes - <?php echo $acao->retornaMes($mes); ?> / <?php echo $ano; ?></h2>					
					<!-- ############################################# -->
					<!-- ############################################# -->
					<div class="tabela-dashboard">
						<table class="table tabela-dashboard">
							<thead>
								<tr>
									<th>#</th>
									<th>Identificador</th>
									<th>Operadora</th>
									<th>Vencimento</th>
									<th>Filial</th>
								</tr>
							</thead>
							<tbody>
								<?php echo $acao->retornaContasPendentes($mes, $ano);?>
							</tbody>
						</table>
					</div>
					<hr style="clear: both !important;" />
					<nav aria-label="...">
					  <ul class="pager">					  	
					  		<?php echo $acao->paginacaoContasPendentes($mes, $ano);?>
						  </ul>
					</nav>
				</div>
			</form>
		</div>
	</div>