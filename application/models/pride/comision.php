<?php

class Comision extends ActiveRecord\Model{
	
	static $table_name = "comision";

	public function listaComision(){
		$respuesta = array();
		$comisiones = Comision::all();
		foreach ($comisiones as $comision) {
			$respuesta["comisiones"][] = array("id" => $comision->id,
					"comision"=>"$comision->comision");
		}
		echo json_encode($respuesta);
	}
}

?>