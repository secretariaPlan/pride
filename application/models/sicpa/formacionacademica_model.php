<?php  

class FormacionAcademica_Model extends ActiveRecord\Model { 

	public static $connection = "sicpa";
	static $table_name = "formacion_academica";

	public function prueba(){
		$registro = FormacionAcademica_Model::first();
		return $registro;
	} 
}

?>
