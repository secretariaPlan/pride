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
	
	
	public function profesoresEvaluadores($cadena){
		//$join = 'inner join evaluador e on (usuario.id=e.id_usuario)';
		$evaluadores = Evaluador::find_by_sql("SELECT * FROM usuario u inner join evaluador e on u.id=e.id_usuario where e.id_periodo=(select max(id) from periodo) AND (CONCAT_WS('', u.nombre, u.apaterno, u.amaterno ) LIKE  '%$cadena%' OR u.rfc LIKE '%$cadena%')");
		//$evaluadores = Usuario::all(array('joins' => $join));
	
	
		$arreglo = array();
		foreach ($evaluadores as $evaluador) {
			$arreglo[] = array("id" => "$evaluador->id_usuario",
					"rfc" => "$evaluador->rfc",
					"nombre" => "$evaluador->nombre $evaluador->apaterno $evaluador->amaterno",
					"id_periodo" => "$evaluador->id_periodo"
			);
		}
		echo json_encode($arreglo);
	
	
	}
	
	
	public function evaluadoresAsignados(){
		//$join = 'inner join evaluador e on (usuario.id=e.id_usuario)';
		$evaluadores = Evaluador::find_by_sql("select concat(a.id) as id_evaluador, a.id_usuario, u.rfc, concat(u.nombre,' ',u.apaterno,' ',u.amaterno) as evaluador from evaluador a, usuario u where u.id=a.id_usuario and a.id in(select e.id_evaluador from evaluador_evaluado e inner join evaluador a on e.id_evaluador=a.id)");
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
	
	
}

?>