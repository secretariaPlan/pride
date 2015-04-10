<?php

class Login extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model("pride/administrador");
		$this->ingresa();
		
	}
	
	public function index() {
		$this->load->view("header");
		$this->load->view("login");
		$this->load->view("footer");
	}

	public function ingresa() {
		$rfc = $this->input->post("rfc");
		$pass = md5($this->input->post("pass"));
		
		if($this->administrador->loginAdmin($rfc,$pass)){
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view("administrador/asignacion");
			$this->load->view("footer");
		}else{
			$error = array("error" => "Datos incorrectos");
			$this->load->view("header");
			$this->load->view("login",$error);
			$this->load->view("footer");
		}	
	}
	
	public function salir()
	{
		$this->load->view("header");
		$this->load->view("login");
	$this->load->view("footer");
			
	}
}

?>