<?php 
	class PubArticulo_Model extends ActiveRecord\Model {

		public static $connection = "sicpa";
		static $table_name = "pub_articulo";

		public function buscaPubArticuloPorIdProfesor($id){

			$CI =& get_instance();
			$CI->load->model('pride/periodo_model');
			$fechas = $CI->periodo_model->periodoBusqueda();
			$inicioPerBusqueda = $fechas["inicioPeriodoBusqueda"];
			$finPerBusqueda = $fechas["finPeriodoBusqueda"];

			$condicion = array("select" => "id,nombre,alcance,arbitrada",
								"conditions" => array("profesorid = ? AND DATE(fecha) BETWEEN '$inicioPerBusqueda' AND '$finPerBusqueda'",$id));
			$registros = PubArticulo_Model::find("all",$condicion);

			$arbitradaNacional = 0;
			$noArbitradaNacional = 0;
			$arbitradaInternacional = 0;
			$noArbitradaInternacional = 0;

			foreach ($registros as $registro) {
				if($registro->arbitrada == "Si"){
					if($registro->alcance == "N")
						$arbitradaNacional++;
					elseif($registro->alcance == "I")
						$arbitradaInternacional++;
				}
					
				elseif ($registro->arbitrada == "No"){
					if($registro->alcance == "N")
						$noArbitradaNacional++;
					elseif($registro->alcance == "I")
						$noArbitradaInternacional++;
				}
					
			}

			$respuesta = array("arbitradaNacional" => $arbitradaNacional,
								"noArbitradaNacional" => $noArbitradaNacional,
								"arbitradaInternacional" => $arbitradaInternacional,
								"noArbitradaInternacional" => $noArbitradaInternacional);


			return $respuesta;
		} 

	} 
?>
