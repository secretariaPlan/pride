<?php

class Administrador extends CI_Controller {
	
	function index() {
		$this->load->helper('url');
		$this->load->view("header");
		$this->load->view("administrador/navegacion");
		$this->load->view("administrador/asignacion");
		$this->load->view("footer");
	}
	
	function altaPeriodos() { //esta vista solo contiene el boton de AltaPeriodo
		$this->load->helper('url');
		$this->load->view("header");
		$this->load->view("administrador/navegacion");
		$this->load->view("administrador/altaPeriodos");
		$this->load->view("footer");
	}
	
	
	function contenidoPeriodo() { //esta vista contiene el contenido de altaPeriodo
		$this->load->view("administrador/contenidoPeriodo");
	}
	
	function altaProfesores() {
		$this->load->helper('url');
		$this->load->view("header");
		$this->load->view("administrador/navegacion");
		$this->load->view("administrador/altaProfesores");
		$this->load->view("footer");
	}
	
	function nuevoProfesor(){
		$this->load->helper('url');
		$this->load->view("header");
		$this->load->view("administrador/navegacion");
		$this->load->view("administrador/nuevoProfesor");
		$this->load->view("footer");
		
	}

}

?>