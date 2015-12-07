<?php 
class Usuario_Controller extends CI_Controller {
	
	public function  __construct()
	{
		parent::__construct();
		$this->load->model('pride/usuario_model');
		
	}

	function cambiarPassword(){
		$id = $this->input->post("idUsuario");
		$password = $this->input->post("password");

		$this->usuario_model->cambiarPassword($id,$password);
	}
}
?>