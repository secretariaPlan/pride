<?php  
class ComisionEvaluadora_Model extends ActiveRecord\Model {

	public static $connection = "sicpa"; 
	static $table_name = "comision_evaluadora"; 

	public function buscaComisionEvaluadoraPorIdProfesor($id){

		$CI =& get_instance();
		$CI->load->model('pride/periodo_model');
		$fechas = $CI->periodo_model->periodoBusqueda();
		$inicioPerBusqueda = $fechas["inicioPeriodoBusqueda"];
		$finPerBusqueda = $fechas["finPeriodoBusqueda"];

		$respuesta = array();
		$condicion = array("select" => 'comisionId,comisionevalauxid,comisionevalotro,inicio,concluido',
							"conditions" => array("profesorid = ? AND DATE(inicio) BETWEEN '$inicioPerBusqueda' AND '$finPerBusqueda'",$id));
	

		$comisiones = ComisionEvaluadora_Model::find("all",$condicion);

		$juradoCalificador = 0;
		$comisionDictaminadora = 0;
		$comisionPride = 0;

		print_r($comisiones);die();	
	}
}
?>
 