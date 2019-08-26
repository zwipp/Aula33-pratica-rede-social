<?php

//include("DB.php");

class Espectador {

	protected $id;
	protected $email;
	protected $logado;
	protected $nivel;

	public function __construct(){
		$this->logado = false; //valor padrao pro logado
		$this->nivel = 3;
	}

	public function logar($email,$senha){
		
		//criando conexao com o banco de dados
		$db =new DB();

		//Definir a string da consulta para chamar mais facil depois
		$sql = "SELECT id FROM usuarios where email=:email";

		//preparando a consulta
		$select = $db->prepare($sql);

		//executa a consulta
		$select->execute(
			[
				':email' => $email
			]
			);

		//leio o resultado
		$result = $select->fetch(PDO::FETCH_ASSOC);

		//se tiver algo no resultado vai retornar true, se nao false
		if($result){
			$this->logado = true;
			return true;
		}
		else {
			return false;
		}
	}


}

//$e = new Espectador();
//if($e->logar("espec@espec","espec")){
//	echo "logadin";
//}
//else {
//	echo 'sefudeu';
//}