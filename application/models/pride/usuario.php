<?php

class Usuario extends ActiveRecord\Model{
	
	static $table_name = "usuario";
	
	public function nuevoUsuario($rfc,$nombre,$apaterno,$amaterno,$pass,$email) {
		
		$usuario = new Usuario();
		
		$usuario->rfc = $rfc;
		$usuario->nombre = $nombre;
		$usuario->apaterno = $apaterno;
		$usuario->amaterno = $amaterno;
		$usuario->password = md5($pass);
		$usuario->correo = $email;
		
		$usuario->save();
		
	}
		
	public function agregar()
	{

		$post=new Usuario;	
		$post->rfc=$_POST['rfc'];
		$post->nombre=$_POST['nombre'];
		$post->apaterno=$_POST['apaterno'];
		$post->amaterno=$_POST['amaterno'];
		$post->correo=$_POST['correo'];
		$post->password=md5($_POST['password']);

		$post->save();
	}
	
	public function very_correo(){
		$usuario = Usuario::first(1);
	
	foreach (Usuario::find("correo='gabrieldelabarrera@gmail.com'") as $usuario) {
        echo"Usuario encontrado";

	}
	
	}	
	
	
	
	
	
	
	
	
	
}

?>