<?php

class Panel extends CI_Controller
{
	public function  __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->very_sesion();
		
	}
	
	public function index()
	{
		//echo "Hola usuario: ".$this->session->userdata('usuario');
		//$datos['profesorNombre'] = $this->session->userdata('usuario');
		
		//$tipo['profesorTipo'] = $this->session->userdata('tipo');
		
		$datos = array("profesorNombre" =>$this->session->userdata('rfc'),
				"profesorTipo" => $this->session->userdata('tipo'),
		);
		
		
		
		$this->load->view('panel_view',$datos);
		
	}
	
	function very_tipo($tipo)
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
	}
	
	
	function very_sesion()
	{
			if ($this->db->table_exists('usuario'))
		{
					
	
			if(!$this->session->userdata('rfc'))
			
			
			{
				redirect(base_url().'login');
			}
			
		}
		
		else 
		{
			$this->session->sess_destroy();
			redirect(base_url().'login');
			
		}
		
		
	}
	
	
	
	
	
	

	
	function salir (){
		$this->session->sess_destroy();
			redirect(base_url().'login');
		
	}
	
	public function removeCache()
	{
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		
	}
}

?>