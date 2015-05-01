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
	
	
	public function profesoresEvaluados($cadena){
		//$join = 'inner join evaluador e on (usuario.id=e.id_usuario)';
		$evaluados = Evaluado::find_by_sql("SELECT * FROM usuario u inner join evaluado e on u.id=e.id_usuario where e.id_periodo=(select max(id) from periodo) AND (CONCAT_WS('', u.nombre, u.apaterno, u.amaterno ) LIKE  '%$cadena%' OR u.rfc LIKE '%$cadena%')");
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
	public function evaluadoSinEvaluador(){
		$evaluados = Evaluado::find_by_sql("select u.id, u.rfc, concat(u.nombre,' ',u.apaterno,' ',u.amaterno) as evaluado from usuario u where u.id in(select e.id_usuario from evaluado e left join evaluador b on e.id_usuario=b.id_usuario where b.id_usuario is null);");
	
	
		$arreglo = array();
		foreach ($evaluados as $evaluado) {
			$arreglo[] = array("id" => "$evaluado->id",
					"rfc" => "$evaluado->rfc",
					"evaluado" => "$evaluado->evaluado",
			);
		}
		echo json_encode($arreglo);
	
	
	}

}

?>