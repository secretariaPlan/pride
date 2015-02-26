<?php
use ActiveRecord\Model;
class Periodos extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
			$this->load->model('pride/periodo');
				
	}
	
	
	public function index(){
		 $this->periodo->nuevoPeriodo("2016","1");
	
		// $data['periodo'] ->agregar("2016","1");
		
	}
}
	
	?>