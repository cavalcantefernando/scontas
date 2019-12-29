	<nav class="navbar navbar-default">
		<div class="container-fluid">
    	<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				    <span class="sr-only">Toggle navigation</span>
			   		<span class="icon-bar"></span>
			    	<span class="icon-bar"></span>
			    	<span class="icon-bar"></span>
			   </button>
			   <a class="navbar-brand" href="#">Contas</a>
			</div>
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			    <ul class="nav navbar-nav">
				    <li class="active"><a href="index.php">Início <span class="sr-only">(current)</span></a></li>
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <li><a href="?page=cadastroOperadora">Operadora</a></li>
			            <li><a href="?page=cadastroIdentificador">Identificador</a></li>
			             <li role="separator" class="divider"></li>
			            <li><a href="?page=cadastroContrato">Contrato</a></li>
			            <?php if($_SESSION['s_contas_permissao'] === '1'){ ?>
			            <li role="separator" class="divider"></li>
			            <li><a href="?page=cadastroUsuario">Usuario</a></li>
			            <?php } ?>
			          </ul>
			        </li>
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Operações <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <li><a href="?page=pagamentoContas">Pag. Contas</a></li>
			            <li><a href="?page=pagamentoContratos">Pag. Contratos</a></li>
			          </ul>
			        </li>
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pesquisas <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <li><a href="?page=pesquisaOperadora">Operadora</a></li>
			            <li><a href="?page=pesquisaIdentificador">Identificador</a></li>
			            <li role="separator" class="divider"></li>
			            <li><a href="?page=pesquisaContrato">Contrato</a></li>
			            <li role="separator" class="divider"></li>
			            <li><a href="?page=pesquisaPagamento">Pagamento</a></li>
			          </ul>
			        </li>
			        <?php if($_SESSION['s_contas_permissao'] === '1'){ ?>
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Relatórios <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <li><a href="?page=relatorioOperadoras">Operadoras</a></li>
			            <li><a href="?page=relatorioIdentificadores">Identificadores</a></li>
			            <li role="separator" class="divider"></li>
			            <li><a href="?page=relatorioPagContas">Pag. Contas</a></li>
			            <li><a href="?page=relatorioPagContratos">Pag. Contratos</a></li>
			          </ul>
			       </li>
			       <?php } ?>
			    </ul>
			    <ul class="nav navbar-nav navbar-right">
			        <li><a href="#">Ajuda</a></li>
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $usuario->retornaInformacaoUsuario($_SESSION['s_contas_id_usuario'], 'usuario'); ?> <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <li><a href="?page=meusdados">Meus dados</a></li>
			            <li role="separator" class="divider"></li>
			            <li><a href="index.php?page=logout">Sair</a></li>
			          </ul>
			        </li>
			    </ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>