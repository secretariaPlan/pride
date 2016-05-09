<?php

class Evaluador_Controller extends CI_Controller {
	
	public function  __construct()
	{
		parent::__construct();
		$this->load->model('pride/evaluador_model');
		$this->load->model('pride/archivo_model');
	
	}
	function index() {
		$this->load->view("header");
		$this->load->view("evaluador");
	}
	
	function sesionActivaEvaluador(){
		if ($this->session->userdata("idUsuario") && $this->session->userdata("tipo") == 2) {
			return true;
		}else{
			return false;
		}
	}
	
	function vistaListaEvaluados(){
		$this->load->model('pride/usuario_model');
		$this->load->model('pride/evaluado_model');
		$this->load->model('pride/evaluadorevaluado');
		$this->load->model('sicpa/profesor_model');
		$respuesta = array();
		$idEvaluador = $this->session->all_userdata()[0]["idEvaluador"];
		//print_r($idEvaluador);
		
		$condicion = array("conditions" => array("id_evaluador = ?",$idEvaluador));
		$evaluadoEvaluador = EvaluadorEvaluado::all($condicion);
		
		if(sizeof($evaluadoEvaluador)){

			$respuesta["respuesta"] = array("exito" =>1);
			foreach ($evaluadoEvaluador as $eval) {
				$evaluado = Evaluado_Model::find($eval->id_evaluado);
				$usuario = Usuario_Model::find($evaluado->id_usuario);
				$profesorSicpa = $this->profesor_model->buscaProfesorPorRFC($usuario->rfc);
				$respuesta["datos"][] = array("id_usuario" => $usuario->id,
						"rfc" => $usuario->rfc,
						"idEvaluado" => $evaluado->id,
						"idSicpa" => $profesorSicpa,
						"nombre" => "$usuario->nombre $usuario->apaterno $usuario->amaterno"
				);
			}
		}else
			$respuesta["respuesta"] = array("exito" =>0);
		
		$this->load->view("header");
		$this->load->view("evaluador/listaEvaluados",$respuesta);
		$this->load->view("footer");
	}
	
	function nuevoEvaluador($idUsuario,$idPeriodo,$idComision){
		
		$this->evaluador_model->nuevoEvaluador($idUsuario,$idPeriodo,$idComision);
	}
	
	function evaluadoresDelPeriodo(){
		$this->load->model("pride/periodo_model");
		$this->load->model("pride/usuario_model");
		
		$periodo = Periodo_Model::last();
		
		$condiciones = array("conditions" => array("id_periodo = ?",$periodo->id));
		$evaluadores = Evaluador_Model::all($condiciones);
		
		if (sizeof($evaluadores)){
			$respuesta["exito"] = 1;
			foreach ($evaluadores as $evaluador) {
				$usuario = Usuario_Model::first($evaluador->id_usuario);
				$respuesta["usuarios"][] = array("idUsuario" => $usuario->id,
						"idEvaluador" => $evaluador->id,
						"nombre" => "$usuario->nombre $usuario->apaterno $usuario->amaterno"
				);
			}
		}else $respuesta["exito"] = 0;
		
		
		echo json_encode($respuesta);
	}
	
	function desasignarEvaluadorDelPeriodo(){
		$idEvaluador = $this->input->post("idEvaluador");
		
		$this->evaluador_model->desasignarEvaluadorDelPeriodo($idEvaluador);
	}
	
	public function busquedaEvaluadorPorNombre() {
		if(isset($_GET['term'])){
			$cadena = $_GET['term'];
			$this->evaluador_model->profesoresEvaluadores($cadena);
		}
	
	}
	
	public function evaluadosAsignados() {
		$this->load->model('pride/usuario_model');
		$this->load->model('pride/evaluado_model');
		$this->load->model('pride/evaluadorevaluado');
		$respuesta = array();
		$idEvaluador = $this->input->post("idEvaluador");
	
		$condicion = array("conditions" => array("id_evaluador = ?",$idEvaluador));
		$evaluadoEvaluador = EvaluadorEvaluado::all($condicion);
	
		if(sizeof($evaluadoEvaluador)){
			$respuesta["respuesta"] = array("exito" =>1);
			foreach ($evaluadoEvaluador as $eval) {
				$evaluado = Evaluado_Model::find($eval->id_evaluado);
				$usuario = Usuario_Model::find($evaluado->id_usuario);
				$respuesta["datos"][] = array("id_usuario" => $usuario->id,
						"id_evaluado" => $evaluado->id,
						"nombre" => "$usuario->nombre $usuario->apaterno $usuario->amaterno"
				);
			}
		}else
			$respuesta["respuesta"] = array("exito" =>0);
	
		echo json_encode($respuesta);
	}

	function pruebaSicpa(){
		$this->load->model('sicpa/tutoria_model');
		
		$id = $this->input->post("id");
		
		print_r($this->tutoria_model->buscaTutoriasPorIdProfesor($id));

	}

	function informacionEvaluado(){
		$this->load->model('sicpa/profesor_model');

		$parametros = $this->uri->uri_to_assoc();
		$id =$parametros['id'];
		$idEvaluado =$parametros['idEvaluado'];
		$datosEvaluado = array("idEvaluadoSicpa" => $id,
								"idEvaluado" => $idEvaluado);
		$this->session->set_userdata($datosEvaluado);
		$datosMenu = array("seccion" => "informacion");

		$profesor = $this->profesor_model->informacionProfesor($id);

		$this->load->model('pride/evaluado_model');
		$this->load->view("header");
		$this->load->view("evaluador/navegacion",$datosMenu);
		$this->load->view("evaluador/informacionEvaluado",$profesor);
		$this->load->view("footer");
	}
	
	function formacionTrayectoriaAcademica(){

		$this->load->model('sicpa/formacionacademica_model');
		$this->load->model('sicpa/premio_model');

		$datosMenu = array("seccion"=>"formacionT");
		
		$id = $this->session->all_userdata()["idEvaluadoSicpa"];
		$datos["idUsuario"] = $this->session->all_userdata()[0]["idUsuario"];
		$datos["idEvaluado"] = $this->session->all_userdata()["idEvaluado"];

		$datos["formacion"] = $this->formacionacademica_model->buscarRegistroPorIdProfesor($id);
		$datos["premios"] = $this->premio_model->buscaPremioPorIdProfesor($id);
		
		$seccion = 1;
		$datos["listaArchivos"] = $this->archivo_model->buscaArchivosEvaluado($datos["idEvaluado"],$seccion);
		
		$this->load->model('pride/evaluado_model');
		$this->load->view("header");
		$this->load->view("evaluador/navegacion",$datosMenu);
		$this->load->view("evaluador/formacionTrayectoriaAcademica",$datos);
		$this->load->view("footer");
	}
	
	function productividadAcademica(){
		$this->load->model('sicpa/pubarticulo_model');
		$this->load->model('sicpa/iplibrocapitulo_model');
		$this->load->model('sicpa/iplibro_model');
		$this->load->model('sicpa/ipparticipacion_model');
		$this->load->model('sicpa/ipmemoria_model');
		$this->load->model('sicpa/ippatente_model');

		$datosMenu = array("seccion"=>"productividad");

		$id = $this->session->all_userdata()["idEvaluadoSicpa"];
		$datos["idUsuario"] = $this->session->all_userdata()[0]["idUsuario"];
		$datos["idEvaluado"] = $this->session->all_userdata()["idEvaluado"];

		$datos["articulo"] = $this->pubarticulo_model->buscaPubArticuloPorIdProfesor($id);
		$datos["capitulo"] = $this->iplibrocapitulo_model->buscaCapitulosPorIdProfesor($id);
		$datos["libro"] = $this->iplibro_model->buscaLibrosPorIdProfesor($id);
		$datos["participacion"] = $this->ipparticipacion_model->buscaParticipacionPorIdProfesor($id);
		$datos["memoria"] = $this->ipmemoria_model->buscaMemoriasPorIdProfesor($id);
		$datos["patente"] = $this->ippatente_model->buscaPatentePorIdProfesor($id);

		$seccion = 2;
		$datos["listaArchivos"] = $this->archivo_model->buscaArchivosEvaluado($datos["idEvaluado"],$seccion);

		$this->load->model('pride/evaluado_model');
		$this->load->view("header");
		$this->load->view("evaluador/navegacion",$datosMenu);
		$this->load->view("evaluador/productividadAcademica",$datos);
		$this->load->view("footer");
	}
	
	function materialDocente(){
		$this->load->model('sicpa/pubarticulo_model');

		$datosMenu = array("seccion"=>"material");

		$id = $this->session->all_userdata()["idEvaluadoSicpa"];
		$datos["idUsuario"] = $this->session->all_userdata()[0]["idUsuario"];
		$datos["idEvaluado"] = $this->session->all_userdata()["idEvaluado"];

		$seccion = 3;
		$datos["listaArchivos"] = $this->archivo_model->buscaArchivosEvaluado($datos["idEvaluado"],$seccion);

		$this->load->model('pride/evaluado_model');
		$this->load->view("header");
		$this->load->view("evaluador/navegacion",$datosMenu);
		$this->load->view("evaluador/materialDocente",$datos);
		$this->load->view("footer");

	}
		
	function formacionRecursosHumanos(){
		$this->load->model('sicpa/titulacion_model');
		$this->load->model('sicpa/examenposgrado_model');
		$this->load->model('sicpa/tutoria_model');
		$this->load->model('sicpa/servsocial_model');

		$datosMenu = array("seccion"=>"formacionR");

		$id = $this->session->all_userdata()["idEvaluadoSicpa"];
		$datos["idUsuario"] = $this->session->all_userdata()[0]["idUsuario"];
		$datos["idEvaluado"] = $this->session->all_userdata()["idEvaluado"];

		$datos["tesisConcluidas"] = $this->titulacion_model->buscaTitulacionPorIdProfesor($id);
		//$datos["tesisLicenciaturaSupervisor"] = $this->titulacion_model->buscaTesisSupervisorPorIdProfesor($id);
		$datos["examenesSupervisor"] = $this->examenposgrado_model->buscaExamenesComoSupervisorPorIdProfesor($id);
		$datos["examenesJurado"] = $this->examenposgrado_model->buscaExamenesJuradoPorIdProfesor($id);
		$datos["tutorias"] = $this->tutoria_model->buscaTutoriasPorIdProfesor($id);
		$datos["tutoriasConcluidas"] = $this->tutoria_model->buscaTutoriasConcluidasPorIdProfesor($id);
		$datos["servSocial"] = $this->servsocial_model->buscaServicioSocialPorIdProfesor($id);

		$seccion = 4;
		$datos["listaArchivos"] = $this->archivo_model->buscaArchivosEvaluado($datos["idEvaluado"],$seccion);

		$this->load->model('pride/evaluado_model');
		$this->load->view("header");
		$this->load->view("evaluador/navegacion",$datosMenu);
		$this->load->view("evaluador/formacionRecursosHumanos",$datos);
		$this->load->view("footer");
	}
	
	function docencia(){
		$this->load->model('sicpa/cursolicenciatura_model');
		$this->load->model('sicpa/cursoposgrado_model');
		$this->load->model('sicpa/cursoextracurr_model');
		
		$datosMenu = array("seccion"=>"docencia");

		$id = $this->session->all_userdata()["idEvaluadoSicpa"];
		$datos["idUsuario"] = $this->session->all_userdata()[0]["idUsuario"];
		$datos["idEvaluado"] = $this->session->all_userdata()["idEvaluado"];

		$datos["cursosLicenciatura"] = $this->cursolicenciatura_model->buscarCursosPorIdProfesor($id);
		$datos["cursosPosgrado"] = $this->cursoposgrado_model->buscarCursosPorIdProfesor($id);
		$datos["cursosExtra"] = $this->cursoextracurr_model->buscaCursoExtraCurrPoridProfesor($id);

		$seccion = 5;
		$datos["listaArchivos"] = $this->archivo_model->buscaArchivosEvaluado($datos["idEvaluado"],$seccion);
		
		$this->load->model('pride/evaluado_model');
		$this->load->view("header");
		$this->load->view("evaluador/navegacion",$datosMenu);
		$this->load->view("evaluador/docencia",$datos);
		$this->load->view("footer");
	}
	
	function difusion(){
		$this->load->model('sicpa/reunion_model');
		$this->load->model('sicpa/conferencia_model');
		$this->load->model('sicpa/actividad_model');

		$datosMenu = array("seccion"=>"difusion");

		$id = $this->session->all_userdata()["idEvaluadoSicpa"];
		$datos["idUsuario"] = $this->session->all_userdata()[0]["idUsuario"];
		$datos["idEvaluado"] = $this->session->all_userdata()["idEvaluado"];

		$datos["presentacion"] = $this->reunion_model->buscaCongresoPorIdProfesor($id);
		$datos["conferencia"] = $this->conferencia_model->buscarConferenciaPorIdProfesor($id);
		$datos["eventos"] = $this->actividad_model->buscaActividadPorIdProfesor($id);
		
		$seccion = 6;
		$datos["listaArchivos"] = $this->archivo_model->buscaArchivosEvaluado($datos["idEvaluado"],$seccion);
		
		$this->load->model('pride/evaluado_model');
		$this->load->view("header");
		$this->load->view("evaluador/navegacion",$datosMenu);
		$this->load->view("evaluador/difusion",$datos);
		$this->load->view("footer");
	}
	
	function participacionInstitucional(){
		$this->load->model('sicpa/cargo_model');
		$this->load->model('sicpa/comisionevaluadora_model');

		$datosMenu = array("seccion"=>"participacion");

		$id = $this->session->all_userdata()["idEvaluadoSicpa"];
		$datos["idUsuario"] = $this->session->all_userdata()[0]["idUsuario"];
		$datos["idEvaluado"] = $this->session->all_userdata()["idEvaluado"];
		
		$datos["cargo"] = $this->cargo_model->buscaCargoPorIdProfesor($id);
		$datos["comisiones"] = $this->comisionevaluadora_model->buscaComisionEvaluadoraPorIdProfesor($id);

		$seccion = 7;
		$datos["listaArchivos"] = $this->archivo_model->buscaArchivosEvaluado($datos["idEvaluado"],$seccion);

		$this->load->model('pride/evaluado_model');
		$this->load->view("header");
		$this->load->view("evaluador/navegacion",$datosMenu);
		$this->load->view("evaluador/participacionInstitucional",$datos);
		$this->load->view("footer");
	}
	
}

?>