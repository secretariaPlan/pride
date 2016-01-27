<?php 

class Semestre_Model extends ActiveRecord\Model {

	public static $connection = "sicpa";  
	static $table_name = "semestre"; 

	public function semestresEvaluacion()
	{			
		$ultimoSemestre = Semestre_Model::last();
		$ultimoSemestreId = $ultimoSemestre->id;
		$limiteBusqueda = $ultimoSemestreId - 10;
		
		for ($i = $ultimoSemestreId; $i > $limiteBusqueda ; $i--) { 
			$semestreId[] = $i;
		}

		return $semestreId;
	}

} 

?>
