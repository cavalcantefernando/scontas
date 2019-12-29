<?php
	require_once("conexao.class.php");
	class Contrato extends Conexao{
		public function cadastraContrato($contrato, $contratada, $contratante, $data_inicial, $vencimento, $valor, $fidelidade, $tipo_cobranca, $status, $observacao){
			$contrato = strtoupper(trim($contrato));
			$contratada = trim($contratada);
			$contratante = trim($contratante);
			$data_inicial = trim($data_inicial);
			$vencimento = trim($vencimento);
			$valor = trim($valor);
			$valor = str_replace(".", "", $valor);
			$valor = str_replace(",", ".", $valor);
			$fidelidade = trim($fidelidade);
			$tipo_cobranca = trim($tipo_cobranca);
			$status = trim($status);
			$observacao = trim($observacao);
			$vazio = false;
			$var = array($contrato, $contratada, $contratante, $data_inicial, $vencimento, $valor, $fidelidade, $tipo_cobranca, $status, $observacao);
			for($i = 0; $i < count($var); $i++){
				if(empty($var[$i])){
					if($var[$i] != 0)
						$vazio = true;
				}
			}
			
			if($vazio == true){
				return "<div class='alert alert-danger'> Favor preencher os campos corretamente! </div>";
			}else{
				$sql = "SELECT * FROM contratos WHERE contrato = '".$contrato."'";
				$conn = $this->conecta();
				if($rs = $conn->query($sql)){
					if($rs->rowCount() == 0){
						$sql  = "INSERT INTO contratos (contrato, id_contratada, id_contratante, data_inicial, vencimento, valor, fidelidade, id_tipocobranca, observacao, status)";
						$sql .= "VALUES ('".$contrato."','".$contratada."','".$contratante."','".$data_inicial."','".$vencimento."','".$valor."', '".$fidelidade."', '".$tipo_cobranca."', '".$observacao."', '".$status."')";
						if($rs = $conn->query($sql)){
							return "<div class='alert alert-success'> Cadastrado com sucesso! </div>";
						}else{
							return "<div class='alert alert-danger'> Erro ao tentar cadastrar! </div>";
						}					
					}else{
						return "<div class='alert alert-danger'> Contrato já cadastrado! </div>";
					}
				}else{
					return "<div class='alert alert-danger'> Erro ao tentar executar solicitação! </div>";
				}
			}
		}

		public function atualizaContrato($id_contrato, $contrato, $contratada, $contratante, $data_inicial, $vencimento, $valor, $fidelidade, $tipo_cobranca, $status, $observacao){
			$contrato = strtoupper(trim($contrato));
			$contratada = trim($contratada);
			$contratante = trim($contratante);
			$data_inicial = trim($data_inicial);
			$vencimento = trim($vencimento);
			$valor = trim($valor);
			$valor = str_replace(",", ".", $valor);
			$fidelidade = trim($fidelidade);
			$tipo_cobranca = trim($tipo_cobranca);
			$status = trim($status);
			$observacao = trim($observacao);
			$vazio = false;
			$var = array($contrato, $contratada, $contratante, $data_inicial, $vencimento, $valor, $fidelidade, $tipo_cobranca, $status, $observacao);
			for($i = 0; $i < count($var); $i++){
				if(empty($var[$i])){
					if($var[$i] != 0)
						$vazio = true;
				}
			}
			
			if($vazio == true){
				return "<div class='alert alert-danger'> Favor preencher os campos corretamente! </div>";
			}else{
				$conn = $this->conecta();
				$sql  = "UPDATE contratos SET contrato = '$contrato', id_contratada = '$contratada', id_contratante = '$contratante', data_inicial = '$data_inicial', vencimento = '$vencimento', valor = '$valor', fidelidade = '$fidelidade', id_tipocobranca = '$tipo_cobranca', observacao = '$observacao', status = '$status' WHERE id_contrato = ".$id_contrato;
				if($rs = $conn->query($sql)){
					return "<div class='alert alert-success'> Atualizado com sucesso! </div>";
				}else{
					return "<div class='alert alert-danger'> Erro ao tentar atualizar! </div>";
				}
			}
		}

		function acContrato($contrato){
			$conn = $this->conecta();
			$identificador = trim($contrato);
			$identificador = strtoupper($contrato);
			$sql = "SELECT c.id_contrato, c.contrato, p.operadora, g.filial, c.vencimento  FROM contratos c LEFT JOIN operadoras p ON c.id_contratada = p.id_operadora LEFT JOIN filiais g ON c.id_contratante = g.id_filial WHERE c.contrato LIKE '%".$contrato."%' AND status = 1";
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
		
		function pesquisaContratos($contrato){
			$contrato = strtoupper(trim($contrato));
			$i = 0;
			if($conn = $this->conecta()){
				$sql = "SELECT id_contrato, contrato, o.operadora as contratada, l.filial as contratante, vencimento, valor, t.cobranca, c.status
					  		FROM contratos c
					   		LEFT JOIN operadoras o ON o.id_operadora = id_contratada
					   		LEFT JOIN filiais l ON l.id_filial = id_contratante
					   		LEFT JOIN tipocobrancas t ON t.id_cobranca = id_tipocobranca
					   		WHERE contrato LIKE '%".$contrato."%'";
				if($rs = $conn->query($sql)){
					if($rs->rowCount() > 0){
						while($ln = $rs->fetch(PDO::FETCH_ASSOC)){
							$i++;
							$tag .= "<tr>";
							$tag .= "<td>".$i."</td>";
							$tag .= "<td>".$ln['contrato']."</td>";
							$tag .= "<td>".$ln['contratada']."</td>";
							$tag .= "<td>".$ln['contratante']."</td>";
							$tag .= "<td>".$ln['vencimento']."</td>";
							$tag .= "<td>".number_format($ln['valor'], 2)."</td>";
							$tag .= "<td>".$ln['cobranca']."</td>";
							$tag .= "<td>".$ln['status']."</td>";
							$tag .= "<td><a href='?page=editaContrato&id=".$ln['id_contrato']."' class='btn btn-default'>Editar</a></td>";
							$tag .= "</tr>";	
						}						
					}else{
						$tag = "<tr><td colspan='7'><center> Nenhum contrato encontrado! </center></td></tr>";
					}
				}else{
					$tag = "<tr><td colspan='7'><center> Erro ao tentar buscar! </center></td></tr>";
				}
			}else{
				$tag = "<tr><td colspan='7'><center> Erro ao conectar com o banco de dados! </center></td></tr>";
			}
			
			return $tag;
		}

		function retornaInformacao($id, $campo){
			if($conn = $this->conecta()){
				$sql = "SELECT $campo FROM contratos WHERE id_contrato = ".$id;
				if($rs = $conn->query($sql)){
					if($rs->rowCount() > 0 && $rs->rowCount() < 2){
						$ln = $rs->fetchAll();
						return $ln[0][$campo];
					}else{
						return "Erro ao buscar informação no banco ou duplicidade no cadastro!";
					}
				}else{
					return "Erro ao buscar informação no banco!";
				}				
			}else{
				return "Erro ao conectar com o banco!";
			}
		}


	}
?>