<?php  

class Actividad_Model extends ActiveRecord\Model { 

	public static $connection = "sicpa"; 
	static $table_name = "actividad"; 

	public function buscaActividadPorIdProfesor($id){

		$CI =& get_instance();
		$CI->load->model('pride/periodo_model');
		$fechas = $CI->periodo_model->periodoBusqueda();
		$inicioPerBusqueda = $fechas["inicioPeriodoBusqueda"];
		$finPerBusqueda = $fechas["finPeriodoBusqueda"];

		$condicion = array("select" => 'actividadid,actividadtipoid,actividadtipootro,nombre',
							"conditions" => array("profesorid = ? AND DATE(inicio) BETWEEN '$inicioPerBusqueda' AND '$finPerBusqueda'",$id));

		$registros = Actividad_Model::find("all",$condicion);

		$organizacionEventos = sizeof($registros);

		return $organizacionEventos;

	}
} 

?>
