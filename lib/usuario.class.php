<?php
	require_once("conexao.class.php");
	class Usuario extends Conexao{
		function login($usuario, $senha){
			$conn = $this->conecta();
			$usuario = trim($usuario);
			$senha = trim($senha);
			$senha = md5($senha);
			$sql = "SELECT id_usuario, permissao FROM usuarios WHERE usuario = '".$usuario."' AND senha = '".$senha."'";
			if($rs = $conn->query($sql)){
				if($rs->rowCount() > 0 && $rs->rowCount() < 2){
					@session_start();
					$ln = $rs->fetchAll();
					$_SESSION['s_contas_id_usuario'] =  $ln[0]['id_usuario'];
					$_SESSION['s_contas_permissao'] = $ln[0]['permissao'];
					$_SESSION['sv_sys'] = md5('SysContas');
					return header("Location: index.php");
				}else{
					return "<div class='alert alert-danger'>Usuário e/ou Senha incorretos!</div>";
				}
			}else{
				return "<div class='alert alert-danger'>Erro ao executar SQL!</div>";
			}


		}

		function verificaLogin($id){
			if(!isset($id) || $id == ''){
					return header("Location: index.php");				
			}else{
				return header("location: index.php");
			}
		}

		function logout(){
			@session_destroy();
			echo '<meta http-equiv="refresh" content=0;url="index.php">';
		}
		
		function retornaInformacaoUsuario($id, $campo){
			$conn = $this->conecta();

			$id = trim ($id);
			$sql = "SELECT * FROM usuarios WHERE id_usuario =".$id;
			if($rs = $conn->query($sql)){
				if($rs->rowCount() > 0 && $rs->rowCount() < 2){
					$ln = $rs->fetchAll();
					return $ln[0][$campo];
				}else{
					return "Erro no usuário!";
				}
			}else{
				return "Erro ao tentar buscar informação!";
			}		
		}
		
		public function cadastraUsuario($usuario, $senha, $conf_senha, $permissao){
			$usuario = trim($usuario);
			$senha = trim($senha);
			$conf_senha = trim($conf_senha);
			if(!empty($usuario) && !empty($senha) && !empty($conf_senha)){
				if($senha === $conf_senha){
					$conn = $this->conecta();
					$sql = "SELECT * FROM usuarios WHERE usuario = '".$usuario."'";
					$rs = $conn->query($sql);
					if($rs->rowCount() > 0){
						return "<div class='alert alert-danger'>Usuário já cadastrado!</div>";
					}else{
						$sql = "INSERT INTO usuarios (usuario, senha, status, permissao) VALUES ('".$usuario."', '".md5($senha)."', true, '$permissao')";
						if($conn->query($sql)){
							return "<div class='alert alert-success'>Usuário cadastrado com sucesso!</div>";
						}else{
							return "<div class='alert alert-danger'>Erro ao tentar gravar no sistema!</div>";
						}
					}
				}else{
					return "<div class='alert alert-danger'>As senhas não coincidem!</div>";
				}
			}else{
				return "<div class='alert alert-danger'>Favor preencher os campos corretamente!</div>";
			}
		}

		function atualizaUsuario($id, $senha){
			$senha = md5($senha);
			
			$sql = "UPDATE usuarios SET senha = '$senha' WHERE id_usuario = ".$id;
			
			$conn = $this->conecta();
			
			if($rs = $conn->query($sql)){
				return "<div class='alert alert-success'>Dados Atualizados!</div>";
			}else{
				return "<div class='alert alert-danger'>Erro ao tentar atualizar!</div>";
			}
		}
	}
?>