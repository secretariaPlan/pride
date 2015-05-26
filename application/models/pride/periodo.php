<?php
class Periodo extends ActiveRecord\Model {
	static $table_name = "periodo";
	
		public function nuevoPeriodo($year,$numero,$inicioPeriodo,$finPeriodo,$inicioEvaluacion,$finEvaluacion,$inicioEntrega,$finEntrega) {
		
			$periodo = new Periodo();
			
			$periodo->year = $year;
			$periodo->numero = $numero;
			$periodo->inicioper = $inicioPeriodo;
			$periodo->finper = $finPeriodo;
			$periodo->inicioeval = $inicioEvaluacion;
			$periodo->fineval = $finEvaluacion;
			$periodo->inicioentrega = $inicioEntrega;
			$periodo->finentrega = $finEntrega;
			
			$periodo->save();
		}
		
		public function listaPeriodo(){
			$respuesta = array();
			$periodos = Periodo::all();
			foreach ($periodos as $periodo) {
				$respuesta["periodos"][] = array("id" => $periodo->id,
												   "periodo"=>"$periodo->year-$periodo->numero");
			}
			echo json_encode($respuesta);
		}
		
		
		
		public function listaSinUltimoPeriodo(){
			$respuesta = array();
			$periodos = Periodo::find_by_sql("SELECT * FROM periodo WHERE numero NOT IN (SELECT max(numero) FROM periodo)");
			foreach ($periodos as $periodo) {
				$respuesta["periodos"][] = array("id" => $periodo->id,
						"periodo"=>"$periodo->year-$periodo->numero");
			}
			echo json_encode($respuesta);
		}
		
		
		public function listaUltimoPeriodo(){
			$respuesta = array();
			$periodos = Periodo::find_by_sql("SELECT * FROM periodo ORDER BY numero DESC LIMIT 1");
			foreach ($periodos as $periodo) {
				$respuesta["periodos"][] = array("id" => $periodo->id,
						"periodo"=>"$periodo->year-$periodo->numero");
			}
			echo json_encode($respuesta);
		}
		
	
		

		function desasignarPeriodo($id){
		
			$periodo = Periodo::first("$id");
		
			$periodo->delete();
		
			$respuesta["mensaje"] = "Periodo Eliminado";
		
			echo json_encode($respuesta);
		}
		
}

?>