<?php  

class carreraLic_Model extends ActiveRecord\Model {

	public static $connection = "sicpa"; 
	static $table_name = "carrera_lic";

	function existeId($id){

		$condicion = array("conditions" => array("carreraid = ?",$id) );
		$registro = carreraLic_Model::all($condicion);
		
		if(sizeof($registro)) return true;
		else return false;

	} 

} 

?>
