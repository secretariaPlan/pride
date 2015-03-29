<?php

class Recovery_pass extends CI_Controller {
	
	public function  __construct()
	{
		parent::__construct();
		$this->load->model('pride/usuario');
		
	
	}
	
	function index() {
		$this->load->view("header");
		$this->load->view("recovery_pass");
		$this->load->view("footer");
	}


	public function recuperar() {
		$email = $this->input->post("email");
		$reemail = $this->input->post("reemail");
	
		if($this->usuario->recoverPass($email,$reemail)){
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view("administrador/asignacion");
			$this->load->view("footer");
		}else{
			$error = array("error" => "Datos incorrectos");
			$this->load->view("header");
			$this->load->view("recovery_pass", $error);
			$this->load->view("footer");
		}
	
	
	
	
	
	}
	
	
}

?>