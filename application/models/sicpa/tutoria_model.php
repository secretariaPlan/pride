<?php 
	class Tutoria_Model extends ActiveRecord\Model {

		public static $connection = "sicpa";  
		static $table_name = "tutoria";

		public function buscaTutoriasPorIdProfesor($id){

			$CI =& get_instance();
			$CI->load->model('pride/periodo_model');
			$fechas = $CI->periodo_model->periodoBusqueda();
			$inicioPerBusqueda = $fechas["inicioPeriodoBusqueda"];
			$finPerBusqueda = $fechas["finPeriodoBusqueda"];

			$condicion = array("select" => 'tutoriaid,progtutorauxid,progtutorotro,inicio,fin',
								"conditions" => array("profesorid = ? AND DATE(inicio) BETWEEN '$inicioPerBusqueda' AND '$finPerBusqueda'",$id));
		
			$registros = Tutoria_Model::find("all",$condicion);

			$tutoria121 = 0;
			$tutoria127 = 0;
			$tutoriaOtro = 0;

			foreach ($registros as $registro) {
				if($registro->progtutorauxid == 4)
					$tutoria121++;
				elseif($registro->progtutorauxid == 6)
					$tutoria127++;
				else
					$tutoriaOtro++;
			}

			$respuesta = array("tutoria121" => $tutoria121,
								"tutoria127" => $tutoria127,
								"tutoriaOtro" => $tutoriaOtro);

			return $respuesta;
		} 

		public function buscaTutoriasConcluidasPorIdProfesor($id){

			$CI =& get_instance();
			$CI->load->model('pride/periodo_model');
			$fechas = $CI->periodo_model->periodoBusqueda();
			$inicioPerBusqueda = $fechas["inicioPeriodoBusqueda"];
			$finPerBusqueda = $fechas["finPeriodoBusqueda"];

			$condicion = array("select" => 'tutoriaid,progtutorauxid,progtutorotro,inicio,fin',
								"conditions" => array("profesorid = ? AND nivelid = ? AND DATE(inicio) BETWEEN '$inicioPerBusqueda' AND '$finPerBusqueda'",$id,10));
		
			$registros = Tutoria_Model::find("all",$condicion);

			$concluida = 0;
			$enProceso = 0;
			
			foreach ($registros as $registro) {
				if($registro->concluido == "Si")
					$concluida++;
				elseif($registro->concluido == "No")
					$enProceso++;
				else
					$tutoriaOtro++;
			}

			$respuesta = array("concluida" => $concluida,
								"enProceso" => $enProceso);

			return $respuesta;
		} 
	} 
?>
