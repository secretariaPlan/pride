<?php 
	class MaterialDocente_Model extends ActiveRecord\Model {

		public static $connection = "sicpa"; 
		static $table_name = "material_docente";

		public function buscaMaterialDocentePorIdProfesor($id){

			$CI =& get_instance();
			$CI->load->model('pride/periodo_model');
			$fechas = $CI->periodo_model->periodoBusqueda();
			$inicioPerBusqueda = $fechas["inicioPeriodoBusqueda"];
			$finPerBusqueda = $fechas["finPeriodoBusqueda"];

			$respuesta = array();
			$condicion = array("select" => 'materialid,actividadauxid,inicio',
								"conditions" => array("profesorid = ? AND DATE(inicio) BETWEEN '$inicioPerBusqueda' AND '$finPerBusqueda'",$id));
		
			$materiales = MaterialDocente_Model::find("all",$condicion);

			$practicasLaboratorios = 0;
			$software = 0;

			foreach ($materiales as $material) {
				if($material->actividadauxid == 2) $practicasLaboratorios++;
				elseif($material->actividadauxid == 7) $software++;
			}

			$respuesta = array("practicasLaboratorio" => $practicasLaboratorio,
								"software" => $software );

			return $respuesta;
		} 
	} 
?>
 