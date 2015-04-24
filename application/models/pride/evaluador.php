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
	
	
	public function profeEvaluador(){
		//$join = 'inner join evaluador e on (usuario.id=e.id_usuario)';
		$evaluadores = Evaluador::find_by_sql('SELECT * FROM usuario u inner join evaluador e on u.id=e.id_usuario where e.id_periodo=(select max(id) from periodo);');
		//$evaluadores = Usuario::all(array('joins' => $join));
	
	
		$arreglo = array();
		foreach ($evaluadores as $evaluador) {
			$arreglo[] = array("id_usuario" => "$evaluador->id_usuario",
					"rfc" => "$evaluador->rfc",
					"nombre" => "$evaluador->nombre",
					"apaterno" => "$evaluador->apaterno",
					"amaterno" => "$evaluador->amaterno",
					"id_periodo" => "$evaluador->id_periodo"
			);
		}
		echo json_encode($arreglo);
	
	
	}
	
	
}

?>