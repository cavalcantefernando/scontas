<?php
	
	$parametro = (isset($_GET['term'])) ? $_GET['term'] : '';

	$parametro = trim(strip_tags($parametro));
	
	require_once("lib/identificador.class.php");
	
	$identificador = new Identificador();
	
	echo $identificador->acIdentificador($parametro);

?>