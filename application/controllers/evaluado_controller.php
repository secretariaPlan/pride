<?php

class Evaluado_Controller extends CI_Controller {
	
	public function  __construct()
	{
		parent::__construct();
		$this->load->model('pride/evaluado_model');
	
	}
	function index() {
		$this->load->view("header");
		$this->load->view("evaluador");
	}
	
	function nuevoEvaluado(){
		
		$idUsuario = $this->input->post("idUsuario");
		$idPeriodo = $this->input->post("idPeriodo");
		$idComision = $this->input->post("idComision");
		
		$this->evaluado_model->nuevoEvaluado($idUsuario,$idPeriodo,$idComision);
	}
	
	function evaluadosDelPeriodo(){
		$this->load->model("pride/periodo");
		$this->load->model("pride/usuario");
	
		$periodo = Periodo::last();
	
		$condiciones = array("conditions" => array("id_periodo = ?",$periodo->id));
		$evaluados = Evaluado_Model::all($condiciones);
	
		foreach ($evaluados as $evaluado) {
			$usuario = Usuario::first($evaluado->id_usuario);
			$respuesta["usuarios"][] = array("idUsuario" => $usuario->id,
					"idEvaluador" => $evaluado->id,
					"nombre" => "$usuario->nombre $usuario->apaterno $usuario->amaterno"
			);
		}
		echo json_encode($respuesta);
	}
}

?>