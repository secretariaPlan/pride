<?php

use ActiveRecord\Model;
class Login extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model("pride/evaluador_model");
		$this->load->model("pride/evaluado_model");
		$this->load->model("pride/administrador");
		$this->load->model("pride/usuario");
		$this->load->model("pride/periodo");
		
	}
	
	public function index() {
		$this->load->view("header");
		$this->load->view("login");
		$this->load->view("footer");
	}
	
	public function pruebaLoginEvaluador(){
		
		$periodo = Periodo::last();
		$rfc = $this->input->post("rfc");
		$pass = md5($this->input->post("pass"));
		
		$evaluador = $this->evaluador_model->loginEvaluador($rfc,$pass,$periodo->id);
		
	}
	
	public function pruebaLoginEvaluado(){
	
		$periodo = Periodo::last();
		$rfc = $this->input->post("rfc");
		$pass = md5($this->input->post("pass"));
	
		$evaluado = $this->evaluado_model->loginEvaluado($rfc,$pass,$periodo->id);
	
	}

	public function ingresa() {
		$rfc = $this->input->post("rfc");
		$pass = md5($this->input->post("pass"));
		$periodo = Periodo::last();
		
		$respuestaAdmin = $this->administrador->loginAdmin($rfc,$pass);
		
		if($respuestaAdmin["exito"]){
			$datosSesionAdmin = array($respuestaAdmin["idAdministrador"],$respuestaAdmin["rfc"],$respuestaAdmin["tipo"]);
			$this->session->set_userdata($datosSesionAdmin);
			
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view("administrador/bienvenido");
			$this->load->view("footer");
		}else{
			
			$respuestaEvaluador = $this->evaluador_model->loginEvaluador($rfc,$pass,$periodo->id);
			$respuestaEvaluado = $this->evaluado_model->loginEvaluado($rfc,$pass,$periodo->id);;
			
			if($respuestaEvaluador["exito"] && $respuestaEvaluado["exito"]){
				
				//Pantalla de seleccion para elegir como entrar
				echo "Evaluador y Evaluado";
			} elseif ($respuestaEvaluador["exito"]){
				$datosSesionEvaluador = array($respuestaEvaluador["idUsuario"],$respuestaEvaluador["idEvaluador"],$respuestaEvaluador["tipo"]);
				$this->session->set_userdata($datosSesionEvaluador);
				$this->load->view("header");
				$this->load->view("evaluador/menuBienvenido");
				$this->load->view("evaluador/bienvenido");
				$this->load->view("footer"); 
				//Pantalla de Evaluador
				
			}elseif ($respuestaEvaluado["exito"]){
				//Pantalla de Evaluado
				echo "Evaluado";
			}
			else {
				$error = array("error" => "Datos incorrectos");
				$this->load->view("header");
				$this->load->view("login",$error);
				$this->load->view("footer");
			}
		}	
	}
}

?>