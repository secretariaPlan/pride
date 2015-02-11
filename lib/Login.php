<?php
//Una clase login para valida accesos y registrar entradas
//javier Alpizar, 15 Feb 08

include_once("LoginDALC.php");


class Login
{
		
	public function LogOk($usuario,$pwd)
	{
		if (LoginDALC::UsuarioValido($usuario,$pwd))
			return true;
		else
			return false;
	}
	
}
?>