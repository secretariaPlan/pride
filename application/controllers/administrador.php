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
	
			
	}

	public function registrar_profesor(){
		
		
		if(!$this->usuario->agregar())
		{
		
			$mensaje=array('mensaje' => "Profesor Agregado Exitosamente");
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view("administrador/nuevoProfesor",$mensaje);
			$this->load->view("footer");
		}

		else{
				
		
		}
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
	
	public function guardarDatos() {
		
		$i=0;
		
		$rfc = $this->input->post("rfc");
		$nombre = $this->input->post("nombre");
		$apaterno  = $this->input->post("apaterno");
		$amaterno  = $this->input->post("amaterno");
		$pass = $this->input->post("pass");
		$correo = $this->input->post("correo");
		
		foreach ($rfc as $rfc) {
			$this->usuario->nuevoUsuario($rfc,$nombre[$i],$apaterno[$i],$amaterno[$i],md5($pass[$i]),$correo[$i]);
			$i++;
		}
		$exito = array("exito" => "Los registros se han guardado correctamente");
		$this->load->view("header");
		$this->load->view("administrador/navegacion");
		$this->load->view('administrador/altaProfesores', $exito);
		$this->load->view("footer");
	}
	
	public function listaUsuarios() {
		$usuarios = $this->usuario->listaUsuarios();
		$arreglo = array();
		foreach ($usuarios as $usuario) {
			$arreglo[] = array("id" => "$usuario->id",
								"rfc" => "$usuario->rfc",
								"nombre" => "$usuario->nombre",
								"apaterno" => "$usuario->apaterno",
								"amaterno" => "$usuario->amaterno"
			);
		}
		echo json_encode($arreglo);
	}
	
	public function listaUsuarioNombre($cadena) {
		$usuarios = $this->usuario->listaUsuarioNombre($cadena);
		$arreglo = array();
		foreach ($usuarios as $usuario) {
			$arreglo[] = array("id" => "$usuario->id",
								"rfc" => "$usuario->rfc",
								"nombre" => "$usuario->nombre"." "."$usuario->apaterno"." "."$usuario->amaterno",
			);
		}
		echo json_encode($arreglo);
	}

}

?>