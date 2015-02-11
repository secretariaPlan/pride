<?php
class Formulario extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('form_validation');
	}
	
	public function index()
	{
		$data = array (
				'titulo' => 'Formulario de mi web'
				
		);
		$this->load->view('formulario_view', $data);
	}
	public function  validar()
	{
			$this->form_validation->set_rules('nombre','Nombre de Usuario','required');
			$this->form_validation->set_rules('pass','Intridusca su Contraseña','required');
			$this->form_validation->set_message('required','El campo %s es obligatorio');
			if($this->form_validation->run() == FALSE)
			{
				$this->index();
			}
			else {
				$this->load->view('form_success');
			}
		
	}
}


?>