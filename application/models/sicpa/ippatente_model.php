<?php
class IPPatente_Model extends ActiveRecord\Model{

	public static $connection = "sicpa";
	static $table_name = "i_p_patente";

	public function buscaPatentePorIdProfesor($id){

		$CI =& get_instance();
		$CI->load->model('pride/periodo_model');
		$fechas = $CI->periodo_model->periodoBusqueda();
		$inicioPerBusqueda = date("Y",strtotime($fechas["inicioPeriodoBusqueda"]));
		$finPerBusqueda = date("Y",strtotime($fechas["finPeriodoBusqueda"]));

		$condicion = array("select"=> 'id, publicaciontipo, year',
							"conditions" => array("profesorid = ? AND year >= ? AND year <= ?",$id,$inicioPerBusqueda,$finPerBusqueda));
	
		$registros = IPPatente_Model::find("all",$condicion);

		return sizeof($registros);
	}
}
?>