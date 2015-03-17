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
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view("header");
		$this->load->view("administrador/navegacion");
		$this->load->view("administrador/altaProfesores");
		$this->load->view("footer");
	}
	
	public function cargarCsv() {
		$this->load->helper('form');
		$config['upload_path'] = './subidas/';
		$config['allowed_types'] = 'csv';
		$this->load->library('upload', $config);
		
		if(!$this->upload->do_upload()){
			$error=array('error' => $this->upload->display_errors());
			$this->load->helper('url');
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view('administrador/altaProfesores', $error);
			$this->load->view("footer");
		}else {
			
			$this->load->library('csvreader');
			$datos=$this->upload->data();
			//print_r($datos);
			$ruta = $datos["full_path"];
			$datosCsv["datos"] = $this->csvreader->parse_file($ruta);
			//print_r($datosCsv);			
			
			$this->load->helper('url');
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view("administrador/altaProfesores",$datosCsv);
			$this->load->view("footer");
		}		
	}

}

?>