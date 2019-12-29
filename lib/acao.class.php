<?php
	require_once("conexao.class.php");
	class Acao extends Conexao{
		public function start($page, $dir){
			switch($page){
				case '':
					return $dir."dashboard.php";
					break;
				/* cadastro */
				case 'cadastroOperadora':
					return $dir."cadastros/operadoras.php";
					break;
				case 'cadastroIdentificador':
					return $dir."cadastros/identificadores.php";
					break;
				case 'cadastroUsuario':
					if($_SESSION['s_contas_permissao'] === '1'){
						return $dir."cadastros/usuarios.php";
					}else{
						return $dir."dashboard".$tipo;
					}
					break;
				case 'cadastroContrato':
					return $dir."cadastros/contratos.php";
					break;
					
				/* pesquisa */
				case 'pesquisaIdentificador':
					return $dir."pesquisas/identificadores.php";
					break;
				case 'pesquisaOperadora':
					return $dir."pesquisas/operadoras.php";
					break;
				case 'pesquisaPagamento':
					return $dir."pesquisas/pagamentos.php";
					break;
				case 'pesquisaContrato':
					return $dir."pesquisas/contratos.php";
					break;
				
				/* edicao */
				case 'editaIdentificador':
					return $dir."edicoes/identificadores.php";
					break;
				case 'editaOperadora':
					return $dir."edicoes/operadoras.php";
					break;
				case 'editaPagamento':
					return $dir."edicoes/pagamentos.php";
					break;
				case 'editaContrato':
					return $dir."edicoes/contratos.php";
					break;	
				/* excluir */
				case 'excluirPagamento':
					return $dir."exclusoes/pagamentos.php";
					break;
					
				/* operacao */
				case 'pagamentoContas':
					return $dir."operacoes/pagamentos_contas.php";
					break;
				case 'pagamentoContratos':
					return $dir."operacoes/pagamentos_contratos.php";
					break;
							
				/* relatorio */
				
				case 'relatorioOperadoras':	
					if($_SESSION['s_contas_permissao'] === '1'){
						return $dir."relatorios/operadoras.php";
					}else{
						return $dir."dashboard".$tipo;
					}
					break;
				case 'relatorioIdentificadores':
					if($_SESSION['s_contas_permissao'] === '1'){	
						return $dir."relatorios/identificadores.php";
					}else{
						return $dir."dashboard".$tipo;
					}
					break;
				case 'relatorioPagContas':
					if($_SESSION['s_contas_permissao'] === '1'){	
						return $dir."relatorios/pagcontas.php";
					}else{
						return $dir."dashboard.php";
					}
					break;
				case 'relatorioPagContratos':
					if($_SESSION['s_contas_permissao'] === '1'){	
						return $dir."relatorios/pagcontratos.php";
					}else{
						return $dir."dashboard.php";
					}
					break;
						
				/* usuario */
				case 'meusdados':
					return $dir."edicoes/meusdados.php";
					break;
							
				/* funcao */
				case 'logout':
					require_once("lib/usuario.class.php");
					$usuario = new Usuario();
					$usuario->logout();
					break;
			}
		}
		
		function retMes( $mes ){
			$tag = "";
			$meses = 12;
			
			$tag .= "<option value='".$mes."'>".$mes." - ".$this->retornaMes( $mes )."</option>";
			$tag .= "<option value=''> ---- </option>";
			for($i = 1; $i <= $meses; $i++){
				if($i != $mes)
					$tag .= "<option value='".$i."'>".$i." - ".$this->retornaMes($i)."</option>";
			}
			
			return $tag;
		}
		
		function retAno( $ano ){
			$tag = "";
			$tag .= "<option value='".$ano."'>".$ano."</option>";
			$tag .= "<option value=''> ---- </option>";
			$anoT = date('Y', strtotime($ano));
			for($i = $anoT - 3; $i <= $anoT + 1; $i++){
				if($i != $ano){
					$tag .= "<option value='".$i."'>".$i."</option>";
				}
			}			
			return $tag;
		}
		
		function retornaDia($dia){
			$tag = "";
			if($dia != 0 ){
				$tag .= "<option value='".$dia."'>".$dia."</option>"; 
				$tag .= "<option value=''> ----------- </option>";
			}else{
				$tag .= "<option value=''> ----------- </option>";
			}
			for($i = 1; $i <= 31; $i++){
				if($dia != 0){
					if($i != $dia)
						$tag .= "<option value='".$i."'>".$i."</option>";	
				}else{
					if($i = 1)
						$tag .= "<option value=''> ----------- </option>";
					
					$tag .= "<option value='".$i."'>".$i."</option>";
				}
				
			}
			
			return $tag;
		}

		function retornaMes ($mes){
			switch ($mes) {
				case '1':
					return "Janeiro";
					break;
				case '2':
					return "Fevereiro";
					break;
				case '3':
					return "Março";
					break;
				case '4':
					return "Abril";
					break;
				case '5':
					return "Maio";
					break;
				case '6':
					return "Junho";
					break;
				case '7':
					return "Julho";
					break;
				case '8':
					return "Agosto";
					break;
				case '9':
					return "Setembro";
					break;
				case '10':
					return "Outubro";
					break;
				case '11':
					return "Novembro";
					break;
				case '12':
					return "Dezembro";
					break;
			}
		}

		function retornaContasAVencer(){
			$conn = $this->conecta();

			$inicio = date("d", strtotime("-2 days"));
			$depois = date("d", strtotime("+10 days"));
			$mes = date('m');
			if($mes == '12'){
				$ano = date('Y');
			}else{
				$ano = date('Y');
			}

			$sql = "SELECT i.identificador, p.operadora, i.vencimento, f.filial 
						FROM identificadores i 
						LEFT JOIN operadoras p 
							ON i.operadora = p.id_operadora 
						LEFT JOIN filiais f 
							ON i.filial_instalacao = f.id_filial 
						WHERE vencimento >= '".$inicio."' 
							OR vencimento <= '".$depois."' 
							AND i.ativo = 1 
							AND id_identificador not in 
								( SELECT identificador FROM pagamentos WHERE mes = '".$mes."' AND ano = '".$ano."' ORDER BY vencimento)";

			if($rs = $conn->query($sql)){
				if($rs->rowCount() > 0){
					$i = 0;
					$tag = "";
					while($ln = $rs->fetch(PDO::FETCH_ASSOC)){
						$i++;
						$tag .= "
								<tr>
									<td>".$i."</td>
									<td>".$ln['identificador']."</td>
									<td>".$ln['operadora']."</td>
									<td>".$ln['vencimento']."</td>
									<td>".$ln['filial']."</td>
								</tr>
								";	
					}
					return $tag;
				}else{
					//caso não existir registros
					return "<tr><td colspan='5' align='center'> Nenhuma conta emitida pendente! </td></tr>";
				}
			}else{
				//caso não for possível executar a função
				return "<tr><td colspan='5' align='center'> Erro ao tentar buscar informações! </td></tr>";
			}
		}

		function retornaContasPendentes($mes, $ano){			
			$conn = $this->conecta();
			$sql = "SELECT i.identificador, i.vencimento,  p.operadora, f.filial 
						FROM identificadores i 
						LEFT JOIN operadoras p 
							ON i.operadora = p.id_operadora 
						LEFT JOIN filiais f 
							ON i.filial_instalacao = f.id_filial 
						WHERE id_identificador not in 
							(SELECT identificador FROM pagamentos WHERE mes = '".$mes."' AND ano = '".$ano."' AND tipo = 1) 
							AND i.ativo = 1 
						ORDER BY i.vencimento";
			if($rs = $conn->query($sql)){
				if($rs->rowCount() > 0){
					$i = 0;
					$tag = "";
					$diaAtual = date('d');
					while($ln = $rs->fetch(PDO::FETCH_ASSOC)){
						$i++;						
						if($mes == date('m') && $ano == date('Y')){
							$cor = $ln['vencimento'] <= $diaAtual ? 'red' : '';	
						}else{
							$cor = '';
						}
						$tag .= "
							<tr style='color: ".$cor."; font-size: 12px'>
								<td>".$i."</td>
								<td>".$ln['identificador']."</td>
								<td>".$ln['operadora']."</td>
								<td>".$ln['vencimento']."</td>
								<td>".$ln['filial']."</td>
							</tr>
						";
					}
					return $tag;
				}else{
					//caso não existir registros
					return "<tr><td colspan='5' align='center'> Nenhuma conta pendente! </td></tr>";
				}				
			}else{
				//caso não for possível executar a função
				return "<tr><td colspan='5' align='center'> Erro ao tentar buscar informações! </td></tr>";
			}
		}// fim IF
		
		function retornaContratosPendentes($mes, $ano){			
			$conn = $this->conecta();
			$sql = "SELECT i.contrato, i.vencimento, p.operadora, f.filial FROM contratos i LEFT JOIN operadoras p ON i.id_contratada = p.id_operadora LEFT JOIN filiais f ON i.id_contratante = f.id_filial WHERE i.id_contrato not in (SELECT identificador FROM pagamentos WHERE mes = '".$mes."' AND ano = '".$ano."' AND tipo = 2) ORDER BY i.vencimento";
			if($rs = $conn->query($sql)){
				if($rs->rowCount() > 0){
					$i = 0;
					$tag = "";
					$diaAtual = date('d');
					while($ln = $rs->fetch(PDO::FETCH_ASSOC)){
						$i++;						
						if($mes == date('m') && $ano == date('Y')){
							$cor = $ln['vencimento'] <= $diaAtual ? 'red' : '';	
						}else{
							$cor = '';
						}
						$tag .= "
							<tr style='color: ".$cor."; font-size: 12px'>
								<td>".$i."</td>
								<td>".$ln['contrato']."</td>
								<td>".$ln['operadora']."</td>
								<td>".$ln['vencimento']."</td>
								<td>".$ln['filial']."</td>
							</tr>
						";
					}
					return $tag;
				}else{
					//caso não existir registros
					return "<tr><td colspan='5' align='center'> Nenhuma contrato pendente! </td></tr>";
				}				
			}else{
				//caso não for possível executar a função
				return "<tr><td colspan='5' align='center'> Erro ao tentar buscar informações! </td></tr>";
			}
		}// fim IF
		
		function paginacaoContasPendentes($mes, $ano){
			/* MANIPULAÇÃO DAS DATAS DE FORMA CORRETA, ONDE A CADA ALTERAÇÃO DE VIEW NA DASHBOARD */ 
			/* TEM QUE HAVER A ALTERAÇÃO DO MENU DE NAVEGAÇÃO DOS MESES.*/
			$dia = 1;
			$mes = $mes;
			$ano = $ano;
			$dataA = mktime(0,0,0, $mes - 1, $dia , $ano);			
			$dataA = date("m/Y", $dataA);
			$dataP = mktime(0,0,0, $mes + 1, $dia , $ano);			
			$dataP = date("m/Y", $dataP);		
			
			$p_data = explode("/", $dataA); // SEPARANDO A DATA ANTERIOR EM ARRAY PARA EXIBIÇÃO			
			$n_data = explode("/", $dataP); // SEPARANDO A DATA POSTERIOR EM ARRAY PARA EXIBIÇÃO
			
			$tag = '<li class="previous">
						<a href="index.php?mes='.$p_data[0].'&ano='.$p_data[1].'">
							<span aria-hidden="true">&larr;</span>
							'.$this->retornaMes($p_data[0]).' / '.$p_data[1].' 
						</a>
					</li>';
			$tag .= '<li class="next">
					 	<a href="index.php?mes='.$n_data[0].'&ano='.$n_data[1].'">
							'.$this->retornaMes($n_data[0]).' / '.$n_data[1].' 
							<span aria-hidden="true">&rarr;</span>
						</a>
					</li>';
		
			return $tag;
		}

		public function tipocobrancas(){
			$conn = $this->conecta();
			$tag = "";
			$sql = "SELECT * FROM tipocobrancas WHERE status = 1";
			if($rs = $conn->query($sql)){
				if($rs->rowCount() > 0){
					while($ln = $rs->fetch(PDO::FETCH_ASSOC)){
						$tag .= "<option value='".$ln['id_cobranca']."'>".$ln['cobranca']."</option>";
					}
				}else{
					$tag = "<option value=''> Nenhum método cadastrado! </option>";
				}
			}else{
				$tag = "<option value=''> Erro ao buscar métodos! </option>";
			}
			
			return $tag;			
		}
		
		public function stipocobrancas($id){
			$conn = $this->conecta();
			$tag = "";
			$sql = "SELECT * FROM tipocobrancas WHERE status = 1 AND id_cobranca = ".$id;
			if($rs = $conn->query($sql)){
				if($rs->rowCount() == 1){
					$ln = $rs->fetchAll();
					$tag .= "<option value='".$ln[0]['id_cobranca']."'>".$ln[0]['cobranca']."</option>";
					$tag .= "<option value=''> ----------- </option>";
					$sql = "SELECT * FROM tipocobrancas WHERE status = 1 AND id_cobranca <> ".$id;
					if($rs = $conn->query($sql)){
						if($rs->rowCount() > 0){
							while($ln = $rs->fetch(PDO::FETCH_ASSOC)){
								$tag .= "<option value='".$ln['id_cobranca']."'>".$ln['cobranca']."</option>";
							}
						}else{
							$tag = "<option value=''> Nenhum método cadastrado! </option>";
						}
					}else{
						$tag = "<option value=''> Erro ao buscar métodos! </option>";
					}
				}else{
					$tag = "<option value=''> Nenhum método cadastrado! </option>";
				}
			}else{
				$tag = "<option value=''> Erro ao buscar métodos! </option>";
			}
			
			
			return $tag;
		}
	
		public function fidelidade(){
			$tag = "";			
			$tag .= "<option value=''> ------------</option>";
			for($i = 0; $i <= 10; $i++){
				$tag .= "<option value='".$i."'>".$i." Ano(s)</option>";		
			}			
			return $tag;
		}
		
		public function sfidelidade($a){
			$tag = "";
			
			$tag .= "<option value='".$a."'>".$a." Ano(s)</option>";
			$tag .= "<option value=''> ------------</option>";
			for($i = 0; $i <= 10; $i++){
				if($i != $a){
					$tag .= "<option value='".$i."'>".$i." Ano(s)</option>";	
				}		
			}
			
			return $tag;
		}
		
		public function status(){
			$tag = "";
			$tag .= "<option value=''> ------- </option>";
			$tag .= "<option value='1'> Ativo </option>";
			$tag .= "<option value='0'> Cancelado </option>";			
			return $tag;
		}
		
		public function sstatus($s){
			$tag = "";
			if($s == 1){
				$tag .= "<option value='1'> Ativo </option>";
				$tag .= "<option value=''> ------- </option>";				
				$tag .= "<option value='0'> Cancelado </option>";	
			}elseif($s == 0){
				$tag .= "<option value='0'> Cancelado </option>";
				$tag .= "<option value=''> ------- </option>";
				$tag .= "<option value='1'> Ativo </option>";
			}else{
				$tag .= "<option value=''> ------- </option>";
				$tag .= "<option value='1'> Ativo </option>";
				$tag .= "<option value='0'> Cancelado </option>";
			}						
			return $tag;
		}
}
?>