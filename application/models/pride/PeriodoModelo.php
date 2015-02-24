<?php

class PeriodoModelo extends ActiveRecord\Model{
	
	static $table_name = "periodo";
	
	
	function nuevoPeriodo($cPeriodo) {
	
		$periodo = new PeriodoModelo();
	
		$periodo->periodo = $cPeriodo;
	
		$periodo->save();
	}
	
}

?>