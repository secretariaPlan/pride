<?php

class Administrador extends CI_Controller {
	
	public function  __construct()
	{
		parent::__construct();
		$this->load->model('pride/usuario');
	
	}
	
	function index() {
		$this->load->view("header");
		$this->load->view("administrador/navegacion");
		$this->load->view("administrador/asignacion");
		$this->load->view("footer");
	}
	
	function altaPeriodos() { //esta vista solo contiene el boton de AltaPeriodo
		$this->load->view("header");
		$this->load->view("administrador/navegacion");
		$this->load->view("administrador/altaPeriodos");
		$this->load->view("footer");
	}
	
	
	function contenidoPeriodo() { //esta vista contiene el contenido de altaPeriodo
		$this->load->view("administrador/contenidoPeriodo");
	}
	
	function altaProfesores() {
		$this->load->view("header");
		$this->load->view("administrador/navegacion");
		$this->load->view("administrador/altaProfesores");
		$this->load->view("footer");
	}
	
	function nuevoProfesor() {
		$this->load->view("header");
		$this->load->view("administrador/navegacion");
		$this->load->view("administrador/nuevoProfesor");
		$this->load->view("footer");
		$this->load->model('pride/usuario');
	
		
		
				
		
	}
	
	
	
	function recibirDatos(){

		$data = array(
				'rfc' => $this->input->post('rfc'),
				'nombre' => $this->input->post('nombre'),
				'apaterno' => $this->input->post('apaterno'),
				'amaterno' => $this->input->post('amaterno'),
				'password' => md5($this->input->post("password")),
				'correo' => $this->input->post('correo'),
		);
		$this->usuario->nuevoUsuario($data);
		
		
	}
	
	
	
	public  function insertarDatos(){
			
		
		$this->usuario->nuevoUsuario("aaaa","gabo","aa","aaa","222","gabreldelabarrera@gmail.com");

	}
	
	
	
	
	public function cargarCsv() {
		$config['upload_path'] = './subidas/';
		$config['allowed_types'] = 'csv';
		$this->load->library('upload', $config);
		
		if(!$this->upload->do_upload()){
			$error=array('error' => $this->upload->display_errors());
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view('administrador/altaProfesores', $error);
			$this->load->view("footer");
		}else {
			
			$datos=$this->upload->data();
			$ruta = $datos["full_path"];
			$datosCsv["datos"] = $this->csvreader->parse_file($ruta);
			
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view("administrador/altaProfesores",$datosCsv);
			$this->load->view("footer");
		}		
	}

}

?>