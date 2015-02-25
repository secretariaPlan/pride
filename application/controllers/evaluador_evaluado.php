<?php
class Evaluador_Evaluado extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();

		$this->load->model('pride/evaluadorEvaluado');
	}
	
	
	public function index(){

	
	$this->evaluadorEvaluado->relaciona_profesor("1","1");
	echo("El dato se relaciono correctamente");
	
		
	}
	
	

	
	
}

?>