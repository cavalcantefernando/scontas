<?php
	date_default_timezone_set("Brazil/East");
	$erro = true;
	if($erro == true){
		ini_set('display_errors', 1);
		ini_set('display_errors', 1);
		ini_set('log_errors', 1);
		ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
		error_reporting(E_ALL);
	}
	
	@session_start(); 
	require_once("lib/acao.class.php");
	require_once("lib/usuario.class.php");
	require_once("lib/identificador.class.php");
	require_once("lib/operadora.class.php");
	require_once("lib/filial.class.php");
	require_once("lib/pagamento.class.php");
	require_once("lib/contrato.class.php");
	$acao = new Acao();
	$usuario = new Usuario();
	$identificador = new Identificador();
	$operadora = new Operadora();
	$filial = new Filial();
	$pagamento = new Pagamento();
	$contrato = new Contrato();
	
	$dir = "view/";
	
	include $dir."master/header.php";
	
	if(!isset($_SESSION['s_contas_id_usuario'])){		
	
		include $dir."login.php";
	
	}else{
			
		include $dir."master/nav.php";
		if(isset($_GET['page']))
			$page = $_GET['page'];
		else 
			$page = '';
		
		@include $acao->start($page, $dir);
		
	}
	
	include $dir."master/footer.php";
?>