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
		$this->load->model("pride/periodo_model");
		$this->load->model("pride/usuario_model");
	
		$periodo = Periodo_Model::last();
	
		$condiciones = array("conditions" => array("id_periodo = ?",$periodo->id));
		$evaluados = Evaluado_Model::all($condiciones);
		
		if (sizeof($evaluados)){
			$respuesta["exito"] = 1;
			foreach ($evaluados as $evaluado) {
				$usuario = Usuario_Model::first($evaluado->id_usuario);
				$respuesta["usuarios"][] = array("idUsuario" => $usuario->id,
						"idEvaluado" => $evaluado->id,
						"nombre" => "$usuario->nombre $usuario->apaterno $usuario->amaterno"
				);
			}
		}else $respuesta["exito"] = 0;
	
		
		echo json_encode($respuesta);
	}
	
	function desasignarEvaluadoDelPeriodo(){
		$idEvaluado = $this->input->post("idEvaluado");
		$this->evaluado_model->desasignarEvaluadoDelPeriodo($idEvaluado);
	}
	
	public function busquedaEvaluadoPorNombre() {
		if(isset($_GET['term'])){
			$cadena = $_GET['term'];
			$this->evaluado_model->profesoresEvaluados($cadena);
		}
	}

	public function evaluadosSinAsignar() {
		$this->load->model('pride/evaluador');
		$this->load->model('pride/periodo_model');
	
		if(isset($_GET['term'])){
			$cadena = $_GET['term'];
			$profesores = $this->usuario->funcionListaUsuarioNombre($cadena);
				
		}
	}
	
	
}

?>