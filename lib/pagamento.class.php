<?php
	require_once("pagamento.class.php");
	class Pagamento extends Conexao{
		function pagContas($identificador, $mes, $ano, $valorContratado, $valorExcedente){
			$conn = $this->conecta();
			$identificador = trim($identificador);
			$mes = trim($mes);
			$ano = trim($ano);
			$valorContratado = str_replace(",", ".", trim($valorContratado));

			if(empty($valorExcedente))
				$valorExcedente = 0;
			
			$valorExcedente = str_replace(",", ".", trim($valorExcedente));

				$sql = "SELECT * FROM pagamentos WHERE identificador = '".$identificador."' AND mes = '".$mes."' AND ano = '".$ano."'AND tipo = 1";
			if($rs = $conn->query($sql)){
				if(!$rs->rowCount() > 0){
					$sql = "INSERT INTO pagamentos (identificador, mes, ano, valor_contratado, valor_excedente, tipo) 
							VALUES ('".$identificador."', '".$mes."', '".$ano."', '".$valorContratado."', '".$valorExcedente."', 1)";
					if($rs = $conn->query($sql)){
						return "<div class='alert alert-success'>Pagamento registrado com sucesso!</div>";
					}else{
						return "<div class='alert alert-danger'>Erro ao tentar registrar pagamento!</div>";
					}
				}else{
					return "<div class='alert alert-danger'>Pagamento já registrado!</div>";
				}
			}else{
				return "<div class='alert alert-danger'>Erro ao tentar verificar pagamento!</div>";
			}					
		}

		function pagContratos($contrato, $mes, $ano, $valorContratado, $valorExcedente){
			$conn = $this->conecta();
			$contrato = trim($contrato);
			$mes = trim($mes);
			$ano = trim($ano);
			$valorContratado = str_replace(".", "", trim($valorContratado));
			$valorContratado = str_replace(",", ".", trim($valorContratado));

			if(empty($valorExcedente))
				$valorExcedente = 0;
			$valorExcedente = str_replace(".", "", trim($valorExcedente));
			$valorExcedente = str_replace(",", ".", trim($valorExcedente));

			$sql = "SELECT * FROM pagamentos WHERE identificador = '".$contrato."' AND mes = '".$mes."' AND ano = '".$ano."' AND tipo = 2";
			if($rs = $conn->query($sql)){
				if(!$rs->rowCount() > 0){
					$sql = "INSERT INTO pagamentos (identificador, mes, ano, valor_contratado, valor_excedente, tipo) 
							VALUES ('".$contrato."', '".$mes."', '".$ano."', '".$valorContratado."', '".$valorExcedente."', 2)";
					if($rs = $conn->query($sql)){
						return "<div class='alert alert-success'>Pagamento registrado com sucesso!</div>";
					}else{
						return "<div class='alert alert-danger'>Erro ao tentar registrar pagamento!</div>";
					}
				}else{
					return "<div class='alert alert-danger'>Pagamento já registrado!</div>";
				}
			}else{
				return "<div class='alert alert-danger'>Erro ao tentar verificar pagamento!</div>";
			}
		}

		function atualizaPagamento($id_pagamento, $mes, $ano, $valorContratado, $valorExcedente){
			$mes = trim($mes);
			$ano = trim($ano);
			$valorContratado = str_replace(",", ".", trim($valorContratado));

			if(empty($valorExcedente))
				$valorExcedente = 0;
			
			$valorExcedente = str_replace(",", ".", trim($valorExcedente));
			
			$sql = "UPDATE pagamentos SET mes = '$mes', ano = '$ano', valor_contratado = '$valorContratado', valor_excedente = '$valorExcedente' WHERE id_pagamentos = ".$id_pagamento;
			
			$conn = $this->conecta();
			
			if($rs = $conn->query($sql)){
				return "<div class='alert alert-success'>Pagamento Atualizado!</div>";
			}else{
				return "<div class='alert alert-danger'>Erro ao tentar atualizar!</div>";
			}
			
		}
		
		function excluirPagamento( $id ){
			$sql = "DELETE FROM pagamentos WHERE id_pagamentos = ".$id;
			$conn = $this->conecta();			
			if($rs = $conn->query($sql)){
				return "<div class='alert alert-success'>Registro ecluido com sucesso!</div>";
			}else{
				return "<div class='alert alert-danger'>Erro ao tentar excluir!</div>";
			}
		}
		
		function retornaInformacaoPagamento($id, $campo){
			$conn = $this->conecta();
			$sql = "SELECT $campo FROM pagamentos WHERE id_pagamentos = ".$id;
			if($rs = $conn->query($sql)){
				if($rs->rowCount() > 0 && $rs->rowCount() < 2){
					$ln = $rs->fetchAll();
					return $ln[0][$campo];
				}else{
					return "Pagamento duplicado!";
				}
			}else{
				return "Erro ao buscar informação!";
			}
		}
		
		function pesquisaPagamentos($pesq , $nivel){
			require_once("lib/acao.class.php");
			$acao = new Acao();
			$i = 0;
			$conn = $this->conecta();
			$sql = "SELECT id_pagamentos, i.identificador, f.filial, o.operadora, p.mes, p.ano, p.valor_contratado, p.valor_excedente FROM pagamentos p
						LEFT JOIN identificadores i
							ON p.identificador = i.id_identificador
					    LEFT JOIN operadoras o
							ON i.operadora = o.id_operadora
					    LEFT JOIN filiais f
							ON i.filial = f.id_filial
						WHERE i.identificador LIKE '%".$pesq."%' AND p.tipo = 1 ORDER BY id_pagamentos DESC;
						";
				if($rs = $conn->query($sql)){
					if($rs->rowCount() > 0){
						$tag = "";
						while($ln = $rs->fetch(PDO::FETCH_ASSOC)){
							$i++;
							$valor = (float) $ln['valor_contratado'] + (float) $ln['valor_excedente'];
							$tag .= "<tr>";
							$tag .= "<td>".$i."</td>";
							$tag .= "<td>".$ln['identificador']."</td>";
							$tag .= "<td>".$ln['filial']."</td>";
							$tag .= "<td>".$ln['operadora']."</td>";
							$tag .= "<td>".$acao->retornaMes($ln['mes'])."</td>";
							$tag .= "<td>".$ln['ano']."</td>";
							$tag .= "<td>R$ ".number_format($valor, 2, ',','.')."</td>";
							$tag .= "<td>";
							$tag .= "<a class='btn btn-success' href='index.php?page=editaPagamento&id=".$ln['id_pagamentos']."'>Editar</a> &nbsp;";
							if($nivel === '1'){
							$tag .= "<a class='btn btn-danger' href='index.php?page=excluirPagamento&id=".$ln['id_pagamentos']."'>Excluir</a>";
							$tag .= "</td>";
							}
							$tag .= "</tr>";
						}
						$tag .= "</tbody></table>";
						
						return $tag;
					}else{
						return "<tr><td colspan='7' align='center'>Não consta nenhum pagamento!</td></tr>";
					}
				}else{
					return "<tr><td colspan='7' align='center'>Erro ao tentar consultar os pagamentos!</td></tr>";
				}	
		}
		
		function relatorioPagContratos($page){
			require_once("lib/acao.class.php");
			$acao = new Acao();
			$p_page = $page;
			$conn = $this->conecta();
			$mes = date('m');
			$ano = date('Y');
			$sql = "SELECT i.contrato, f.filial, o.operadora, p.mes, p.ano, p.valor_contratado, p.valor_excedente FROM pagamentos p
						LEFT JOIN contratos i
							ON p.identificador = i.id_contrato
					    LEFT JOIN operadoras o
							ON i.id_contratada = o.id_operadora
					    LEFT JOIN filiais f
							ON i.id_contratante = f.id_filial
						WHERE p.tipo = 2
						";
			if($rs = $conn->query($sql)){
				$paginas = ceil($rs->rowCount() / 16);				
				$max_paginacao = 5;
				$pag_laterais = ceil($max_paginacao / 2);
				if(!isset($page) || $page <= 1){
					$inicio = 0;
					$limite = $max_paginacao;
					$page = 0;
					$pageA = 16;
				}else{
					$inicio = $page - $pag_laterais;
					if($inicio < 0)
						$inicio = 0;
					$limite = $page + $pag_laterais;
					if($limite > $paginas)
						$limite = $paginas;
					$page = $page * 15;
					$pageA = 16;
				}
				$sql = "SELECT i.contrato, f.filial, o.operadora, p.mes, p.ano, p.valor_contratado, p.valor_excedente FROM pagamentos p
						LEFT JOIN contratos i
							ON p.identificador = i.id_contrato
					    LEFT JOIN operadoras o
							ON i.id_contratada = o.id_operadora
					    LEFT JOIN filiais f
							ON i.id_contratante = f.id_filial
						WHERE p.tipo = 2
						ORDER BY id_pagamentos DESC
						LIMIT ".$page.", ".$pageA."";
				if($rs = $conn->query($sql)){
					if($rs->rowCount() > 0){
						if($page != 0){
							$i = $page - 15;
						}else{
							$i = 0;
						}				
						$tag = "";
						while($ln = $rs->fetch(PDO::FETCH_ASSOC)){
							$i++;
							$valor = (float) $ln['valor_contratado'] + (float) $ln['valor_excedente'];
							$tag .= "
								<tr>
									<td>".$i."</td>
									<td>".$ln['contrato']."</td>
									<td>".$ln['filial']."</td>
									<td>".$ln['operadora']."</td>
									<td>".$acao->retornaMes($ln['mes'])."</td>
									<td>".$ln['ano']."</td>
									<td>R$ ".number_format($valor, 2, ',','.')."</td>
								</tr>
							";
	
						}
						
						$tag .= "</tbody></table>";
						$tag .= '<center><nav aria-label="Page navigation">
								  <ul class="pagination">
								    ';	
						if($paginas > 1){		
							for($i = $inicio; $i <= $limite; $i++){
								if($i != 0){
									if($p_page == $i){
										$tag .= "<li><a href='' style='background-color: #EEE9E9;'><u>".$i."</u></a></li>";
									}else{
										$tag .= "<li><a href='index.php?page=relatorioPagContratos&pg=".$i."'>".$i."</a></li>";	
									}
										
								}								
							}
						}
						$tag .= '</ul></nav></center>';
						
						
						return $tag;
					}else{
						return "<tr><td colspan='7' align='center'>Não consta nenhum pagamento!</td></tr>";
					}
				}else{
					return "<tr><td colspan='7' align='center'>Erro ao tentar consultar os pagamentos!</td></tr>";
				}
			}		
		}
		
		function relatorioPagContas($page){
			require_once("lib/acao.class.php");
			$acao = new Acao();
			$p_page = $page;
			$conn = $this->conecta();
			$mes = date('m');
			$ano = date('Y');
			$sql = "SELECT i.identificador, f.filial, o.operadora, p.mes, p.ano, p.valor_contratado, p.valor_excedente FROM pagamentos p
						LEFT JOIN identificadores i
							ON p.identificador = i.id_identificador
					    LEFT JOIN operadoras o
							ON i.operadora = o.id_operadora
					    LEFT JOIN filiais f
							ON i.filial = f.id_filial
						WHERE p.tipo = 1
						";
			if($rs = $conn->query($sql)){
				$paginas = ceil($rs->rowCount() / 16);				
				$max_paginacao = 5;
				$pag_laterais = ceil($max_paginacao / 2);
				if(!isset($page) || $page <= 1){
					$inicio = 0;
					$limite = $max_paginacao;
					$page = 0;
					$pageA = 16;
				}else{
					$inicio = $page - $pag_laterais;
					if($inicio < 0)
						$inicio = 0;
					$limite = $page + $pag_laterais;
					if($limite > $paginas)
						$limite = $paginas;
					$page = $page * 15;
					$pageA = 16;
				}
				$sql = "SELECT i.identificador, f.filial, o.operadora, p.mes, p.ano, p.valor_contratado, p.valor_excedente FROM pagamentos p
						LEFT JOIN identificadores i
							ON p.identificador = i.id_identificador
					    LEFT JOIN operadoras o
							ON i.operadora = o.id_operadora
					    LEFT JOIN filiais f
							ON i.filial = f.id_filial
						WHERE p.tipo = 1
						ORDER BY id_pagamentos DESC
						LIMIT ".$page.", ".$pageA."";
				if($rs = $conn->query($sql)){
					if($rs->rowCount() > 0){
						if($page != 0){
							$i = $page - 15;
						}else{
							$i = 0;
						}				
						$tag = "";
						while($ln = $rs->fetch(PDO::FETCH_ASSOC)){
							$i++;
							$valor = (float) $ln['valor_contratado'] + (float) $ln['valor_excedente'];
							$tag .= "
								<tr>
									<td>".$i."</td>
									<td>".$ln['identificador']."</td>
									<td>".$ln['filial']."</td>
									<td>".$ln['operadora']."</td>
									<td>".$acao->retornaMes($ln['mes'])."</td>
									<td>".$ln['ano']."</td>
									<td>R$ ".number_format($valor, 2, ',','.')."</td>
								</tr>
							";
	
						}
						
						$tag .= "</tbody></table>";
						$tag .= '<center><nav aria-label="Page navigation">
								  <ul class="pagination">
								    ';	
						if($paginas > 1){		
							for($i = $inicio; $i <= $limite; $i++){
								if($i != 0){
									if($p_page == $i){
										$tag .= "<li><a href='' style='background-color: #EEE9E9;'><u>".$i."</u></a></li>";
									}else{
										$tag .= "<li><a href='index.php?page=relatorioPagContas&pg=".$i."'>".$i."</a></li>";	
									}
										
								}								
							}
						}
						$tag .= '</ul></nav></center>';
						
						
						return $tag;
					}else{
						return "<tr><td colspan='7' align='center'>Não consta nenhum pagamento!</td></tr>";
					}
				}else{
					return "<tr><td colspan='7' align='center'>Erro ao tentar consultar os pagamentos!</td></tr>";
				}
			}		
		}
		
		
	}
?>