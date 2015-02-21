<?php

class Evaluador extends ActiveRecord\Model{
	
	static $table_name = "evaluador";
	
	function nuevoEvaluador($idUsuario,$idPeriodo,$idComision) {
	
		$evaluador = new Evaluador();
	
		$evaluador->id_usuario = $idUsuario;
		$evaluador->id_periodo = $idPeriodo;
		$evaluador->id_comision = $idComision;
	
		$evaluador->save();
	}
}

?>