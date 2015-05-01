<?php
class Evaluador_Evaluado extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();

		$this->load->model('pride/evaluadorEvaluado');
	}

	public function index(){

		
	}
	
	public function relacionar(){
	
		if($this->input->post()){
			$idEvaluador=$this->input->post("evaluador");
			$idEvaluado=$this->input->post("evaluado");
			$this->evaluadorEvaluado->relaciona_profesor($idEvaluador,$idEvaluado);
			$mensaje=array('mensaje' => "Profesor Asignado Exitosamente");
	
		}else{
			$this->evaluadorEvaluado->relaciona_profesor($idEvaluador,$idEvaluado);
	
		}
	
	
	}
	
	public function quitar_profesor(){
	
		$this->evaluadorEvaluado->desasignar($idEvaluador,$idEvaluado);
	}
	
}

?>