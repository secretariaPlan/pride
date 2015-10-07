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
	
	function nuevoPeriodo() {
		$this->load->model("pride/periodo");
		$mensaje['test'] ="Ok";
		$year = $this->input->post("year");
		$numero = $this->input->post("numero");
		
		
		$periodo = Periodo::first(array("conditions" => array("year = ? AND numero = ?",$year,$numero)));
		$ultimaEntrega = Periodo::find_by_sql("SELECT finentrega FROM periodo ORDER BY finentrega DESC LIMIT 1");
		
		if(!isset($periodo)){
			$this->form_validation->set_error_delimiters('<div class = "notice error"><i class="icon-remove-sign icon-large"></i>', '</div>');
			$this->form_validation->set_rules('inicioPeriodo','fecha de Inicio', 'callback_inicioPeriodo_check['.$this->input->post('finPeriodo').']');
			$this->form_validation->set_rules('finPeriodo','fecha de Termino', 'required');
			$this->form_validation->set_rules('inicioEvaluacion','Inicio de evaluación', 'callback_fechaInicio_check['.$this->input->post('inicioPeriodo').']' . '|' . 'callback_fechaFin_check['.$this->input->post('finPeriodo').']');
			$this->form_validation->set_rules('finEvaluacion','Termino de evaluación', 'callback_fechaInicio_check['.$this->input->post('inicioPeriodo').']' . '|' . 'callback_fechaFin_check['.$this->input->post('finPeriodo').']');
			$this->form_validation->set_rules('inicioEntrega','Inicio de entrega de documentos', 'callback_fechaInicio_check['.$this->input->post('inicioPeriodo').']' . '|' . 'callback_fechaFin_check['.$this->input->post('finPeriodo').']');
			$this->form_validation->set_rules('finEntrega','Termino de entrega de documentos', 'callback_fechaInicio_check['.$this->input->post('inicioPeriodo').']' . '|' . 'callback_fechaFin_check['.$this->input->post('finPeriodo').']');

			
			if ($this->form_validation->run() == FALSE)
			{
				$this ->altaPeriodos();
			}
			else
			{
				$inicioPer = $this->input->post("inicioPeriodo");
				$finPer = $this->input->post("finPeriodo");
				$inicioEval = $this->input->post("inicioEvaluacion");
				$finEval = $this->input->post("finEvaluacion");
				$inicioEntrega = $this->input->post("inicioEntrega");
				$finEntrega = $this->input->post("finEntrega");	

				$this->periodo->nuevoPeriodo($year,$numero,$inicioPer,$finPer,$inicioEval,$finEval,$inicioEntrega,$finEntrega);

				redirect("/admin/administrador/altaPeriodos","refresh");
			}
				 
			
		}else {
			$mensaje["error"] = "El periodo $year-$numero ya ha sido dado de alta anteriormente";
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view("administrador/altaPeriodos",$mensaje);
			$this->load->view("footer");
				
		

		}
		
		
		
		
	}

	public function inicioPeriodo_check($str,$finPeriodo){
		
		if($str != ""){
			if($finPeriodo != ""){
				$periodoInicio = new DateTime($str);
				$periodoFin = new DateTime($finPeriodo);
				if ($periodoInicio >= $periodoFin){
					$this->form_validation->set_message('inicioPeriodo_check', 'La fecha de Inicio  debe ser menor que la fecha de Termino');
					return FALSE;
				}
				else{
					return TRUE;
				}
			}
			else{
				return TRUE;
			}
		}
		else{
			$this->form_validation->set_message('inicioPeriodo_check', 'El campo fecha de Inicio es obligatorio');
			return FALSE;
		}
	}

	public function fechaInicio_check($str,$inicioPeriodo){
		
		if($str != ""){
			$periodoInicio = new DateTime($inicioPeriodo);
			$str = new DateTime($str);
			if ($str <= $periodoInicio){
				$this->form_validation->set_message('fechaInicio_check', 'La fecha de %s debe ser mayor que la fecha de Inicio');
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
		else{
			$this->form_validation->set_message('fechaInicio_check', 'El campo %s es obligatorio');
			return FALSE;
		}
	}

	public function fechaFin_check($str,$finPeriodo){
		
		if($str != ""){
			$periodoFin = new DateTime($finPeriodo);
			$str = new DateTime($str);
			if ($str >= $periodoFin){
				$this->form_validation->set_message('fechaFin_check', 'La fecha de %s debe ser menor que la fecha de Termino');
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
		else{
			$this->form_validation->set_message('fechaFin_check', 'El campo %s es obligatorio');
			return FALSE;
		}
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
	
	function altaEvaluadores(){
		if($this->sesionActiva()){
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view("administrador/altaEvaluadores");
			$this->load->view("footer");
		}else{
			redirect("/login","refresh");
		}
	
	}
	
	function altaEvaluados(){
		if($this->sesionActiva()){
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view("administrador/altaEvaluados");
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


	function cargarCsvEvaluador() {
		$config['upload_path'] = './subidas/';
		$config['allowed_types'] = 'csv';
		$this->load->library('upload', $config);
		
		if(!$this->upload->do_upload()){
			$error=array('error' => $this->upload->display_errors());
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view('administrador/altaEvaluadores', $error);
			$this->load->view("footer");
		}else {
			
			$datos=$this->upload->data();
			$ruta = $datos["full_path"];
			$datosCsv["datos"] = $this->csvreader->parse_file($ruta);
			
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view("administrador/altaEvaluadores",$datosCsv);
			$this->load->view("footer");
		}		
	}
	
	function cargarCsvEvaluado() {
		$config['upload_path'] = './subidas/';
		$config['allowed_types'] = 'csv';
		$this->load->library('upload', $config);
	
		if(!$this->upload->do_upload()){
			$error=array('error' => $this->upload->display_errors());
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view('administrador/altaEvaluados', $error);
			$this->load->view("footer");
		}else {
				
			$datos=$this->upload->data();
			$ruta = $datos["full_path"];
			$datosCsv["datos"] = $this->csvreader->parse_file($ruta);
				
			$this->load->view("header");
			$this->load->view("administrador/navegacion");
			$this->load->view("administrador/altaEvaluados",$datosCsv);
			$this->load->view("footer");
		}
	}
	
	function guardarDatos() {
		
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
	
	function guardarEvaluadores() {
		
		$this->load->model("pride/periodo");
		$this->load->model("pride/evaluador_model");
		$this->load->model("pride/comision");
	
		$rfc = $this->input->post("rfc");
		$nombre = $this->input->post("nombre");
		$apaterno  = $this->input->post("apaterno");
		$amaterno  = $this->input->post("amaterno");
		$pass = $this->input->post("pass");
		$correo = $this->input->post("correo");
		
		$periodo = Periodo::last();
		$comision = Comision::find(1);
				
		$i=0;
		foreach ($rfc as $rfc) {
			$usuarioId = $this->usuario->nuevoUsuario($rfc,$nombre[$i],$apaterno[$i],$amaterno[$i],md5($pass[$i]),$correo[$i]);
			$evaluador = new Evaluador_Model();
			$evaluador->nuevoEvaluador($usuarioId,$periodo->id,$comision->id);
			$i++;
		}
			
		$exito = array("exito" => "Los registros se han guardado correctamente");
		$this->load->view("header");
		$this->load->view("administrador/navegacion");
		$this->load->view('administrador/altaEvaluadores', $exito);
		$this->load->view("footer");
	}
	
	function guardarEvaluados() {
	
		$this->load->model("pride/periodo");
		$this->load->model("pride/evaluado_model");
		$this->load->model("pride/comision");
	
		$rfc = $this->input->post("rfc");
		$nombre = $this->input->post("nombre");
		$apaterno  = $this->input->post("apaterno");
		$amaterno  = $this->input->post("amaterno");
		$pass = $this->input->post("pass");
		$correo = $this->input->post("correo");
	
		$periodo = Periodo::last();
		$comision = Comision::find(1);
	
		$i=0;
		foreach ($rfc as $rfc) {
			$usuarioId = $this->usuario->nuevoUsuario($rfc,$nombre[$i],$apaterno[$i],$amaterno[$i],md5($pass[$i]),$correo[$i]);
			$evaluado = new Evaluado_Model();
			$evaluado->nuevoEvaluado($usuarioId,$periodo->id,$comision->id);
			$i++;
		}
			
		$exito = array("exito" => "Los registros se han guardado correctamente");
		$this->load->view("header");
		$this->load->view("administrador/navegacion");
		$this->load->view('administrador/altaEvaluados', $exito);
		$this->load->view("footer");
	}
	
	function listaUsuarios() {
			$usuarios = $this->usuario->listaUsuarios();
			
	}
		
	function buscarUsuarioPorNombre() {
	
		if(isset($_GET['term'])){
			$cadena = $_GET['term'];
			$this->usuario->listaUsuarioNombre($cadena);
	
		}
	}	

}

?>