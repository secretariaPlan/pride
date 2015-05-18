<?php

class Evaluador_Model extends ActiveRecord\Model{
	
	static $table_name = "evaluador";
	
	function verificarEvaluador($idUsuario,$idPeriodo,$idComision) {
		
		$condiciones = array("conditions" => array("id_usuario = ? AND id_periodo = ? AND id_comision = ?",$idUsuario,$idPeriodo,$idComision));
		$evaluador = Evaluador_Model::first($condiciones);
		
		if (!isset($evaluador)) 
			return true;
		else 
			return false;
	}
	
	function nuevoEvaluador($idUsuario,$idPeriodo,$idComision) {
	
		if($this->verificarEvaluador($idUsuario, $idPeriodo, $idComision)){
			$evaluador = new Evaluador_Model();
			
			$evaluador->id_usuario = $idUsuario;
			$evaluador->id_periodo = $idPeriodo;
			$evaluador->id_comision = $idComision;
			
			$evaluador->save();
			
			$respuesta = array("exito" => 1,
								"mensaje" => "Profesor guardado como evaluador"
			);
		}else 
			
			$respuesta = array("exito" => 0,
					"mensaje" => "Profesor anteriormente guardado como evaluador");
			
			echo json_encode($respuesta);
		
	}
	
	
	public function profesoresEvaluadores($cadena){
		//$join = 'inner join evaluador e on (usuario.id=e.id_usuario)';
		$evaluadores = Evaluador_Model::find_by_sql("SELECT u.id as id_usuario, u.rfc, CONCAT_WS(' ', u.nombre, u.apaterno, u.amaterno ) as nombre, e.id as id_evaluador
												FROM usuario u
												INNER JOIN evaluador e ON u.id = e.id_usuario
												WHERE e.id_periodo = ( 
												SELECT MAX( id ) 
												FROM periodo ) 
												AND (
												nombre LIKE  '%$cadena%'
												OR u.rfc LIKE  '%$cadena%'
												)");
		//$evaluadores = Usuario::all(array('joins' => $join));
	
		$arreglo = array();
		foreach ($evaluadores as $evaluador) {
			$arreglo[] = array("idUsuario" => $evaluador->id_usuario,
					"rfc" => $evaluador->rfc,
					"nombre" => $evaluador->nombre,
					"idEvaluador" => $evaluador->id_evaluador,
			);
		}
		echo json_encode($arreglo);
	
	
	}
	
	
	public function evaluadoresAsignados(){
		//$join = 'inner join evaluador e on (usuario.id=e.id_usuario)';
		$evaluadores = EvaluadorModel::find_by_sql("select concat(a.id) as id_evaluador, a.id_usuario, u.rfc, concat(u.nombre,' ',u.apaterno,' ',u.amaterno) as evaluador from evaluador a, usuario u where u.id=a.id_usuario and a.id in(select e.id_evaluador from evaluador_evaluado e inner join evaluador a on e.id_evaluador=a.id)");
		//$evaluadores = Usuario::all(array('joins' => $join));
	
	
		$arreglo = array();
		foreach ($evaluadores as $evaluador) {
			$arreglo[] = array("id_evaluador" => "$evaluador->id_evaluador",
					"id_usuario" => "$evaluador->id_usuario",
					"rfc" => "$evaluador->rfc",
					"evaluador" => "$evaluador->evaluador",
			);
		}
		echo json_encode($arreglo);
	
	
	}
	
	
	public function DesasignarEvaluador(){
		//$join = 'inner join evaluador e on (usuario.id=e.id_usuario)';
		$evaluadores = EvaluadorModel::find_by_sql("DELETE FROM evaluador WHERE id = '1'");
		//$evaluadores = Usuario::all(array('joins' => $join));
	}
	
	
	
	
	
	
}

?>