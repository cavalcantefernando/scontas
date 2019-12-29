<?php
	date_default_timezone_set("Brazil/East");
	if($erro === true){
		ini_set('display_errors', 1);
		ini_set('display_errors', 1);
		ini_set('log_errors', 1);
		ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
		error_reporting(E_ALL);
	}
	@session_start(); 
	require_once("config/conn.class.php"); 
	$funcao = new Conn();
	include "layouts/header.layout.php";
	if(!isset($_SESSION['s_contas_id_usuario']) && !isset($_SESSION['sv_sys'])){		
		include "layouts/login.layout.php";
	}else{
		if($_SESSION['sv_sys'] == md5('SysContas')){
			include "layouts/nav.layout.php";
			$dir = "layouts/";
				$tipo = ".layout.php";
				if(isset($_GET['page'])){
					switch ($_GET['page']) {
					
						/* cadastro */
						case 'cadastroOperadora':
								include $dir."cadastroOperadora".$tipo;
							break;
						case 'cadastroIdentificador':
								include $dir."cadastroIdentificador".$tipo;
							break;
						case 'cadastroUsuario':
								if($_SESSION['s_contas_permissao'] === '1'){
									include $dir."cadastroUsuario".$tipo;
								}else{
									include $dir."dashboard".$tipo;
								}
							break;
					
						/* pesquisa */
						case 'pesquisaIdentificador':
							include $dir."pesquisaIdentificador".$tipo;
							break;
						case 'pesquisaOperadora':
							include $dir."pesquisaOperadora".$tipo;
							break;
						case 'pesquisaPagamento':
							include $dir."pesquisaPagamento".$tipo;
							break;
							
						/* edicao */
						case 'editaIdentificador':
							include $dir."editaIdentificador".$tipo;
							break;
						case 'editaOperadora':
							include $dir."editaOperadora".$tipo;
							break;
						case 'editaPagamento':
							include $dir."editaPagamento".$tipo;
							break;
						
						/* excluir */
						case 'excluirPagamento':
							include $dir."excluirPagamento".$tipo;
							break;
							
						/* operacao */
						case 'operacaoPagamento':
								include $dir."operacaoPagamento".$tipo;
							break;
							
						/* relatorio */
						
						case 'relatorioOperadoras':	
								if($_SESSION['s_contas_permissao'] === '1'){
									include $dir."relatorioOperadoras".$tipo;
								}else{
									include $dir."dashboard".$tipo;
								}
							break;
						case 'relatorioIdentificadores':
								if($_SESSION['s_contas_permissao'] === '1'){	
									include $dir."relatorioIdentificadores".$tipo;
								}else{
									include $dir."dashboard".$tipo;
								}
							break;
						case 'relatorioPagamentos':
								if($_SESSION['s_contas_permissao'] === '1'){	
									include $dir."relatorioPagamentos".$tipo;
								}else{
									include $dir."dashboard".$tipo;
								}
							break;
						
						/* usuario */
						case 'meusdados':
								include $dir."meusdados".$tipo;
							break;
							
						/* funcao */
						case 'logout':
							$funcao->logout();
							break;
						
					}
				}else{
					include $dir."dashboard".$tipo;
				}
		}
	}
	
	include "layouts/footer.layout.php";
?>