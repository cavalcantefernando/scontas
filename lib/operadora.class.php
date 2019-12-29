<?php
	require_once("conexao.class.php");
	class Operadora extends Conexao{
		public function cadastraOperadora($operadora, $tipo){
			$conn = $this->conecta();
			$operadora = trim($operadora);
			$operadora = strtoupper($operadora);
			$sql = "SELECT * FROM operadoras WHERE operadora = '".$operadora."' AND tipo = ".$tipo;
			if($rs = $conn->query($sql)){
				if($rs->rowCount() == 0){
					$sql = "INSERT INTO operadoras (operadora, tipo) VALUES ('".$operadora."', '".$tipo."')";
					if($rs = $conn->query($sql)){
						return "<div class='alert alert-success'>Operadora cadastrada com sucesso!</div>";
					}else{
						return "<div class='alert alert-danger'>Erro ao tentar cadastrar operadora!</div>";
					}
				}else{
					return "<div class='alert alert-danger'>Prestadora já cadastrada!</div>";
				}
			}else{
				return "<div class='alert alert-danger'>Erro ao tentar verificar operadora!</div>";
			}			
		}
		
		function atualizaOperadora ($id, $operadora){
			$sql = "UPDATE operadoras SET operadora = '$operadora' WHERE id_operadora = ".$id;
			$conn = $this->conecta();
			if($rs = $conn->query($sql)){
				return "<div class='alert alert-success'>Operadora Atualizada!</div>";
			}else{
				return "<div class='alert alert-danger'>Erro ao tentar atualizar!</div>";
			}
		}
		
		function retornaInformacaoOperadora($id, $campo){
			$conn = $this->conecta();
			$sql = "SELECT $campo FROM operadoras WHERE id_operadora = ".$id;
			if($rs = $conn->query($sql)){
				if($rs->rowCount() > 0 && $rs->rowCount() < 2){
					$ln = $rs->fetchAll();
					return $ln[0][$campo];
				}else{
					return "Operadora duplicada!";
				}
			}else{
				return "Erro ao buscar informação!";
			}			
		}
		
		function pesquisaOperadoras( $pesq ){
			$pesq = trim ($pesq);
			$tag = "";
			$i = 0;
			if(!empty($pesq)){
				$conn = $this->conecta();
				$sql = "SELECT * FROM operadoras WHERE operadora LIKE '%".$pesq."%'";
				if($rs = $conn->query($sql)){
					if($rs->rowCount() > 0 ){
						while($ln = $rs->fetch(PDO::FETCH_ASSOC)){
							$i++;
							$tag .= "<tr>";
							$tag .= "<td>".$i."</td>";
							$tag .= "<td>".$ln['operadora']."</td>";
							$tag .= "<td><a class='btn btn-success' href='index.php?page=editaOperadora&id=".$ln['id_operadora']."'>Editar</a></td>";
							$tag .= "</tr>"; 		
						}
						
						return $tag;
					}else{
						return "<tr><td colspan='2' align='center'>Nenhuma operadora encontrada!</td></tr>";
					}
				}else{
					return "<tr><td colspan='2' align='center'>Erro ao tentar pesquisar!</td></tr>";
				}				
			}else{
				return "<tr><td colspan='2' align='center'>Favor digitar uma informação válida!</td></tr>";
			}		
		}
		
		function retornaOperadora($id){
			$conn = $this->conecta();
			$sql = "SELECT id_operadora, operadora FROM operadoras WHERE id_operadora = ".$id;
			$tag = "";
			if($rs = $conn->query($sql)){
				$ln = $rs->fetchAll();
				$tag .= "<option value='".$ln[0]['id_operadora']."'>".$ln[0]['operadora']."</option>";
				$tag .= "<option value=''> --------------- </option>";
				$sql = "SELECT id_operadora, operadora FROM operadoras WHERE id_operadora <> ".$id;
				$rs = $conn->query($sql);
				while($ln = $rs->fetch(PDO::FETCH_ASSOC)){
					$tag .= "<option value='".$ln['id_operadora']."'>".$ln['operadora']."</option>";
				}
				return $tag;	
			}else{
				return "";
			}
		}
		
		function retornaOperadora2($id, $tipo){
			$conn = $this->conecta();
			switch($tipo){
				case 'telefone':
					$tipo = 1;
					break;
				case 'contrato':
					$tipo = 2;
					break;
			}
			$sql = "SELECT id_operadora, operadora FROM operadoras WHERE tipo = ".$tipo." AND id_operadora = ".$id;
			$tag = "";
			if($rs = $conn->query($sql)){
				$ln = $rs->fetchAll();
				$tag .= "<option value='".$ln[0]['id_operadora']."'>".$ln[0]['operadora']."</option>";
				$tag .= "<option value=''> --------------- </option>";
				$sql = "SELECT id_operadora, operadora FROM operadoras WHERE tipo = ".$tipo." AND id_operadora <> ".$id;
				$rs = $conn->query($sql);
				while($ln = $rs->fetch(PDO::FETCH_ASSOC)){
					$tag .= "<option value='".$ln['id_operadora']."'>".$ln['operadora']."</option>";
				}
				return $tag;	
			}else{
				return "";
			}
		}
				
		function retornaOperadoras($tipo){
			switch($tipo){
				case 'telefone':
					$tipo = 1;
					break;
				case 'contrato':
					$tipo = 2;
					break;
			}
			$conn = $this->conecta();
			$sql = "SELECT * FROM operadoras WHERE tipo = ".$tipo." ORDER BY operadora";
			if($rs = $conn->query($sql)){
				return $rs;
			}else{
				return "Erro ao retornar operadoras!";
			}
		}
		
		function relatorioOperadoras($page){
			$p_page = $page;
			$conn = $this->conecta();
			$mes = date('m');
			$ano = date('Y');
			$sql = "SELECT operadora FROM operadoras";
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
				$sql = "SELECT operadora FROM operadoras LIMIT ".$page.", ".$pageA."";
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
									<td>".$ln['operadora']."</td>
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
										$tag .= "<li><a href='index.php?page=relatorioOperadoras&pg=".$i."'>".$i."</a></li>";	
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