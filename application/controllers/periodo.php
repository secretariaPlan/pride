<?php
class Periodo extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
			$this->load->model('pride/periodoModelo');
	}
	
	
	public function index(){
		$data['periodo'] = $this->periodoModelo->nuevoPeriodo();
		
	}
	
	public function agregar(){

		$data = array(
			'ano' => 2016,
			'tipo' => 1,
			
		);
		
		$periodo = $data['ano']."-".$data['tipo'];
		
		$this->periodoModelo->nuevoPeriodo($periodo);
		echo("El dato se agrego correctamente");
		
	}
	
}

?>