<?php

class Usuario_Model extends ActiveRecord\Model{
	
	static $table_name = "usuario";
	
	public function nuevoUsuario($rfc,$nombre,$apaterno,$amaterno,$pass,$email) {
		
		$usuario = new Usuario_Model();
		
		$usuario->rfc = $rfc;
		$usuario->nombre = $nombre;
		$usuario->apaterno = $apaterno;
		$usuario->amaterno = $amaterno;
		$usuario->password = md5($pass);
		$usuario->correo = $email;
		
		$usuario->save();
		
		return $usuario->id;
		
	}
		
	public function agregar()
	{

		$post=new Usuario_Model;	
		$post->rfc=$_POST['rfc'];
		$post->nombre=$_POST['nombre'];
		$post->apaterno=$_POST['apaterno'];
		$post->amaterno=$_POST['amaterno'];
		$post->correo=$_POST['correo'];
		$post->password=md5($_POST['password']);

		$post->save();
	}

	public function encuentraUsuarioPorId($idUsuario){

		$usuario = Usuario_Model::find($idUsuario);
		return $usuario;
	}
	
	public function listaUsuarios() {
		$usuarios = Usuario_Model::all();
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
		$condicion = array("conditions" => array("rfc LIKE '%$cadena%' OR CONCAT( nombre, apaterno, amaterno) LIKE '%$cadena%' "));
		$usuarios = Usuario_Model::all($condicion);
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
		$usuario = Usuario_Model::first(1);
	
	foreach (Usuario_Model::find("correo='gabrieldelabarrera@gmail.com'") as $usuario) {
        echo"Usuario encontrado";

	}
	
	}	
	
	public function recoverPass($email,$reemail) {
		$user = Usuario_Model::first(array("conditions" => array("correo = ? AND correo = ?",$email,$reemail) ));
		if(isset($user))return true;
		else return false;
	}
	
	
public function UsuarioNoEvaluador(){
		//$join = 'inner join evaluador e on (usuario.id=e.id_usuario)';
		$usuarios = Usuario_Model::find_by_sql("select u.id id_usuario, rfc, nombre, apaterno, amaterno from usuario u left join evaluador e on u.id=e.id_usuario where e.id_usuario is null");
		//$evaluadores = Usuario_Model::all(array('joins' => $join));
	
	
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
	
	
	
	
	public function UsuariosEvaluadoresDelPeriodo(){
		//$join = 'inner join evaluador e on (usuario.id=e.id_usuario)';
		$usuarios = Usuario_Model::find_by_sql("SELECT e.id_usuario, e.id_periodo, e.id_comision, u.rfc, CONCAT( u.nombre,  ' ', u.apaterno,  ' ', u.amaterno ) AS Usuario
FROM usuario u
INNER JOIN evaluador e ON u.id = e.id_usuario
WHERE e.id_periodo = ( 
SELECT MAX( id ) 
FROM periodo )");
		//$evaluadores = Usuario_Model::all(array('joins' => $join));
	
	
		$arreglo = array();
		foreach ($usuarios as $usuario) {
			$arreglo[] = array("id_usuario" => "$usuario->id_usuario",
					"id_periodo" => "$usuario->id_periodo",
					"id_comision" => "$usuario->id_comision",
					"rfc" => "$usuario->rfc",
					"Usuario" => "$usuario->Usuario_Evaluador",
			);
		}
		echo json_encode($arreglo);
	
	
	}

	function cambiarPassword($idUsuario,$password){
		$usuario = Usuario_Model::find($idUsuario);
		$usuario->password =md5($password);
		if($usuario->save())
			$datos["exito"] = 1;
		else
			$datos["exito"] = 0;

		echo json_encode($datos);
	}
	
	
}

?>