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
		$arreglo = array();
		foreach ($usuarios as $usuario) {
			$arreglo[] = array("id" => "$usuario->id",
								"rfc" => "$usuario->rfc",
								"nombre" => "$usuario->nombre",
								"apaterno" => "$usuario->apaterno",
								"amaterno" => "$usuario->amaterno"
			);
		}
		echo json_encode($arreglo);
	}
	
	public function listaUsuarioNombre($cadena) {
		$condicion = array("conditions" => array("rfc LIKE '%$cadena%' OR nombre LIKE '%$cadena%' OR apaterno LIKE '%$cadena%' OR amaterno LIKE '%$cadena%'"));
		$usuarios = Usuario::all($condicion);
		//$arreglo = array();
		foreach ($usuarios as $usuario) {
			$arreglo['id'] = htmlentities(stripslashes("$usuario->id"));
			$arreglo['rfc'] = htmlentities(stripslashes("$usuario->rfc"));
			$arreglo['nombre'] = htmlentities(stripslashes("$usuario->nombre"." "."$usuario->apaterno"." "."$usuario->amaterno"));
			$datos[]=$arreglo;
			/*$arreglo[] = array("id" => "$usuario->id",
								"rfc" => "$usuario->rfc",
								"nombre" => "$usuario->nombre"." "."$usuario->apaterno"." "."$usuario->amaterno",
			);*/
		}
		
		echo json_encode($datos);
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
	
	
public function UsuarioNoEvaluador(){
		//$join = 'inner join evaluador e on (usuario.id=e.id_usuario)';
		$usuarios = Usuario::find_by_sql("select u.id id_usuario, rfc, nombre, apaterno, amaterno from usuario u left join evaluador e on u.id=e.id_usuario where e.id_usuario is null");
		//$evaluadores = Usuario::all(array('joins' => $join));
	
	
		$arreglo = array();
		foreach ($usuarios as $usuario) {
			$arreglo[] = array("id_usuario" => "$usuario->id_usuario",
					"rfc" => "$usuario->rfc",
					"nombre" => "$usuario->nombre",
					"apaterno" => "$usuario->apaterno",
					"amaterno" => "$usuario->amaterno",
			);
		}
		echo json_encode($arreglo);
	
	
	}
	
	
}

?>