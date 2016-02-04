<?php 
	class Premio_Model extends ActiveRecord\Model {

		public static $connection = "sicpa"; 
		static $table_name = "premio";

		public function buscaPremioPorIdProfesor($id){

			$CI =& get_instance();
			$CI->load->model('pride/periodo_model');
			$fechas = $CI->periodo_model->periodoBusqueda();
			$inicioPerBusqueda = $fechas["inicioPeriodoBusqueda"];
			$finPerBusqueda = $fechas["finPeriodoBusqueda"];

			$respuesta = array();
			$condicion = array("select" => 'premioid,caracter,fecha',
								"conditions" => array("profesorid = ? AND DATE(fecha) BETWEEN '$inicioPerBusqueda' AND '$finPerBusqueda'",$id));
		
			$premios = Premio_Model::find("all",$condicion);

			return sizeof($premios);
		} 
	} 
?>
 