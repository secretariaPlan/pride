<?php
class Comisiones extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
			$this->load->model('pride/comision');
				
	}
	
	public function listaComision() {
		$this->comision->listaComision();
	}
	
	
}
	
	?>