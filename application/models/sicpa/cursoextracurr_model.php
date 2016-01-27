<?php  

class CursoExtracurr_Model extends ActiveRecord\Model { 
	
	public static $connection = "sicpa";
	static $table_name = "curso_extracurr";

	public function buscaCursoExtraCurrPoridProfesor($id){

		$CI =& get_instance();
		$CI->load->model('pride/periodo_model');
		$fechas = $CI->periodo_model->periodoBusqueda();
		$inicioPerBusqueda = $fechas["inicioPeriodoBusqueda"];
		$finPerBusqueda = $fechas["finPeriodoBusqueda"];

		$condicion = array("select"=> '	cursoextracurrid, nombre, horas',
							"conditions" => array("profesorid = ?  AND DATE(inicio) BETWEEN '$inicioPerBusqueda' AND '$finPerBusqueda'",$id));

		$cursosExtracurriculares = CursoExtracurr_Model::find("all",$condicion);

		$numeroCursos = sizeof($cursosExtracurriculares);

		return $numeroCursos;
	} 
}

?>
