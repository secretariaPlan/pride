<?php

class Usuario extends ActiveRecord\Model{
	
	static $table_name = "usuario";

	function nuevoUsuario($rfc,$nombre,$apaterno,$amaterno,$pass,$email) {
		
		$usuario = new Usuario();
		
		$usuario->rfc = $rfc;
		$usuario->nombre = $nombre;
		$usuario->apaterno = $apaterno;
		$usuario->amaterno = $amaterno;
		$usuario->password = md5($pass);
		$usuario->correo = $email;
		
		$usuario->save();
		
	}
	
	
	
	
	
	
	
	
	
	
}

?>