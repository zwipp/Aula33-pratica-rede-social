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
		$sql = "SELECT id,senha FROM usuarios where email=:email";

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
			if (password_verify($senha,$result['senha'])) { //usa o verify para comparar a senha que foi passada com a senha criptografada
				$this->setID($result['id']);
				$this->email = $email;
				$this->logado = true;
				return true;
			}
			else {
				return false;
			}

		}
		else {
			return false;
		}
	}

	public function lerMensagens(){

		//conectar com o banco de dados
		$db = new DB();

		//construir a string da consulta, como vai ser a consulta
		$sql = "SELECT m.id, u.email, m.texto, m.hora FROM mensagens m INNER JOIN usuarios u ON u.id = m.id_usuario;"; //ira pegar só os campos especificados, correlacionar as duas tabelas(usuario e mensagem)
	
		//preparendo a consulta
		$select = $db->prepare($sql);

		//executar consulta
		$select->execute();

		//ler o resultado da consulta
		$mensagens = $select->fetchAll(PDO::FETCH_ASSOC);

		//retornar as mensagens
		return $mensagens;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getId(){
		return $this->id;
	}

	public function setID($id){
		$this->id = $id;
	}
}

//$e = new Espectador();
//if($e->logar("espec@espec","espec")){
//	echo "logadin";
//}
//else {
//	echo 'sefudeu';
//}