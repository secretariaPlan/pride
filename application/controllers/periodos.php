<?php
class Periodos extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
			$this->load->model('pride/periodo');
				
	}
	
	public function listaPeriodo() {
		$this->periodo->listaPeriodo();
	}
	
	
}
	
	?>