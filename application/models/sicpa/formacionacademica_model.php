<?php  

class FormacionAcademica_Model extends ActiveRecord\Model { 

	public static $connection = "sicpa";
	static $table_name = "formacion_academica";

	public function buscaPorIdProfesor($id){

		$condicion = array("conditions" => array("profesorid = ?",$id));
		$registros = FormacionAcademica_Model::find("all",$condicion);
		
		foreach ($registros as $registro) {
			$tiempo = tiempoTranscurrido($registro->inicio);
			echo $tiempo."<br>";
		}
		die();
		//return $registros;
	} 
}

?>
