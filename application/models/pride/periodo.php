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
			$respuesta = [];
			$periodos = Periodo::all();
			foreach ($periodos as $periodo) {
				$respuesta["periodos"][] = array("id" => $periodo->id,
												   "periodo"=>"$periodo->year-$periodo->numero");
			}
			echo json_encode($respuesta);
		}
}

?>