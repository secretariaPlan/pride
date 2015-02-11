<?php
class Login extends CI_Controller
{
	public function  __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('login_model');
	}
	
	public function index(){
		//$datos['arrTipo'] = $this->login_model->get_tipo();
		$this->load->view('login_view');
	}
	
	
/*	function very_tipo($tipo)
	{
		$variable = $this->logion_model->very($tipo,'tipo');
		if($variable == true)
		{
			return false;
		}
		else
		{
			return true;
		}
	}*/
	
	
	function very_user($rfc)
	{
		$variable = $this->login_model->very($rfc,'rfc');
		if($variable == true)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	function very_correo($correo)
	{
		$variable = $this->login_model->very($correo,'correo');
		if($variable == true)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function very_sesion()
	{
		if($this->input->post('submit'))
		{
			$variable = $this->login_model->very_sesion();
			if($variable == true)
			{
				$variables = array(
								'rfc' => $this->input->post('rfc'),
								//'tipo' => $this->input->post('tipo'),
							);
				$this->session->set_userdata($variables);
				redirect(base_url().'panel');
			}
			else
			{
				//$data['arrTipo'] = $this->usuarios_model->get_tipo();
				$data = array('mensaje' => 'El usuario/cotraseña son incorrectos',
						//'arrTipo' => $this->login_model->get_tipo()
				);
				$this->load->view('login_view',$data);
			}
		}
		else
		{
			redirect(base_url().'login');
		}
	}
}
?>