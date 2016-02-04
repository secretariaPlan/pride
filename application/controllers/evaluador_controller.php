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
	
	function sesionActivaEvaluador(){
		if ($this->session->userdata("idUsuario") && $this->session->userdata("tipo") == 2) {
			return true;
		}else{
			return false;
		}
	}
	
	function vistaListaEvaluados(){
		$this->load->model('pride/usuario_model');
		$this->load->model('pride/evaluado_model');
		$this->load->model('pride/evaluadorevaluado');
		$respuesta = array();
		$idEvaluador = $this->session->all_userdata()[0]["idEvaluador"];
		//print_r($idEvaluador);
		
		$condicion = array("conditions" => array("id_evaluador = ?",$idEvaluador));
		$evaluadoEvaluador = EvaluadorEvaluado::all($condicion);
		
		if(sizeof($evaluadoEvaluador)){
			$respuesta["respuesta"] = array("exito" =>1);
			foreach ($evaluadoEvaluador as $eval) {
				$evaluado = Evaluado_Model::find($eval->id_evaluado);
				$usuario = Usuario_Model::find($evaluado->id_usuario);
				$respuesta["datos"][] = array("id_usuario" => $usuario->id,
						"rfc" => $usuario->rfc,
						"id_evaluado" => $evaluado->id,
						"nombre" => "$usuario->nombre $usuario->apaterno $usuario->amaterno"
				);
			}
		}else
			$respuesta["respuesta"] = array("exito" =>0);
		
		$this->load->view("header");
		$this->load->view("evaluador/listaEvaluados",$respuesta);
		$this->load->view("footer");
	}
	
	function nuevoEvaluador($idUsuario,$idPeriodo,$idComision){
		
		$this->evaluador_model->nuevoEvaluador($idUsuario,$idPeriodo,$idComision);
	}
	
	function evaluadoresDelPeriodo(){
		$this->load->model("pride/periodo_model");
		$this->load->model("pride/usuario_model");
		
		$periodo = Periodo_Model::last();
		
		$condiciones = array("conditions" => array("id_periodo = ?",$periodo->id));
		$evaluadores = Evaluador_Model::all($condiciones);
		
		if (sizeof($evaluadores)){
			$respuesta["exito"] = 1;
			foreach ($evaluadores as $evaluador) {
				$usuario = Usuario_Model::first($evaluador->id_usuario);
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
		$this->load->model('pride/usuario_model');
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
				$usuario = Usuario_Model::find($evaluado->id_usuario);
				$respuesta["datos"][] = array("id_usuario" => $usuario->id,
						"id_evaluado" => $evaluado->id,
						"nombre" => "$usuario->nombre $usuario->apaterno $usuario->amaterno"
				);
			}
		}else
			$respuesta["respuesta"] = array("exito" =>0);
	
		echo json_encode($respuesta);
	}

	function pruebaSicpa(){
		$this->load->model('sicpa/servsocialalumno_model');
		
		$id = $this->input->post("id");
		
		print_r($this->servsocialalumno_model->buscaAlumnosporIdProfesor($id));

	}

	function listaEvaluados(){

	}
	
	function informacionEvaluado(){
		$datosMenu = array("seccion"=>"informacion");
		$this->load->model('pride/evaluado_model');
		$this->load->view("header",$datosMenu);
		$this->load->view("evaluador/navegacion");
		$this->load->view("evaluador/informacionEvaluado");
		$this->load->view("footer");
	}
	
	function formacionTrayectoriaAcademica(){
		$datosMenu = array("seccion"=>"formacionT");
		$this->load->model('pride/evaluado_model');
		$this->load->view("header",$datosMenu);
		$this->load->view("evaluador/navegacion");
		$this->load->view("evaluador/formacionTrayectoriaAcademica");
		$this->load->view("footer");
	}
	
	function productividadAcademica(){
		$datosMenu = array("seccion"=>"productividad");
		$this->load->model('pride/evaluado_model');
		$this->load->view("header",$datosMenu);
		$this->load->view("evaluador/navegacion");
		$this->load->view("evaluador/productividadAcademica");
		$this->load->view("footer");
	}
	
	function materialDocente(){
		$datosMenu = array("seccion"=>"material");
		$this->load->model('pride/evaluado_model');
		$this->load->view("header",$datosMenu);
		$this->load->view("evaluador/navegacion");
		$this->load->view("evaluador/materialDocente");
		$this->load->view("footer");
	}
		
	function formacionRecursosHumanos(){
		$datosMenu = array("seccion"=>"formacionR");
		$this->load->model('pride/evaluado_model');
		$this->load->view("header",$datosMenu);
		$this->load->view("evaluador/navegacion");
		$this->load->view("evaluador/formacionRecursosHumanos");
		$this->load->view("footer");
	}
	
	function docencia(){
		$datosMenu = array("seccion"=>"docencia");
		$this->load->model('pride/evaluado_model');
		$this->load->view("header",$datosMenu);
		$this->load->view("evaluador/navegacion");
		$this->load->view("evaluador/docencia");
		$this->load->view("footer");
	}
	
	function difusion(){
		$datosMenu = array("seccion"=>"difusion");
		$this->load->model('pride/evaluado_model');
		$this->load->view("header",$datosMenu);
		$this->load->view("evaluador/navegacion");
		$this->load->view("evaluador/difusion");
		$this->load->view("footer");
	}
	
	function participacionInstitucional(){
		$datosMenu = array("seccion"=>"participacion");
		$this->load->model('pride/evaluado_model');
		$this->load->view("header",$datosMenu);
		$this->load->view("evaluador/navegacion");
		$this->load->view("evaluador/participacionInstitucional");
		$this->load->view("footer");
	}
	
}

?>