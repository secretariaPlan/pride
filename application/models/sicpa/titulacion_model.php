<?php
class Titulacion_Model extends ActiveRecord\Model { 

	public static $connection = "sicpa"; 
	static $table_name = "titulacion";

	public function buscaTitulacionPorIdProfesor($id){

			$CI =& get_instance();
			$CI->load->model('pride/periodo_model');
			$fechas = $CI->periodo_model->periodoBusqueda();
			$inicioPerBusqueda = $fechas["inicioPeriodoBusqueda"];
			$finPerBusqueda = $fechas["finPeriodoBusqueda"];

			$condicion = array("select" => 'titulacionid,nivelid,fechaexamen',
								"conditions" => array("profesorid = ? AND DATE(fechaexamen) BETWEEN '$inicioPerBusqueda' AND '$finPerBusqueda'",$id));
		
			$registros = Titulacion_Model::find("all",$condicion);
			
			$tecnico = 0;
			$bachillerato = 0;
			$licenciatura = 0;
			$diplomado = 0;
			$especializacion = 0;
			$maestria = 0;
			$doctorado = 0;
			$posdoctorado = 0;
			$licenciaturaOtras = 0;

			foreach ($registros as $registro) {
				if($registro->nivelid == 1)
					$tecnico++;
				elseif ($registro->nivelid == 2)
					$bachillerato++;
				elseif ($registro->nivelid == 3)
					$licenciatura++;
				elseif ($registro->nivelid == 4)
					$diplomado++;
				elseif ($registro->nivelid == 5)
					$especializacion++;
				elseif ($registro->nivelid == 6)
					$maestria++;
				elseif ($registro->nivelid == 7)
					$doctorado++;
				elseif ($registro->nivelid == 9)
					$licenciaturaOtras++;
				elseif ($registro->nivelid == 10)
					$posdoctorado++; 
			}

			$respuesta = array("tecnico" => $tecnico,
								"bachillerato" => $bachillerato,
								"licenciatura" => $licenciatura,
								"diplomado" => $diplomado,
								"especializacion" => $especializacion,
								"maestria" => $maestria,
								"doctorado" => $doctorado,
								"posdoctorado" => $posdoctorado,
								"licenciaturaOtras" => $licenciaturaOtras);

			return $respuesta;
		}

		public function buscaTesisSupervisorPorIdProfesor($id){

			$CI =& get_instance();
			$CI->load->model('pride/periodo_model');
			$fechas = $CI->periodo_model->periodoBusqueda();
			$inicioPerBusqueda = $fechas["inicioPeriodoBusqueda"];
			$finPerBusqueda = $fechas["finPeriodoBusqueda"];

			$condicion = array("select" => 'titulacionid,nivelid,fechaexamen',
								"conditions" => array("profesorid = ? AND nivelid = ? AND funcionid = ? AND DATE(fechaexamen) BETWEEN '$inicioPerBusqueda' AND '$finPerBusqueda'",$id,3,12));
		
			$registros = Titulacion_Model::find("all",$condicion);
						

			return sizeof($registros);
		}  

} 
?> 