<?php  

class FormacionAcademica_Model extends ActiveRecord\Model { 

	public static $connection = "sicpa";
	static $table_name = "formacion_academica";

	public function buscarRegistroPorIdProfesor($id){

		$CI =& get_instance();
		$CI->load->model('pride/periodo_model');
		$fechas = $CI->periodo_model->periodoBusqueda();
		$inicioPerBusqueda = $fechas["inicioPeriodoBusqueda"];
		$finPerBusqueda = $fechas["finPeriodoBusqueda"];
		
		$respuesta = array();
		$condicion = array("conditions" => array("profesorid = ? AND DATE(inicio) BETWEEN '$inicioPerBusqueda' AND '$finPerBusqueda'",$id));
		$registros = FormacionAcademica_Model::find("all",$condicion);
		
		return $registros;
	} 
}

?>
