<?php

class Evaluador extends CI_Controller {
	
	public function  __construct()
	{
		parent::__construct();
		$this->load->model('pride/evaluador');
	
	}
	
	function index() {
		$this->load->view("header");
		$this->load->view("evaluador");
	}
	
	function nuevoEvaluador(){
		
		$idUsuario = $this->input->post("idEvaluador");
		$idPeriodo = $this->input->post("idPeriodo");
		$idComision = $this->input->post("idcomision");
		
		$this->evaluador->nuevoEvaluador($idUsuario,$idPeriodo,$idComision);
	}
}

?>