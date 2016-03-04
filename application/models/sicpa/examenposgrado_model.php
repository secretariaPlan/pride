<?php  
	class ExamenPosgrado_Model extends ActiveRecord\Model {
		public static $connection = "sicpa"; 
		static $table_name = "examen_posgrado";

		public function buscaExamenesJuradoPorIdProfesor($id){

			$CI =& get_instance();
			$CI->load->model('pride/periodo_model');
			$fechas = $CI->periodo_model->periodoBusqueda();
			$inicioPerBusqueda = $fechas["inicioPeriodoBusqueda"];
			$finPerBusqueda = $fechas["finPeriodoBusqueda"];
			
			$condicion = array("select" => 'examenid,funcionid,nivelid,fechaexamen',
								"conditions" => array("profesorid = ? AND funcionid > ? AND DATE(fechaexamen) BETWEEN '$inicioPerBusqueda' AND '$finPerBusqueda'",$id,1));
			$registros = ExamenPosgrado_Model::find("all",$condicion);

			$licenciatura = 0;
			$especializacion = 0;
			$maestria = 0;
			$doctorado = 0;
			
			foreach ($registros as $registro) {
				if ($registro->nivelid == 3)
					$licenciatura++;
				elseif ($registro->nivelid == 5)
					$especializacion++;
				elseif ($registro->nivelid == 6)
					$maestria++;
				elseif ($registro->nivelid == 7)
					$doctorado++;
			}

			$respuesta = array(	"licenciatura" => $licenciatura,
								"especializacion" => $especializacion,
								"maestria" => $maestria,
								"doctorado" => $doctorado);

			return $respuesta;

		} 

		public function buscaExamenesComoSupervisorPorIdProfesor($id){

			$CI =& get_instance();
			$CI->load->model('pride/periodo_model');
			$fechas = $CI->periodo_model->periodoBusqueda();
			$inicioPerBusqueda = $fechas["inicioPeriodoBusqueda"];
			$finPerBusqueda = $fechas["finPeriodoBusqueda"];
			
			$condicion = array("select" => 'examenid,funcionid,nivelid,fechaexamen',
								"conditions" => array("profesorid = ? AND funcionid = ? AND DATE(fechaexamen) BETWEEN '$inicioPerBusqueda' AND '$finPerBusqueda'",$id,12));
			$registros = ExamenPosgrado_Model::find("all",$condicion);

			$licenciatura = 0;
			$especializacion = 0;
			$maestria = 0;
			$doctorado = 0;
			
			foreach ($registros as $registro) {
				if ($registro->nivelid == 3)
					$licenciatura++;
				elseif ($registro->nivelid == 5)
					$especializacion++;
				elseif ($registro->nivelid == 6)
					$maestria++;
				elseif ($registro->nivelid == 7)
					$doctorado++;
			}

			$respuesta = array(	"licenciatura" => $licenciatura,
								"especializacion" => $especializacion,
								"maestria" => $maestria,
								"doctorado" => $doctorado);

			return $respuesta;

		} 
	} 
?>
