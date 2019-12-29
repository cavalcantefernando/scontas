<?php
	require_once("conexao.class.php");
	class Filial extends Conexao{
		function retornaInformacaoFilial($id, $campo){
			$conn = $this->conecta();
			$sql = "SELECT $campo FROM filiais WHERE id_filial = ".$id;
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
		
		function retornaFilial($id){
			$conn = $this->conecta();
			$sql = "SELECT id_filial, filial FROM filiais WHERE id_filial = ".$id;
			$tag = "";
			if($rs = $conn->query($sql)){
				$ln = $rs->fetchAll();
				$tag .= "<option value='".$ln[0]['id_filial']."'>".$ln[0]['filial']."</option>";
				$tag .= "<option value=''> --------------- </option>";
				$sql = "SELECT id_filial, filial FROM filiais WHERE id_filial <> ".$id;
				$rs = $conn->query($sql);
				while($ln = $rs->fetch(PDO::FETCH_ASSOC)){
					$tag .= "<option value='".$ln['id_filial']."'>".$ln['filial']."</option>";
				}
				return $tag;	
			}else{
				return "";
			}
		}
		
		function retornaFiliais(){
			$conn = $this->conecta();
			$sql = "SELECT * FROM filiais ORDER BY cod_filial";
			if($rs = $conn->query($sql)){
				return $rs;
			}else{
				return "Erro ao retornar operadoras!";
			}
		}
	}
?>