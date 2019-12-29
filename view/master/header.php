<!DOCTYPE html>
<html>
<head>
	<title id="title"><?php if(isset($title)) echo $title; else echo "Sem Título"; ?></title>
	
	<link rel="stylesheet" type="text/css" href="lib/jqueryui/jquery-ui.min.css" />
	<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="lib/jqueryui/external/jquery/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.mask.js"></script>
	<script type="text/javascript" src="lib/jqueryui/jquery-ui.min.js"></script>
	<script type="text/javascript" src="lib/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/meu_estilo.css" />
	<script type="text/javascript">
		$(document).ready(function(){
			if(document.getElementById('titulo')){
				document.getElementById('title').innerHTML = document.getElementById('titulo').innerHTML;	
			}else{
				document.getElementById('title').innerHTML = "Dashboard";
			}
			
			$('#acIdentificador').autocomplete({
				source: function (request, response){
					$.ajax({
						url: 'acidentificador.php',
						dataType: 'json',
						data: {
							term: request.term
						},

						success: function(data){
							response($.map(data, function(item){
								return {
									id: item.id_identificador,
									label: item.identificador,
									identificador: item.identificador,
									filial: item.filial,
									operadora: item.operadora,
									vencimento: item.vencimento,
									emissao: item.emissao
								}
							}));
						},
					});					
				},
				minLength: 1,
				select: function(event, ui){
					$("#identificador").val(ui.item.id);
					$("#operadora").val(ui.item.operadora);
					$("#emissao").val(ui.item.emissao);
					$("#vencimento").val(ui.item.vencimento)
					$("#filial").val(ui.item.filial);
				}
			});
			/* CONTRATOS */
			$('#acContrato').autocomplete({
				source: function (request, response){
					$.ajax({
						url: 'accontratos.php',
						dataType: 'json',
						data: {
							term: request.term
						},

						success: function(data){
							response($.map(data, function(item){
								return {
									id: item.id_contrato,
									label: item.contrato,
									contrato: item.contrato,
									contratante: item.filial,
									contratada: item.operadora,
									vencimento: item.vencimento,
								}
							}));
						},
					});					
				},
				minLength: 1,
				select: function(event, ui){
					$("#id_contrato").val(ui.item.id);
					$("#contratada").val(ui.item.contratada);
					$("#vencimento").val(ui.item.vencimento)
					$("#contratante").val(ui.item.contratante);
				}
			});
			
			$('.money').mask('000.000.000.000.000,00', {reverse: true});
		});
	</script>
</head>
<body>
	<div class="container-fluid">
