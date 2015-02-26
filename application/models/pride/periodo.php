<?php
class Periodo extends ActiveRecord\Model {
	static $table_name = "periodo";
	
	
		public function nuevoPeriodo($cYear,$cPeriodo) {
		
			$periodo = new Periodo();
			
			$periodo->year = $cYear;
			$periodo->periodo = $cPeriodo;
			//$valor = $cPeriodo."-".$cYear;
			$periodo->save();
		
			//return $periodo;
		}
}

?>