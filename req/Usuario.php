<?php

    include ('DB.php');
    include ('Espectador.php');

    class Usuario extends Espectador{

        public function __construct(){
            $this->logado = false;
            $this->nivel = 2;
        }

        public function enviarMensagem($texto){
            //criando conexao com o banco de dados
            $db =new DB();
            
            //construindo string de consulta
            $sql = "INSERT INTO mensagens (id_usuario,hora,texto) VALUES (:id_usuario,NOW(),:texto)";

            //preparar consulta
            $insert  = $db->prepare($sql);
            //executar consulta
            $insert->execute(
                [
                    ':id_usuario'=>$this->getId(),
                    ':texto' => $texto 
                ]
            );
        }
    }

    $u = new Usuario();
    $u->logar('user@user','user');
    $u->enviarMensagem('Alooooo');
?>