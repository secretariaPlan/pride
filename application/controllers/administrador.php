<?php

class Administrador extends CI_Controller {
	
	function index() {
		$this->load->helper('url');
		$this->load->view("header");
		$this->load->view("administrador/asignacion");
	}
	
	function altaPeriodos() {
		$this->load->helper('url');
		$this->load->view("header");
		$this->load->view("administrador/altaPeriodos");
	}
	
	function altaProfesores() {
		$this->load->helper('url');
		$this->load->view("header");
		$this->load->view("administrador/altaProfesores");;
	}
}

?>