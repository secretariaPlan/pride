<?php  class CursoLicenciatura_Model extends ActiveRecord\Model { 
	
	public static $connection = "sicpa";
	static $table_name = "curso_licenciatura"; 

	public function buscarCursosPorIdProfesor($id){

		$CI =& get_instance();
		$CI->load->model('pride/periodo_model');
		$fechas = $CI->periodo_model->periodoBusqueda();
		$inicioPerBusqueda = date("Y",strtotime($fechas["inicioPeriodoBusqueda"]));
		$finPerBusqueda = date("Y",strtotime($fechas["finPeriodoBusqueda"]));

		$condicion = array("select"=> 'id, grupo, alumnos, minutos',
							"conditions" => array("profesorid = ? AND year >= ? AND year <= ?",$id,$inicioPerBusqueda,$finPerBusqueda));
		$cursos = CursoLicenciatura_Model::find("all",$condicion);
		
		$numGrupos = 0;
		$minutosTotales = 0;

		foreach ($cursos as $curso) {
			$numGrupos ++;
			$minutosTotales += $curso->minutos;
		}

		$horasTotales = $minutosTotales/60;

		$respuesta = array('numGrupos' => $numGrupos, 
							'horasTotales' => $horasTotales);
		
		return $respuesta;

		
	}

} ?>
