<?php  

	class Arbitraje_Model extends ActiveRecord\Model { 
		
		public static $connection = "sicpa";
		static $table_name = "arbitraje"; 

		public function buscaArbitrajePoridProfesor($id){

		$CI =& get_instance();
		$CI->load->model('pride/periodo_model');
		$fechas = $CI->periodo_model->periodoBusqueda();
		$inicioPerBusqueda = $fechas["inicioPeriodoBusqueda"];
		$finPerBusqueda = $fechas["finPeriodoBusqueda"];

		$condicion = array("select"=> '	arbitrajeid, eventonombre, fecha',
							"conditions" => array("profesorid = ?  AND DATE(fecha) BETWEEN '$inicioPerBusqueda' AND '$finPerBusqueda'",$id));

		$arbitraje = Arbitraje_Model::find("all",$condicion);

		return sizeof($arbitraje);
	} 
	} 
?>
