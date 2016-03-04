<?php 
class Profesor_Model extends ActiveRecord\Model {
 
	 public static $connection = "sicpa";
	 static $table_name = "profesor";

	 function buscaProfesorPorRFC($rfc){
	 	$condicion = array("select" => "profesorid",
	 						"conditions" => "rfc LIKE '%$rfc%'"  );
	 	$profesor = Profesor_Model::find("first",$condicion);
	 	$idProfesor = $profesor->profesorid;
	 	return $idProfesor;
	 } 

	 function informacionProfesor($id){
	 	$condicion = array("select" => "nombre, apaterno, amaterno",
	 						"conditions" => array("profesorid = ?",$id));

	 	$profesor = Profesor_Model::find("first",$condicion);

	 	$nombre = $profesor->nombre." ".$profesor->apaterno." ".$profesor->amaterno;

	 	$datos = array("nombre" => $nombre);

	 	return $datos;

	 }

} 
?>
