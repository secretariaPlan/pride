<?php 
	class Comentario_Controller extends CI_Controller{
		
		public function  __construct(){
			parent::__construct();
			$this->load->model('pride/comentario_model');
		
		}

		function nuevoComentario(){

			$idUsuario = $this->input->post("idUsuario");
			$idEvaluado = $this->input->post("idEvaluado");
			$idSeccion = $this->input->post("idSeccion");
			$texto = $this->input->post("texto");

			//echo $texto;die();

			$this->comentario_model->nuevoComentario($idUsuario,$idEvaluado,$idSeccion,$texto);
				
		}

		function buscaComentarios(){

			$idEvaluado = $this->input->post("idEvaluado");
			$idSeccion = $this->input->post("idSeccion");

			$this->comentario_model->buscaComentarios($idEvaluado,$idSeccion);
		}
	}
?>