<?php  

class carreraDoctorado_Model extends ActiveRecord\Model {

	public static $connection = "sicpa"; 
	static $table_name = "carrera_doctorado";

	function existeId($id){

		$condicion = array("conditions" => array("carreraid = ?",$id) );
		$registro = carreraDoctorado_Model::all($condicion);
		
		if(sizeof($registro)) return true;
		else return false;

	} 

} 

?>
