<?php

include("DB.php");
include("Utils.php");

Utils::criarUsuario('adm@adm', 'adm', 1);
Utils::criarUsuario('user@user', 'user', 2);
Utils::criarUsuario('espec@espec', 'espec', 3);

?>