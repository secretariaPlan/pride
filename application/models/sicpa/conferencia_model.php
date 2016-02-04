<?php  

class Conferencia_Model extends ActiveRecord\Model { 

	public static $connection = "sicpa";
	static $table_name = "conferencia";

	public function buscarConferenciaPorIdProfesor($id){

		$CI =& get_instance();
		$CI->load->model('pride/periodo_model');
		$fechas = $CI->periodo_model->periodoBusqueda();
		$inicioPerBusqueda = $fechas["inicioPeriodoBusqueda"];
		$finPerBusqueda = $fechas["finPeriodoBusqueda"];

		$respuesta = array();
		$condicion = array("conditions" => array("profesorid = ? AND DATE(fecha) BETWEEN '$inicioPerBusqueda' AND '$finPerBusqueda'",$id));
		$registros = Conferencia_Model::find("all",$condicion);
		
		return sizeof($registros);
	} 
} 

?>
