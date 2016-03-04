<?php

use ActiveRecord\Model;
class Login extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model("pride/evaluador_model");
		$this->load->model("pride/evaluado_model");
		$this->load->model("pride/administrador");
		$this->load->model("pride/usuario_model");
		$this->load->model("pride/periodo_model");
		
	}
	
	public function index() {
		$this->load->view("header");
		$this->load->view("login");
		$this->load->view("footer");
	}
	
	public function pruebaLoginEvaluador(){
		
		$periodo = Periodo_Model::last();
		$rfc = $this->input->post("rfc");
		$pass = md5($this->input->post("pass"));
		
		$evaluador = $this->evaluador_model->loginEvaluador($rfc,$pass,$periodo->id);
		
	}
	
	public function pruebaLoginEvaluado(){
	
		$periodo = Periodo_Model::last();
		$rfc = $this->input->post("rfc");
		$pass = md5($this->input->post("pass"));
	
		$evaluado = $this->evaluado_model->loginEvaluado($rfc,$pass,$periodo->id);
	
	}

	public function ingresa() {
		$rfc = $this->input->post("rfc");
		$pass = md5($this->input->post("pass"));
		//$periodo = Periodo_Model::last();
		
		$respuestaAdmin = $this->administrador->loginAdmin($rfc,$pass);
		
		if($respuestaAdmin["exito"]){
			$this->session->set_userdata($respuestaAdmin);
			
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view("administrador/bienvenido");
			$this->load->view("footer");
		}else{
			$periodo = Periodo_Model::last();
			$respuestaEvaluador = $this->evaluador_model->loginEvaluador($rfc,$pass,$periodo->id);
			$respuestaEvaluado = $this->evaluado_model->loginEvaluado($rfc,$pass,$periodo->id);;
			
			if($respuestaEvaluador["exito"] && $respuestaEvaluado["exito"]){
				
				//Pantalla de seleccion para elegir como entrar
				echo "Evaluador y Evaluado";
			} elseif ($respuestaEvaluador["exito"]){
				$datosSesionEvaluador = array($respuestaEvaluador);
				$this->session->set_userdata($datosSesionEvaluador);

				$this->load->model('pride/usuario_model');
				$this->load->model('pride/evaluado_model');
				$this->load->model('pride/evaluadorevaluado');
				$this->load->model('sicpa/profesor_model');
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
						$profesorSicpa = $this->profesor_model->buscaProfesorPorRFC($usuario->rfc);
						$respuesta["datos"][] = array("id_usuario" => $usuario->id,
								"rfc" => $usuario->rfc,
								"idEvaluado" => $evaluado->id,
								"idSicpa" => $profesorSicpa,
								"nombre" => "$usuario->nombre $usuario->apaterno $usuario->amaterno"
						);
					}
				}else
					$respuesta["respuesta"] = array("exito" =>0);
				
				$this->load->view("header");
				$this->load->view("evaluador/listaEvaluados",$respuesta);
				$this->load->view("footer");
				
				// $this->load->view("header");
				// $this->load->view("evaluador/menuBienvenido");
				// $this->load->view("evaluador/bienvenido");
				// $this->load->view("footer"); 
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