<?php  

class carreraEspecializ_Model extends ActiveRecord\Model {

	public static $connection = "sicpa"; 
	static $table_name = "carrera_especializ";

	function existeId($id){

		$condicion = array("conditions" => array("carreraid = ?",$id) );
		$registro = carreraEspecializ_Model::all($condicion);
		
		if(sizeof($registro)) return true;
		else return false;

	} 

} 

?>
