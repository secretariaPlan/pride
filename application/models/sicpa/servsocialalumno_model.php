<?php

class ServSocialAlumno_Model extends ActiveRecord\Model { 

	public static $connection = "sicpa"; 
	static $table_name = "serv_social_alumno";

	 public function buscaAlumnosporIdProfesor($id){

	 	$CIServ =& get_instance();
	 	$CIServ->load->model('sicpa/servsocial_model');
	 	$ids = $CIServ->servsocial_model->buscaServicioSocialPorIdProfesor($id);

	 	$CIPeriodo =& get_instance();
		$CIPeriodo->load->model('pride/periodo_model');
		$fechas = $CIPeriodo->periodo_model->periodoBusqueda();
		$inicioPerBusqueda = $fechas["inicioPeriodoBusqueda"];
		$finPerBusqueda = $fechas["finPeriodoBusqueda"];

		$condicion = array("select" => "servsocalumnoid,servsocialid",
							"conditions" => array("servsocialid in (?)AND DATE(inicio) BETWEEN '$inicioPerBusqueda' AND '$finPerBusqueda'",$ids));
	 
		$registros = ServSocialAlumno_Model::find("all",$condicion);

		return sizeof($registros);
	 }
} 

?>
