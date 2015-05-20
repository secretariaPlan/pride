<?php 

class EvaluadorEvaluado extends ActiveRecord\Model{
	
	static $table_name = "evaluador_evaluado";
	

	function verificaAsignacion($idEvaluado) {
		$condicion = array("conditions" => array("id_evaluado = ?",$idEvaluado));
		$evaluadorEvaluado = EvaluadorEvaluado::first($condicion);
		if(!isset($evaluadorEvaluado))
			return true;
		else
			return false;
	}
	
	function relaciona_profesor($idEvaluador,$idEvaluado) {
	
		if($this->verificaAsignacion($idEvaluado)){
			$evaluador_evaluado = new EvaluadorEvaluado();
			
			$evaluador_evaluado->id_evaluador = $idEvaluador;
			$evaluador_evaluado->id_evaluado = $idEvaluado;
			
			$evaluador_evaluado->save();
			
			$status = array("status" => 1,
							 "mensaje" => "Asignacion exitosa");
		} else
			
			$status = array("status" => 0,
							 "mensaje" => "Profesor anteriormente asignado");
		
		echo json_encode($status);
	}
	
	function desasignar($idEvaluador,$idEvaluado) {
	
	
		$evaluador_evaluado = EvaluadorEvaluado::first(array("conditions" => array("id_evaluador = ? AND id_evaluado = ?",$idEvaluador,$idEvaluado) ));
		if(sizeof($evaluador_evaluado)){
			$evaluador_evaluado->delete();
			$respuesta["respuesta"] = array("mensaje" => "Profesor desasignado");
		}
		
		echo json_encode($respuesta);
	
	}
	
	
}
