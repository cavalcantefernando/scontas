<?php
	require_once("conexao.class.php");
	class Identificador extends Conexao{
		function cadastraIdentificador($identificador, $operadora, $emissao, $vencimento, $filial, $filial_instalacao){
			$conn = $this->conecta();

			$identificador = trim($identificador);
			$operadora = trim($operadora);
			$emissao = trim($emissao);
			$vencimento = trim($vencimento);
			$filial = trim($filial);

			$identificador = strtoupper($identificador);

			$sql = "SELECT * FROM identificadores WHERE identificador = '".$identificador."'";

			if($rs = $conn->query($sql)){
				if(!$rs->rowCount() > 0){
					$sql = "INSERT INTO identificadores(identificador, operadora, emissao, vencimento, filial, ativo, filial_instalacao) 
					VALUES ('".$identificador."', '".$operadora."', '".$emissao."', '".$vencimento."', '".$filial."', 1, '".$filial_instalacao."')";	

					if($rs = $conn->query($sql)){
						return "<div class='alert alert-success'>Identificador cadastro com sucesso!</div>";
					}else{
						return "<div class='alert alert-danger'>Erro ao tentar cadastrar identificador!</div>";
					}
				}else{
					return "<div class='alert alert-danger'>Identificador já cadastrado!</div>";
				}
			}else{
				return "<div class='alert alert-danger'>Erro ao tentar verificar identificador!</div>";
			}
		}

		function atualizaIdentificador($id, $identificador, $operadora, $emissao, $vencimento, $filial_cobranca, $filial_instalacao){
			$sql = "UPDATE identificadores 
						SET identificador = '$identificador', 
							operadora = '$operadora', 
							emissao = '$emissao', 
							vencimento = '$vencimento', 
							filial = '$filial_cobranca', 
							filial_instalacao = '$filial_instalacao' 
						WHERE id_identificador = ".$id;
			$conn = $this->conecta();
			if($rs = $conn->query($sql)){
				return "<div class='alert alert-success'>Identificador atualizado!</div>";
			}else{
				return "<div class='alert alert-danger'>Erro ao tentar atualizar!</div>";
			}
			
		}
		
		function retornaInformacaoIdentificador($id, $campo){
			$conn = $this->conecta();
			$sql = "SELECT ".$campo." FROM identificadores WHERE id_identificador = ".$id;
			if($rs = $conn->query($sql)){
				if($rs->rowCount() > 0 && $rs->rowCount() < 2){
					$ln = $rs->fetchAll();
					return $ln[0][$campo];
				}else{
					return "Identificador duplicado!";
				}
			}else{
				return "Erro ao buscar informação!";
			}				
		}
		
		function acIdentificador($identificador){
			$conn = $this->conecta();
			$identificador = trim($identificador);
			$identificador = strtoupper($identificador);
			$sql = "SELECT i.id_identificador, i.identificador, p.operadora, i.emissao, i.vencimento, f.filial FROM identificadores i LEFT JOIN operadoras p ON i.operadora = p.id_operadora LEFT JOIN filiais f ON f.id_filial = i.filial_instalacao  WHERE identificador LIKE '%".$identificador."%' AND i.ativo = 1";
			if($rs = $conn->query($sql)){
				if($rs->rowCount() > 0){
					$ln = $rs->fetchAll();
					return json_encode($ln);
				}else{
					return json_encode("Vazio");
				}
			}else{
				return "Erro!";
			}
		}

		function pesquisaIdentificadores( $pesq ){						
			$pesq = trim($pesq);
			$tag = "";
			$i = 0;
			if(!empty($pesq)){
				$conn = $this->conecta();
				$sql = "SELECT i.id_identificador as id, i.identificador, o.operadora, i.emissao, i.vencimento, f.filial as cobranca, g.filial as instalacao
						  FROM identificadores i
						    LEFT JOIN operadoras o
						      ON i.operadora = o.id_operadora
						    LEFT JOIN filiais f
						      ON i.filial = f.id_filial
						    LEFT JOIN filiais g
						      ON i.filial_instalacao = g.id_filial
						  WHERE i.identificador LIKE '%".$pesq."%';";
				if($rs = $conn->query($sql)){
					if($rs->rowCount() > 0){
						while($ln = $rs->fetch(PDO::FETCH_ASSOC)){
							$i++;
							$tag .= "<tr>";
							$tag .= "<td>".$i."</td>";
							$tag .= "<td>".$ln['identificador']."</td>";
							$tag .= "<td>".$ln['operadora']."</td>";
							$tag .= "<td>".$ln['emissao']."</td>";
							$tag .= "<td>".$ln['vencimento']."</td>";
							$tag .= "<td>".$ln['cobranca']."</td>";
							$tag .= "<td>".$ln['instalacao']."</td>";
							$tag .= "<td><a class='btn btn-success' href='index.php?page=editaIdentificador&id=".$ln['id']."'>Editar</a></td>";
							$tag .= "</tr>"; 
						}
						
						return $tag;
					}else{
						return "<tr><td colspan='7' align='center'>Nenhum identificador encontrado!</td></tr>";
					}
				}else{
					return "<tr><td colspan='7' align='center'>Erro ao tentar pesquisar!</td></tr>";
				}
			}else{
				return "<tr><td colspan='7' align='center'>Favor digitar uma informação válida!</td></tr>";
			}
		}

		function relatorioIdentificadores($page){
					$p_page = $page;
					$conn = $this->conecta();
					$mes = date('m');
					$ano = date('Y');
					$sql = "SELECT identificador, o.operadora, emissao, vencimento, f.filial, a.filial FROM identificadores i
							  LEFT JOIN operadoras o ON o.id_operadora = i.operadora
							  LEFT JOIN filiais f ON f.id_filial = i.filial
							  LEFT JOIN filiais a ON a.id_filial = i.filial_instalacao";
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
						$sql = "SELECT identificador, o.operadora, emissao, vencimento, f.filial, a.filial as instalacao FROM identificadores i
								  LEFT JOIN operadoras o ON o.id_operadora = i.operadora
								  LEFT JOIN filiais f ON f.id_filial = i.filial
								  LEFT JOIN filiais a ON a.id_filial = i.filial_instalacao LIMIT ".$page.", ".$pageA."";
						if($rs = $conn->query($sql)){
							if($rs->rowCount() > 0){
								if($page != 0)
									$i = $page - 15;
								else
									$i = 0;				
								$tag = "";
								while($ln = $rs->fetch(PDO::FETCH_ASSOC)){
									$i++;
									$tag .= "
										<tr>
											<td>".$i."</td>
											<td>".$ln['identificador']."</td>
											<td>".$ln['operadora']."</td>
											<td>".$ln['emissao']."</td>
											<td>".$ln['vencimento']."</td>
											<td>".$ln['filial']."</td>
											<td>".$ln['instalacao']."</td>
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
												$tag .= "<li><a href='index.php?page=relatorioIdentificadores&pg=".$i."'>".$i."</a></li>";	
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