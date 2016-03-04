<?php
class IPParticipacion_Model extends ActiveRecord\Model{

	public static $connection = "sicpa";
	static $table_name = "i_p_participacion";

	public function buscaParticipacionPorIdProfesor($id){

		$CI =& get_instance();
		$CI->load->model('pride/periodo_model');
		$fechas = $CI->periodo_model->periodoBusqueda();
		$inicioPerBusqueda = date("Y",strtotime($fechas["inicioPeriodoBusqueda"]));
		$finPerBusqueda = date("Y",strtotime($fechas["finPeriodoBusqueda"]));

		$condicion = array("select"=> 'id, publicaciontipo, year',
							"conditions" => array("profesorid = ? AND year >= ? AND year <= ?",$id,$inicioPerBusqueda,$finPerBusqueda));
	
		$registros = IPParticipacion_Model::find("all",$condicion);

		return sizeof($registros);
	}
}
?>