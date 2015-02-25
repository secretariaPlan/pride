<?php
class Periodo extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
			$this->load->model('pride/periodoModelo');
	}
	
	
	public function index(){
		 $this->periodoModelo->nuevoPeriodo("2016","1");
		// $data['periodo'] ->agregar("2016","1");
		
		
	}
	
	
}

?>