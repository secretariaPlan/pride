<?php

class Administrador extends CI_Controller {
	
	public function  __construct()
	{
		parent::__construct();
		$this->load->model('pride/usuario');
		
	}
	
	function sesionActiva(){
		if ($this->session->userdata("idAdministrador")) {
			return true;
		}else{
			return false;
		}
	}
	
	function index() {
		if($this->sesionActiva()){
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view("administrador/bienvenido");
			$this->load->view("footer");
		}else{
			redirect("/login","refresh");
		}
		
	}
	
	 function asignacion() {
	 	if($this->sesionActiva()){
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view("administrador/asignacion");
			$this->load->view("footer");
		}else{
			redirect("/login","refresh");
		}	
	}
	
	
	function altaPeriodos() {
		if($this->sesionActiva()){	
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view("administrador/altaPeriodos");
			$this->load->view("footer");
		}else{
			redirect("/login","refresh");
		}	
	}
	
	public function profesoresEvaluadores(){
		$this->load->model('pride/evaluador_model');
		$evaluados= $this->evaluador_model->profesoresEvaluadores($cadena);
		
	}
	
	
	public function profesoresEvaluados(){
		$this->load->model('pride/evaluado_model');
		$evaluados= $this->evaluado_model->profesoresEvaluados($cadena);
	
	}
	
	
	public function evaluadoSinEvaluador(){
		$this->load->model('pride/evaluado_model');
		$evaluados= $this->evaluado_model->evaluadoSinEvaluador();
	
	}
	
	public function evaluadoresAsignados(){
		$this->load->model('pride/evaluador_model');
		$evaluados= $this->evaluador_model->evaluadoresAsignados();
	
	}
	
	
	public function UsuarioNoEvaluador(){
		$this->load->model('pride/usuario');
		$evaluados= $this->usuario->UsuarioNoEvaluador();
	
	}
	
	
	public function UsuariosEvaluadoresDelPeriodo(){
		$this->load->model('pride/usuario');
		$evaluados= $this->usuario->UsuariosEvaluadoresDelPeriodo();
	
	}

	
	function nuevoPeriodo() {
		$this->load->model("pride/periodo");
		
		$year = $this->input->post("year");
		$numero = $this->input->post("numero");
		
		$periodo = Periodo::first(array("conditions" => array("year = ? AND numero = ?",$year,$numero)));
		
		if(!isset($periodo)){
			$inicioPer = $this->input->post("inicioPeriodo");
			$finPer = $this->input->post("finPeriodo");
			$inicioEval = $this->input->post("inicioEvaluacion");
			$finEval = $this->input->post("finEvaluacion");
			$inicioEntrega = $this->input->post("inicioEntrega");
			$finEntrega = $this->input->post("finEntrega");
			
			if(($inicioPer < $finPer) &($inicioEval < $finEval) &($inicioEntrega < $finEntrega)){
						
				
			$this->periodo->nuevoPeriodo($year,$numero,$inicioPer,$finPer,$inicioEval,$finEval,$inicioEntrega,$finEntrega);
			
			$mensaje["exito"] = "Periodo agregado correctamente";
			}else  $mensaje["error"] = "Las Fechas de Inicio deben ser menores a las Fechas de Termino";
			
			
			
		}else $mensaje["error"] = "El periodo $year-$numero ya ha sido dado de alta anteriormente";
		
		
		$this->load->view("header");
		$this->load->view("administrador/navegacion");
		$this->load->view("administrador/altaPeriodos",$mensaje);
		$this->load->view("footer");
		
		
	}
	
	
	function contenidoPeriodo() { //esta vista contiene el contenido de altaPeriodo
		$this->load->view("administrador/contenidoPeriodo");
	}
	
	function altaProfesores() {
		if($this->sesionActiva()){
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$manual=array('manual' => $this->load->view("administrador/manualAltaprofesor"));
			$this->load->view("administrador/altaProfesores");
			$this->load->view("footer");
		}else{
			redirect("/login","refresh");
		}	
		
		
	}
	
	function nombrarEvaluador() {
		if($this->sesionActiva()){
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view("administrador/nombrarEvaluador");
			$this->load->view("footer");
		}else{
			redirect("/login","refresh");
		}
	
	}
	
	function nombrarEvaluado() {
		if($this->sesionActiva()){
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view("administrador/nombrarEvaluado");
			$this->load->view("footer");
		}else{
			redirect("/login","refresh");
		}
	
	}
	
	function cerrarSesion(){
		$this->session->sess_destroy();
		redirect("/login","refresh");
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
	
	public function busquedaEvaluadorPorNombre() {
		$this->load->model('pride/evaluador_model');
		if(isset($_GET['term'])){
			$cadena = $_GET['term'];
			$this->evaluador_model->profesoresEvaluadores($cadena);
		}
		
	}
	
	public function busquedaEvaluadoPorNombre() {
		$this->load->model('pride/evaluado_model');
		if(isset($_GET['term'])){
			$cadena = $_GET['term'];
			$this->evaluado_model->profesoresEvaluados($cadena);
		}
	
	}
	
	public function evaluadosSinAsignar() {
		$this->load->model('pride/evaluador');
		$this->load->model('pride/periodo');
		
		if(isset($_GET['term'])){
			$cadena = $_GET['term'];
			$profesores = $this->usuario->funcionListaUsuarioNombre($cadena);
			
		}
	}
	
	public function evaluadosAsignados() {
		$this->load->model('pride/usuario');
		$this->load->model('pride/evaluado');
		$this->load->model('pride/evaluadorevaluado');
		$respuesta = array();
		$idEvaluador = $this->input->post("idEvaluador");
		
		$condicion = array("conditions" => array("id_evaluador = ?",$idEvaluador));
		$evaluadoEvaluador = EvaluadorEvaluado::all($condicion);
		
		if(sizeof($evaluadoEvaluador)){
			$respuesta["respuesta"] = array("exito" =>1);
			foreach ($evaluadoEvaluador as $eval) {
				$evaluado = Evaluado::find($eval->id_evaluado);
				$usuario = Usuario::find($evaluado->id_usuario);
				$respuesta["datos"][] = array("id_usuario" => $usuario->id,
									"id_evaluado" => $evaluado->id,
									"nombre" => "$usuario->nombre $usuario->apaterno $usuario->amaterno"
							);
			}
		}else
			$respuesta["respuesta"] = array("exito" =>0);
		
		echo json_encode($respuesta);
		
		
	}
	
	function buscarUsuarioPorNombre() {
		
		if(isset($_GET['term'])){
			$cadena = $_GET['term'];
			$this->usuario->listaUsuarioNombre($cadena);
				
		}
	}
	

}

?>