<?php
class Conexao
{
	public function conecta()
	{
		$host = "[HOST DO BANCO DE DADOS]";
		$dbname = "sistemacontas";
		$user = "root";
		$password = "[SENHA QUE DESEJAR]";
		try {
			$conn = new PDO("mysql:host=" . $host . ";dbname=" . $dbname . ";charset=UTF8", $user, $password);
			return $conn;
		} catch (Exception $e) {
			return $e;
		}
	}
}
