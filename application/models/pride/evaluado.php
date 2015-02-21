<?php

class Evaluado extends ActiveRecord\Model{
	
	static $table_name = "evaluado";
	
	function nuevoEvaluado($idUsuario,$idPeriodo,$idComision) {
		
		$evaluado = new Evaluado();
		
		$evaluado->id_usuario = $idUsuario;
		$evaluado->id_periodo = $idPeriodo;
		$evaluado->id_comision = $idComision;
		
		$evaluado->save();
	}
	
}

?>