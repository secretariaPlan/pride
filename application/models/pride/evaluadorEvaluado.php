<?php

class EvaluadorEvaluado extends ActiveRecord\Model{
	
	static $table_name = "evaluador_evaluado";
	
	function relaciona_profesor($idEvaluador,$idEvaluado) {
	
		$evaluador_evaluado = new EvaluadorEvaluado();
	
		$evaluador_evaluado->id_evaluador = $idEvaluador;
		$evaluador_evaluado->id_evaluado = $idEvaluado;
	
		$evaluador_evaluado->save();
	}
	
	function desasignar($idEvaluador,$idEvaluado) {
	
	
		$evaluador_evaluado = evaluador_evaluado::first(array("conditions" => array("id_evaluador = ? AND id_evaluado = ?",$idEvaluador,$idEvaluado) ));
		$evaluador_evaluado->delete();
	
	
	}
	
}






?>