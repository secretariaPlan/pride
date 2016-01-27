<?php
class Periodos extends CI_Controller {

	public function  __construct()
	{
		parent::__construct();
			$this->load->model('pride/periodo_model');
				
	}
	
	public function listaPeriodo() {
		$this->periodo_model->listaPeriodo();
	}
	
	
	public function listaUltimoPeriodo() {
		$this->periodo_model->listaUltimoPeriodo();
	}
	
	public function listaSinUltimoPeriodo() {
		$this->periodo_model->listaSinUltimoPeriodo();
	}
	
	
	function desasignarPeriodo(){
		$id = $this->input->post("id");
	
		$this->periodo_model->desasignarPeriodo($id);
	}
	
}
	
	?>