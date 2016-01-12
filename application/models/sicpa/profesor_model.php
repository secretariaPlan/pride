<?php 
class Profesor_Model extends ActiveRecord\Model {
 
	 public static $connection = "sicpa";
	 static $table_name = "profesor";

	 function buscaProfesorPorRFC($rfc){
	 	$condicion = array("conditions" => "rfc LIKE '%$rfc%'"  );
	 	$profesor = Profesor_Model::find("first",$condicion);
	 	$idProfesor = $profesor->profesorid;
	 	return $idProfesor;
	 } 

} 
?>
