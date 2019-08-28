<?php

	include("./req/Espectador.php");
	include("./req/DB.php");
	include('./req/Usuario.php');

	//iniciar a session
	session_start();

	//verificar se a session usuario existe
	if($_SESSION['usuario']){

		//usuario existe. recuperando usuario
		$u = unserialize($_SESSION['usuario']);

		//ler as mensagens 
		$mensagens = $u->lerMensagens();

		//echo '<pre>';
		//var_dump($mensagens);
		//die();
		//echo '<pre>';

	}
	else {
		
	}

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="refresh" content="5">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<style>
		body {
			padding: 20px;
		}

		.msg {
			margin-bottom: 20px;
		}

		.propria{
			display: flex;
			flex-direction: row-reverse;
		}
		.alheia>div{
			background-color: #eeeeee;
		}

		.propria>div{
			background-color: #4db6ac;
			color: #FFF;
		}

		.msg>div{
			width: 60%;
			border-radius: 10px;
			padding: 10px;
			position: relative;
		}

		.msg .hora{
			position: absolute;
			right: 10px;
			top: 10px;
		}

		.msg .texto{
			margin-top: 10px;
			font-size: 1.2rem;
		}
	</style>
</head>
<body>

	<?php foreach ($mensagens as $m):?>
	<div class="msg <?= ($m['email'] == $u->getEmail() ) ? 'propria' : 'alheia'; ?>">
		<div>
			<div class="email"><?= $m['email']?></div>
			<div class="hora"><?= date("h:i", strtotime($m['hora'])) ?></div> <!-- srttotime - transforma em segundo pra fazer o calculo -->
			<div class="texto"><?= utf8_encode($m['texto'])?></div>
		</div>
	</div>
	<?php endforeach; ?>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script>
		window.addEventListener(
			'load',
			function(){
				setTimeout(() => {
					window.scrollTo(0,document.body.scrollHeight);
				}, 0); 
			}
		)
	</script>
</body>
</html>