<?php
class Registro extends CI_Controller
{
	public function  __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('registro_model');
	}
	
	public function index(){
		//$datos['arrTipo'] = $this->registro_model->get_tipo();
				$this->load->view('registro_view');	
	}

	
	
	function very_user($rfc)
	{
		$variable = $this->registro_model->very($rfc,'rfc');
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
		$variable = $this->registro_model->very($correo,'correo');
		if($variable == true)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	
	
	public function registro_very()
	{
		if($this->input->post('submit_reg'))
		{
			
			$this->form_validation->set_rules('nombre','Nombre','required');
			$this->form_validation->set_rules('apaterno','Apellido Paterno','required');
			$this->form_validation->set_rules('amaterno','Apellido Materno','required');
			$this->form_validation->set_rules('correo','Correo','required|trim|valid_email|callback_very_correo');
			$this->form_validation->set_rules('rfc','RFC','required|trim|callback_very_user');
			$this->form_validation->set_rules("password", "Contraseña", "trim|required|min_length[4]|max_length[32]");
			$this->form_validation->set_rules("pass2", "Confirme Contraseña", "trim|required|matches[password]");
			//$this->form_validation->set_rules('password','Contraseña','required|trim|min_length[6]');
			//$this->form_validation->set_rules('pass2','Confirme Contraseña','required|trim|matches[password]');

			$this->form_validation->set_message('required','El  campo %s es obligatorio');
			$this->form_validation->set_message('valid_email','Ingrese un %s correo valido');
			$this->form_validation->set_message('matches','El  campo %s no es igual que el campo Contraseña');
			$this->form_validation->set_message('min_length','El  campo %s debe tener como minio 6 caracteres');
			$this->form_validation->set_message('very_correo','El  campo %s ya existe');
			$this->form_validation->set_message('very_user','El %s ya existe');
			
			
			
			
			
			
						
			if($this->form_validation->run() != FALSE)
			{
				$this->registro_model->add_user();
				$data = array('mensaje'=>'El usuario se registro correctamente',
						//'arrTipo' => $this->registro_model->get_tipo()
				);
				
					
				
				$this->load->view('registro_view',$data);
			}
			else
			{
				$datos = array('mensaje'=>'Asegúrese de Llenar todos los campos',
						//'arrTipo' => $this->registro_model->get_tipo()
						
						
						
						
				);
				$this->load->view('registro_view',$datos);
			}
		}
		else
		{
			redirect(base_url().'registro');
		}
	}
	

}
?>