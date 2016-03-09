<?php 
	class Comentario_Model extends ActiveRecord\Model{

		static $table_name = "comentario";

		function nuevoComentario($idUsuario,$idEvaluado,$idSeccion,$texto){

			$comentario = new Comentario_Model();
				$comentario->id_usuario = $idUsuario;
				$comentario->id_evaluado = $idEvaluado;
				$comentario->id_seccion = $idSeccion;
				$comentario->texto = $texto;

			if($comentario->save())
				echo json_encode(array("exito" => 1,
										"mensaje" => "Comentario agregado"));
			else
				echo json_encode(array("exito" => 0,
										"mensaje" => "Error"));		
		}

		function buscaComentarios($idEvaluado,$idSeccion){

			$CI =& get_instance();
			$CI->load->model("pride/usuario_model");

			$condicion = array("order" => "fecha desc",
								"conditions" => array("id_evaluado = ? AND id_seccion = ?",$idEvaluado,$idSeccion));
			$comentarios = Comentario_Model::find("all",$condicion);

			foreach ($comentarios as $comentario) {
				$usuario = $CI->usuario_model->encuentraUsuarioPorId($comentario->id_usuario);
				$fecha = date("d-m-Y",strtotime($comentario->fecha));
				$hora = date("h:i:s A",strtotime($comentario->fecha));

				$datos["respuesta"][] = array("id" => $comentario->id,
								"nombre" => $usuario->nombre." ".$usuario->apaterno." ".$usuario->amaterno,
								"texto" => $comentario->texto,
								"fecha" => $fecha,
								"hora" => $hora);
			}

			if(isset($datos))
				$datos["exito"] = 1;
			else
				$datos["exito"] = 0;

			echo json_encode($datos);

		}

	}

?>