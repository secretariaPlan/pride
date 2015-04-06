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
	
	public function listaUsuarios() {
		$usuarios = Usuario::all();
		return $usuarios;
	}
	
	public function listaUsuarioNombre($cadena) {
		$condicion = array("conditions" => array("rfc LIKE '%$cadena%' OR nombre LIKE '%$cadena%' OR apaterno LIKE '%$cadena%' OR amaterno LIKE '%$cadena%'"));
		$usuarios = Usuario::all($condicion);
		return $usuarios;
	}
	
	
	public function very_correo(){
		$usuario = Usuario::first(1);
	
	foreach (Usuario::find("correo='gabrieldelabarrera@gmail.com'") as $usuario) {
        echo"Usuario encontrado";

	}
	
	}	
	
	public function recoverPass($email,$reemail) {
		$user = Usuario::first(array("conditions" => array("correo = ? AND correo = ?",$email,$reemail) ));
		if(isset($user))return true;
		else return false;
	}
	
	
	
	
	
	
	
	
	
}

?>