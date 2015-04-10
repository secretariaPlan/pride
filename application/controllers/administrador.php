<?php

class Administrador extends CI_Controller {
	
	public function  __construct()
	{
		parent::__construct();
		$this->load->model('pride/usuario');
		$this->ingresa();
		
	}
	
	
	public function loginAdmin($rfc,$pass) {
		static $table_name = "administrador";
	
		//$admin = Administrador::first(array("conditions" => array("rfc = ? AND password = ?",$rfc,$pass) ));
		if(isset($admin))return true;
		else return false;
	}
	
	
	
	public function ingresa() {
		$rfc = $this->input->post("rfc");
		$pass = md5($this->input->post("pass"));
	
		if($this->loginAdmin($rfc,$pass)){
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
	
	
	
	
	
	
	
public function index() {
		$this->load->view("header");
		$this->load->view("login");
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
		if($this->input->post()){
			//$this->usuario->agregar();
			$rfc=$this->input->post("rfc");
			$nombre=$this->input->post("nombre");
			$apaterno=$this->input->post("apaterno");
			$amaterno=$this->input->post("amaterno");
			$pass=$this->input->post("password");
			$email=$this->input->post("correo");
			$this->usuario->nuevoUsuario($rfc,$nombre,$apaterno,$amaterno,md5($pass),$email);
			
			$mensaje=array('mensaje' => "Profesor Agregado Exitosamente");
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view("administrador/nuevoProfesor",$mensaje);
			$this->load->view("footer");
			
		}else{
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view("administrador/nuevoProfesor");
			$this->load->view("footer");
				
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
			
	}
	
	public function listaUsuarioNombre() {
		if(isset($_GET['term'])){
			$cadena = $_GET['term'];
			$this->usuario->listaUsuarioNombre($cadena);
		}
		
	}
	

}

?>