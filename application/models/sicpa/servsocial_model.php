<?php 
	class ServSocial_Model extends ActiveRecord\Model {

		public static $connection = "sicpa"; 
		static $table_name = "serv_social";

		public function buscaServicioSocialPorIdProfesor($id){

			$condicion = array("select" => 'id',
								"conditions" => array("profesorid = ?",$id));

			$idServSocial = ServSocial_Model::find("all",$condicion);

			$ids = array();

			foreach ($idServSocial as $id) {
				array_push($ids,$id->id);
			}

			return $ids;
		} 
	} 
?>
