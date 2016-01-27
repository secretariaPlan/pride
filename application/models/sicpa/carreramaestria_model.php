<?php  

class carreraMaestria_Model extends ActiveRecord\Model {

	public static $connection = "sicpa"; 
	static $table_name = "carrera_maestria";

	function existeId($id){

		$condicion = array("conditions" => array("carreraid = ?",$id) );
		$registro = carreraMaestria_Model::all($condicion);
		
		if(sizeof($registro)) return true;
		else return false;

	} 

} 

?>
