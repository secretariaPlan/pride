<?php 
	class NivelAux_Model extends ActiveRecord\Model {

		public static $connection = "sicpa"; 
		static $table_name = "nivel_aux";

		public function buscaNivelPorId($idnivel){

			$nivel = NivelAux_Model::find($idnivel);
			return $nivel->nombre;
		} 
	} 
?>
