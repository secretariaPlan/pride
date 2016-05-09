<?php 
	class Archivo_Model extends ActiveRecord\Model{

		static $table_name = "archivo";

		function nuevoArchivo($idEvaluado,$idSeccion,$nombre,$nombreOriginal){

			$archivo = new Archivo_Model();
				$archivo->id_evaluado = $idEvaluado;
				$archivo->id_seccion = $idSeccion;				
				$archivo->nombre = $nombre;
				$archivo->nombre_original = $nombreOriginal;
				
			if($archivo->save())
				return (array("exito" => 1,
								"mensaje" => "Archivo agregado"));
			else
				return (array("exito" => 0,
								"mensaje" => "Error"));							
		}

		function buscaArchivosEvaluado($idEvaluado,$idSeccion){

			$condicion = array("select" => "nombre,nombre_original",
								"conditions" => array("id_evaluado = ? AND id_seccion = ?",$idEvaluado,$idSeccion));

			$archivos = Archivo_Model::find("all",$condicion);
			
			return $archivos;					
		}
	}
?>