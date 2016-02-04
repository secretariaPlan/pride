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

			$respuesta = array();
			$condicion = array("select" => 'titulacionid,nivelid,fechaexamen',
								"conditions" => array("profesorid = ? AND DATE(fechaexamen) BETWEEN '$inicioPerBusqueda' AND '$finPerBusqueda'",$id));
		
			$registros = Titulacion_Model::find("all",$condicion);
			print_r($registros);
			$licenciatura = 0;
			$especialidad = 0;
			$maestria = 0;
			$doctorado = 0;

			foreach ($registros as $registro) {
				if ($registro->nivelid == 3) $licenciatura++;
				elseif ($registro->nivelid == 5) $especialidad++;
				elseif ($registro->nivelid == 6) $maestria++;
				elseif ($registro->nivelid == 7) $doctorado++;
			}

			$respuesta = array("licenciatura" => $licenciatura,
			 					"especialidad" => $especialidad,
			 					"maestria" => $maestria,
			 					"doctorado" => $doctorado);

			return $respuesta;
		} 

} 
?> 