<?php

class Evaluado_Controller extends CI_Controller {
	
	public function  __construct()
	{
		parent::__construct();
		$this->load->model('pride/evaluado_model');
	
	}
	function index() {
		$this->load->view("header");
		$this->load->view("evaluador");
	}
	
	function nuevoEvaluado(){
		
		$idUsuario = $this->input->post("idUsuario");
		$idPeriodo = $this->input->post("idPeriodo");
		$idComision = $this->input->post("idComision");
		
		$this->evaluado_model->nuevoEvaluado($idUsuario,$idPeriodo,$idComision);
	}
	
	function evaluadosDelPeriodo(){
		$this->load->model("pride/periodo_model");
		$this->load->model("pride/usuario_model");
	
		$periodo = Periodo_Model::last();
	
		$condiciones = array("conditions" => array("id_periodo = ?",$periodo->id));
		$evaluados = Evaluado_Model::all($condiciones);
		
		if (sizeof($evaluados)){
			$respuesta["exito"] = 1;
			foreach ($evaluados as $evaluado) {
				$usuario = Usuario_Model::first($evaluado->id_usuario);
				$respuesta["usuarios"][] = array("idUsuario" => $usuario->id,
						"idEvaluado" => $evaluado->id,
						"nombre" => "$usuario->nombre $usuario->apaterno $usuario->amaterno"
				);
			}
		}else $respuesta["exito"] = 0;
	
		
		echo json_encode($respuesta);
	}
	
	function desasignarEvaluadoDelPeriodo(){
		$idEvaluado = $this->input->post("idEvaluado");
		$this->evaluado_model->desasignarEvaluadoDelPeriodo($idEvaluado);
	}
	
	public function busquedaEvaluadoPorNombre() {
		if(isset($_GET['term'])){
			$cadena = $_GET['term'];
			$this->evaluado_model->profesoresEvaluados($cadena);
		}
	}

	public function evaluadosSinAsignar() {
		$this->load->model('pride/evaluador');
		$this->load->model('pride/periodo_model');
	
		if(isset($_GET['term'])){
			$cadena = $_GET['term'];
			$profesores = $this->usuario->funcionListaUsuarioNombre($cadena);
				
		}
	}

	function informacionEvaluado(){
		$this->load->model('sicpa/profesor_model');

		$datosMenu = array("seccion" => "informacion");

		$id = $this->session->all_userdata()["idProfesorSicpa"];

		$profesor = $this->profesor_model->informacionProfesor($id);

		$this->load->model('pride/evaluado_model');
		$this->load->view("header");
		$this->load->view("evaluado/navegacion",$datosMenu);
		$this->load->view("evaluado/informacionEvaluado",$profesor);
		$this->load->view("footer");
	}

	function formacionTrayectoriaAcademica(){
		$this->load->model('sicpa/formacionacademica_model');
		$this->load->model('sicpa/premio_model');

		$id = $this->session->all_userdata()["idProfesorSicpa"];
		$datosMenu = array("seccion"=>"formacionT");
		
		$datos["idUsuario"] = $this->session->all_userdata()["idUsuario"];
		$datos["idEvaluado"] = $this->session->all_userdata()["idEvaluado"];

		$datos["formacion"] = $this->formacionacademica_model->buscarRegistroPorIdProfesor($id);
		$datos["premios"] = $this->premio_model->buscaPremioPorIdProfesor($id);
		

		$this->load->model('pride/evaluado_model');
		$this->load->view("header");
		$this->load->view("evaluado/navegacion",$datosMenu);
		$this->load->view("evaluado/formacionTrayectoriaAcademica",$datos);
		$this->load->view("footer");
	}
	
	function productividadAcademica(){
		$this->load->model('sicpa/pubarticulo_model');
		$this->load->model('sicpa/iplibrocapitulo_model');
		$this->load->model('sicpa/iplibro_model');
		$this->load->model('sicpa/ipparticipacion_model');
		$this->load->model('sicpa/ipmemoria_model');
		$this->load->model('sicpa/ippatente_model');

		$id = $this->session->all_userdata()["idProfesorSicpa"];
		$datosMenu = array("seccion"=>"productividad");

		$datos["idUsuario"] = $this->session->all_userdata()["idUsuario"];
		$datos["idEvaluado"] = $this->session->all_userdata()["idEvaluado"];

		$datos["articulo"] = $this->pubarticulo_model->buscaPubArticuloPorIdProfesor($id);
		$datos["capitulo"] = $this->iplibrocapitulo_model->buscaCapitulosPorIdProfesor($id);
		$datos["libro"] = $this->iplibro_model->buscaLibrosPorIdProfesor($id);
		$datos["participacion"] = $this->ipparticipacion_model->buscaParticipacionPorIdProfesor($id);
		$datos["memoria"] = $this->ipmemoria_model->buscaMemoriasPorIdProfesor($id);
		$datos["patente"] = $this->ippatente_model->buscaPatentePorIdProfesor($id);

		$this->load->model('pride/evaluado_model');
		$this->load->view("header");
		$this->load->view("evaluado/navegacion",$datosMenu);
		$this->load->view("evaluado/productividadAcademica",$datos);
		$this->load->view("footer");
	}
	
	function materialDocente(){
		$this->load->model('sicpa/pubarticulo_model');

		$id = $this->session->all_userdata()["idProfesorSicpa"];
		$datosMenu = array("seccion"=>"material");

		$datos["idUsuario"] = $this->session->all_userdata()["idUsuario"];
		$datos["idEvaluado"] = $this->session->all_userdata()["idEvaluado"];

		$this->load->model('pride/evaluado_model');
		$this->load->view("header");
		$this->load->view("evaluado/navegacion",$datosMenu);
		$this->load->view("evaluado/materialDocente",$datos);
		$this->load->view("footer");
	}
		
	function formacionRecursosHumanos(){
		$this->load->model('sicpa/titulacion_model');
		$this->load->model('sicpa/examenposgrado_model');
		$this->load->model('sicpa/tutoria_model');
		$this->load->model('sicpa/servsocial_model');

		$id = $this->session->all_userdata()["idProfesorSicpa"];
		$datosMenu = array("seccion"=>"formacionR");

		$datos["idUsuario"] = $this->session->all_userdata()["idUsuario"];
		$datos["idEvaluado"] = $this->session->all_userdata()["idEvaluado"];

		$datos["tesisConcluidas"] = $this->titulacion_model->buscaTitulacionPorIdProfesor($id);
		//$datos["tesisLicenciaturaSupervisor"] = $this->titulacion_model->buscaTesisSupervisorPorIdProfesor($id);
		$datos["examenesSupervisor"] = $this->examenposgrado_model->buscaExamenesComoSupervisorPorIdProfesor($id);
		$datos["examenesJurado"] = $this->examenposgrado_model->buscaExamenesJuradoPorIdProfesor($id);
		$datos["tutorias"] = $this->tutoria_model->buscaTutoriasPorIdProfesor($id);
		$datos["tutoriasConcluidas"] = $this->tutoria_model->buscaTutoriasConcluidasPorIdProfesor($id);
		$datos["servSocial"] = $this->servsocial_model->buscaServicioSocialPorIdProfesor($id);

		$this->load->model('pride/evaluado_model');
		$this->load->view("header");
		$this->load->view("evaluado/navegacion",$datosMenu);
		$this->load->view("evaluado/formacionRecursosHumanos",$datos);
		$this->load->view("footer");
	}
	
	function docencia(){
		$this->load->model('sicpa/cursolicenciatura_model');
		$this->load->model('sicpa/cursoposgrado_model');
		$this->load->model('sicpa/cursoextracurr_model');

		$id = $this->session->all_userdata()["idProfesorSicpa"];
		$datosMenu = array("seccion"=>"docencia");

		$datos["idUsuario"] = $this->session->all_userdata()["idUsuario"];
		$datos["idEvaluado"] = $this->session->all_userdata()["idEvaluado"];

		$datos["cursosLicenciatura"] = $this->cursolicenciatura_model->buscarCursosPorIdProfesor($id);
		$datos["cursosPosgrado"] = $this->cursoposgrado_model->buscarCursosPorIdProfesor($id);
		$datos["cursosExtra"] = $this->cursoextracurr_model->buscaCursoExtraCurrPoridProfesor($id);
		
		$this->load->model('pride/evaluado_model');
		$this->load->view("header");
		$this->load->view("evaluado/navegacion",$datosMenu);
		$this->load->view("evaluado/docencia",$datos);
		$this->load->view("footer");
	}
	
	function difusion(){
		$this->load->model('sicpa/reunion_model');
		$this->load->model('sicpa/conferencia_model');
		$this->load->model('sicpa/actividad_model');

		$id = $this->session->all_userdata()["idProfesorSicpa"];
		$datosMenu = array("seccion"=>"difusion");

		$datos["idUsuario"] = $this->session->all_userdata()["idUsuario"];
		$datos["idEvaluado"] = $this->session->all_userdata()["idEvaluado"];

		$datos["presentacion"] = $this->reunion_model->buscaCongresoPorIdProfesor($id);
		$datos["conferencia"] = $this->conferencia_model->buscarConferenciaPorIdProfesor($id);
		$datos["eventos"] = $this->actividad_model->buscaActividadPorIdProfesor($id);
		
		$this->load->model('pride/evaluado_model');
		$this->load->view("header");
		$this->load->view("evaluado/navegacion",$datosMenu);
		$this->load->view("evaluado/difusion",$datos);
		$this->load->view("footer");
	}
	
	function participacionInstitucional(){
		$this->load->model('sicpa/cargo_model');
		$this->load->model('sicpa/comisionevaluadora_model');

		$id = $this->session->all_userdata()["idProfesorSicpa"];
		$datosMenu = array("seccion"=>"participacion");

		$datos["idUsuario"] = $this->session->all_userdata()["idUsuario"];
		$datos["idEvaluado"] = $this->session->all_userdata()["idEvaluado"];

		$datos["cargo"] = $this->cargo_model->buscaCargoPorIdProfesor($id);
		$datos["comisiones"] = $this->comisionevaluadora_model->buscaComisionEvaluadoraPorIdProfesor($id);

		$this->load->model('pride/evaluado_model');
		$this->load->view("header");
		$this->load->view("evaluado/navegacion",$datosMenu);
		$this->load->view("evaluado/participacionInstitucional",$datos);
		$this->load->view("footer");
	}
	
	
}

?>