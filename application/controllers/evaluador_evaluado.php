<?php
class Evaluador_Evaluado extends CI_Controller {
	
	public function  __construct()
	{
		parent::__construct();

		$this->load->model('pride/evaluadorEvaluado');
	}

	public function index(){

		
	}
	
	public function asignaEvaluadoAEvaluador(){
	
		if($this->input->post()){
			$idEvaluador=$this->input->post("idEvaluador");
			$idEvaluado=$this->input->post("idEvaluado");
			$this->evaluadorEvaluado->relaciona_profesor($idEvaluador,$idEvaluado);
			
		}else echo "Error";
	
	}
		
	public function desasignar(){
		
		$idEvaluador=$this->input->post("idEvaluador");
		$idEvaluado=$this->input->post("idEvaluado");
		
		$this->evaluadorEvaluado->desasignar($idEvaluador,$idEvaluado);
	}
	
}

?>