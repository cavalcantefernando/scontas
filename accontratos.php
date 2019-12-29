<?php
	
	$parametro = (isset($_GET['term'])) ? $_GET['term'] : '';

	$parametro = trim(strip_tags($parametro));
	
	require_once("lib/contrato.class.php");
	
	$contrato = new Contrato();
	
	echo $contrato->acContrato($parametro);

?>