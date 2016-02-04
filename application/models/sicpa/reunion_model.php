<?php 
class Reunion_Model extends ActiveRecord\Model {
	
	public static $connection = "sicpa";
	static $table_name = "reunion";

	public function buscaCongresoPorIdProfesor($id){

		$CI =& get_instance();
		$CI->load->model('pride/periodo_model');
		$fechas = $CI->periodo_model->periodoBusqueda();
		$inicioPerBusqueda = $fechas["inicioPeriodoBusqueda"];
		$finPerBusqueda = $fechas["finPeriodoBusqueda"];
		$reunionTipoId = 2;

		$respuesta = array();
		$condicion = array("select" => 'reunionid,caracter',
							"conditions" => array("profesorid = ? AND reuniontipoid = ? AND DATE(inicio) BETWEEN '$inicioPerBusqueda' AND '$finPerBusqueda'",$id,$reunionTipoId));

		$congresos = Reunion_Model::find("all",$condicion);

		$congresosNacionales = 0;
		$congresosInternacionales = 0;

		foreach ($congresos as $congreso) {
			if($congreso->caracter == 'N'){
				$congresosNacionales++;
			}elseif ($congreso->caracter == 'I') {
				$congresosInternacionales ++;
			}	
		}

		$respuesta = array("nacionales" => $congresosNacionales,
							"internacionales" => $congresosInternacionales);

		return $respuesta;
	} 

} ?>
