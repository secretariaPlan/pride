<?php  
	class CursoFuera_Model extends ActiveRecord\Model { 
		
		public static $connection = "sicpa";
		static $table_name = "curso_fuera";

		public function buscaCursoFueraPorIdProfesor($id){

			$CI =& get_instance();
			$CI->load->model('pride/periodo_model');
			$fechas = $CI->periodo_model->periodoBusqueda();
			$inicioPerBusqueda = $fechas["inicioPeriodoBusqueda"];
			$finPerBusqueda = $fechas["finPeriodoBusqueda"];

			$respuesta = array();
			$condicion = array("select" => 'cursofueraid,cursotipoid,inicio,fin',
								"conditions" => array("profesorid = ? AND DATE(inicio) BETWEEN '$inicioPerBusqueda' AND '$finPerBusqueda'",$id));
			$cursoFuera = CursoFuera_Model::find("all",$condicion);

			return sizeof($cursoFuera);

		} 
	}
?>
 