<?php

class Periodo extends ActiveRecord\Model{
	
	static $table_name = "periodo";
	
}


	function nuevoPeriodo($cPeriodo,$cNumSem) {
		
	
				
		$periodo= new Periodo();
		
		$periodo->periodo = $cPeriodo;
		$periodo->num_sem = $cNumSem = array(
		    'uno' => '1',
		    'dos' => '2',
		);
		
		$periodo->save();
	}

?>