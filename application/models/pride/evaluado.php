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
	
	
	public function profeEvaluado(){
		//$join = 'inner join evaluador e on (usuario.id=e.id_usuario)';
		$evaluados = Evaluado::find_by_sql('SELECT * FROM usuario u inner join evaluado e on u.id=e.id_usuario where e.id_periodo=(select max(id) from periodo);');
		//$evaluadores = Usuario::all(array('joins' => $join));
	
	
		$arreglo = array();
		foreach ($evaluados as $evaluado) {
			$arreglo[] = array("id_usuario" => "$evaluado->id_usuario",
					"rfc" => "$evaluado->rfc",
					"nombre" => "$evaluado->nombre",
					"apaterno" => "$evaluado->apaterno",
					"amaterno" => "$evaluado->amaterno",
					"id_periodo" => "$evaluado->id_periodo"
			);
		}
		echo json_encode($arreglo);
	
	
	}

}

?>