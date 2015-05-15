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
			$periodos = Periodo::all();
			foreach ($periodos as $periodo) {
				echo $periodo->fineval;
			}
		}
}

?>