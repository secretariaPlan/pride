<?php

class Administrador extends ActiveRecord\Model {
	
	static $table_name = "administrador";
	
	public function loginAdmin($rfc,$pass) {
		$admin = Administrador::first(array("conditions" => array("rfc = ? AND password = ?",$rfc,$pass) ));
		if(isset($admin))return true;
		else return false;
	}
	
	function datosAdmin($rfc,$pass) {
		$admin = Administrador::first(array("conditions" => array("rfc = ? AND password = ?",$rfc,$pass) ));
		$datos = array("idAdministrador"=>$admin->id,
						"rfc"=>$admin->rfc,
						"tipo"=>1
		);
		
		return $datos;
	}
	
	
}

?>