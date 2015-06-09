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
	
	
	public function listaUltimoPeriodo() {
		$this->periodo->listaUltimoPeriodo();
	}
	
	public function listaSinUltimoPeriodo() {
		$this->periodo->listaSinUltimoPeriodo();
	}
	
	
	function desasignarPeriodo(){
		$id = $this->input->post("id");
	
		$this->periodo->desasignarPeriodo($id);
	}
	
}
	
	?>