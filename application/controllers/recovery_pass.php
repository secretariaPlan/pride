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



	public function recuperar()
	{
	
	$usuario = Usuario::first(1);
	
	foreach (Usuario::find("correo='gabrieldelabarrera@gmail.com'") as $usuario) {
        echo"Usuario encontrado";
	}
	
	}
	

	
	
}

?>