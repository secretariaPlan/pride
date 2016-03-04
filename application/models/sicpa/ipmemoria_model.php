<?php
class IPMemoria_Model extends ActiveRecord\Model{

	public static $connection = "sicpa";
	static $table_name = "i_p_memoria";

	public function buscaMemoriasPorIdProfesor($id){

		$CI =& get_instance();
		$CI->load->model('pride/periodo_model');
		$fechas = $CI->periodo_model->periodoBusqueda();
		$inicioPerBusqueda = date("Y",strtotime($fechas["inicioPeriodoBusqueda"]));
		$finPerBusqueda = date("Y",strtotime($fechas["finPeriodoBusqueda"]));

		$condicion = array("select"=> 'id, publicaciontipo, year',
							"conditions" => array("profesorid = ? AND year >= ? AND year <= ?",$id,$inicioPerBusqueda,$finPerBusqueda));
	
		$registros = IPMemoria_Model::find("all",$condicion);

		$nacional = 0;
		$internacional = 0;

		foreach ($registros as $registro) {
			if($registro->publicaciontipo == 'N')
				$nacional++;
			elseif($registro->publicaciontipo == 'I')
				$internacional++;	
		}

		$respuesta = array("nacional" => $nacional,
							"internacional" => $internacional );

		return $respuesta;
	}
}
?>