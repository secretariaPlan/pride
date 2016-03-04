<?php  class CursoPosgrado_Model extends ActiveRecord\Model { 
	
	public static $connection = "sicpa";
	static $table_name = "curso_posgrado"; 

	public function buscarCursosPorIdProfesor($id){

		$CIPeriodo =& get_instance();
		$CIPeriodo->load->model('pride/periodo_model');
		
		$CISemestre =& get_instance();
		$CISemestre->load->model('sicpa/semestre_model');

		$fechas = $CIPeriodo->periodo_model->periodoBusqueda();
		$inicioPerBusqueda = date("Y",strtotime($fechas["inicioPeriodoBusqueda"]));
		$finPerBusqueda = date("Y",strtotime($fechas["finPeriodoBusqueda"]));
		
		$semestreIds = $CISemestre->semestre_model->semestresEvaluacion();
		
		$cadenaBusquedaYear = "year LIKE '%$inicioPerBusqueda%'";
		$inicioPerBusqueda++;

		for ($i = $inicioPerBusqueda; $i <= $finPerBusqueda ; $i++) { 
			$cadenaBusquedaYear .= "AND year LIKE '%$i%' ";
		}

		$condicion = array("select"=> 'cursoid, horas, semestreotro',
							"conditions" => array("profesorid = ? AND ($cadenaBusquedaYear OR semestreid in (?))",$id,$semestreIds));
		
		$cursos = CursoPosgrado_Model::find("all",$condicion);
		
		$numGrupos = 0;
		$horasTotales = 0;

		foreach ($cursos as $curso) {
			$numGrupos ++;
			$horasTotales += $curso->horas;
		}
		
		$respuesta = array('numGrupos' => $numGrupos, 
							'horasTotales' => $horasTotales);
		
		return $respuesta;
	}

} ?>
