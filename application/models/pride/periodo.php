<?php

class Periodo extends ActiveRecord\Model{
	
	static $table_name = "periodo";

	
	
function nuevoPeriodo($cPeriodo,$cNumSem) {
		
		$periodo = new Periodo();
		$valor = $cPeriodo."-".$cNumSem;
		$periodo->periodo = $valor;
		$periodo->save();
	
		//return $periodo;
		}
	
}

?>