<?php  

class Cargo_Model extends ActiveRecord\Model { 
	
	public static $connection = "sicpa";
	static $table_name = "cargo";

	public function buscaCargoPorIdProfesor($id){

		$CI =& get_instance();
		$CI->load->model('pride/periodo_model');
		$fechas = $CI->periodo_model->periodoBusqueda();
		$inicioPerBusqueda = $fechas["inicioPeriodoBusqueda"];
		$finPerBusqueda = $fechas["finPeriodoBusqueda"];
		
		$respuesta = array();
		$condicion = array("select" => 'cargoid,cargoauxid,cargootro,concluido',
							"conditions" => array("profesorid = ? AND DATE(inicio) BETWEEN '$inicioPerBusqueda' AND '$finPerBusqueda'",$id));
		
		$cargos = Cargo_Model::find("all",$condicion);

		return sizeof($cargos);
	}

} 

?>
