<?php

class Evaluador_Controller extends CI_Controller {
	
	public function  __construct()
	{
		parent::__construct();
		$this->load->model('pride/evaluador_model');
	
	}
	function index() {
		$this->load->view("header");
		$this->load->view("evaluador");
	}
	
	function nuevoEvaluador(){
		
		$idUsuario = $this->input->post("idUsuario");
		$idPeriodo = $this->input->post("idPeriodo");
		$idComision = $this->input->post("idComision");
		
		$this->evaluador_model->nuevoEvaluador($idUsuario,$idPeriodo,$idComision);
	}
	
	function evaluadoresDelPeriodo(){
		$this->load->model("pride/periodo");
		$this->load->model("pride/usuario");
		
		$periodo = Periodo::last();
		
		$condiciones = array("conditions" => array("id_periodo = ?",$periodo->id));
		$evaluadores = Evaluador_Model::all($condiciones);
		
		foreach ($evaluadores as $evaluador) {
			$usuario = Usuario::first($evaluador->id_usuario);
			$respuesta["usuarios"][] = array("idUsuario" => $usuario->id,
											"idEvaluador" => $evaluador->id,
											"nombre" => "$usuario->nombre $usuario->apaterno $usuario->amaterno"
			);
		}
		echo json_encode($respuesta);
	}
}

?>