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
	
	function nuevoEvaluador($idUsuario,$idPeriodo,$idComision){
		
		$this->evaluador_model->nuevoEvaluador($idUsuario,$idPeriodo,$idComision);
	}
	
	function evaluadoresDelPeriodo(){
		$this->load->model("pride/periodo");
		$this->load->model("pride/usuario");
		
		$periodo = Periodo::last();
		
		$condiciones = array("conditions" => array("id_periodo = ?",$periodo->id));
		$evaluadores = Evaluador_Model::all($condiciones);
		
		if (sizeof($evaluadores)){
			$respuesta["exito"] = 1;
			foreach ($evaluadores as $evaluador) {
				$usuario = Usuario::first($evaluador->id_usuario);
				$respuesta["usuarios"][] = array("idUsuario" => $usuario->id,
						"idEvaluador" => $evaluador->id,
						"nombre" => "$usuario->nombre $usuario->apaterno $usuario->amaterno"
				);
			}
		}else $respuesta["exito"] = 0;
		
		
		echo json_encode($respuesta);
	}
	
	function desasignarEvaluadorDelPeriodo(){
		$idEvaluador = $this->input->post("idEvaluador");
		
		$this->evaluador_model->desasignarEvaluadorDelPeriodo($idEvaluador);
	}
	
	public function busquedaEvaluadorPorNombre() {
		if(isset($_GET['term'])){
			$cadena = $_GET['term'];
			$this->evaluador_model->profesoresEvaluadores($cadena);
		}
	
	}
	
	public function evaluadosAsignados() {
		$this->load->model('pride/usuario');
		$this->load->model('pride/evaluado_model');
		$this->load->model('pride/evaluadorevaluado');
		$respuesta = array();
		$idEvaluador = $this->input->post("idEvaluador");
	
		$condicion = array("conditions" => array("id_evaluador = ?",$idEvaluador));
		$evaluadoEvaluador = EvaluadorEvaluado::all($condicion);
	
		if(sizeof($evaluadoEvaluador)){
			$respuesta["respuesta"] = array("exito" =>1);
			foreach ($evaluadoEvaluador as $eval) {
				$evaluado = Evaluado_Model::find($eval->id_evaluado);
				$usuario = Usuario::find($evaluado->id_usuario);
				$respuesta["datos"][] = array("id_usuario" => $usuario->id,
						"id_evaluado" => $evaluado->id,
						"nombre" => "$usuario->nombre $usuario->apaterno $usuario->amaterno"
				);
			}
		}else
			$respuesta["respuesta"] = array("exito" =>0);
	
		echo json_encode($respuesta);
	
	
	}
}

?>