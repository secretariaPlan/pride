<?php

class PeriodoModelo extends ActiveRecord\Model{
	
	static $table_name = "periodo";
	
	
	function nuevoPeriodo($cPeriodo,$cNumSem) {
	
		$periodo = new PeriodoModelo();
		$valor = $cPeriodo."-".$cNumSem;
		$periodo->periodo = $valor;
		$periodo->save();
		
		
		//return $periodo;
	}
	

	
}

?>