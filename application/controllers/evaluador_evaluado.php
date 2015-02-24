<?php
class Evaluador_Evaluado extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();

		$this->load->model('pride/evaluadorEvaluado');
	}
	
	
	public function index(){
		$data['evaluador_evaluado'] = $this->evaluadorEvaluado->relaciona_profesor();
		
	}
	
	public function relacionar(){
		$data = array(
			'id_evaluador' => 1, //Datos de prueba para ello en la bd se le agrego registros a la tabla evaluador
			'id_evaluado' => 1, //Datos de prueba para ello en la bd se le agrego registris a la tabla evaluado
			
		);
		
		$this->evaluadorEvaluado->relaciona_profesor($data['id_evaluador'],$data['id_evaluado']);
		echo("El dato se relaciono correctamente");
		
	}
	
}

?>