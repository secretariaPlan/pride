<?php

/**
 * classe  Aluno 
 * @author Eric<ciencias_exatas@hotmail.com.br>
 * @date   13/11/2014
 * @version 1.0
 */
class Profesores extends CI_Controller {

  //  private $dirView = "aluno/";
   // private $dirTemplate = "templates/template";

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('admin/profesorModel');
        $this->load->model('admin/agregarModel');
        $this->load->library('form_validation');
        $this->very_sesion();
        $datousuario['profesorNombre'] = $this->session->userdata('rfc');

      //  $this->load->model('estadoModel');
        //$this->load->model('municipioModel');
    }

    /**
     * método principal do controller
     */
    public function index() {
        $data = array();
        try {
        	$datos['profesorNombre'] = $this->session->userdata('rfc');
           // $data['estados'] = $this->estadoModel->listar();
        } catch (Exception $e) {
            $data['erro'] = "Falha ao listar estados" . $e->getMessage();
        }
       // $this->template->load($this->dirTemplate, $this->dirView . 'cadastrar-aluno', $data);
       
    }

    
    
    function very_sesion()
    {
    
    	if ($this->db->table_exists('administrador'))
    
    		
    	{
    
    			
    		if(!$this->session->userdata('rfc'))
    			
    		{
    			$this->session->sess_destroy();
    			redirect(base_url().'admin/login');
    		}
    			
    	}
    		
    	else{
    
    		$this->session->sess_destroy();
    		redirect(base_url().'admin/login');
    	}
    		
    		
    		
    
    }
    
    
    

    function salir (){
    	$this->session->sess_destroy();
    	redirect(base_url().'admin/login');
    
    }

    
    
    /**
     * esse método é chamado por uma requisição ajax
     * então o id do estado é recuperado e é realizada a consulta de todos
     * municipios relacionadas aquele estado
     */
  /* public function listarMunicipio($idEstado) {
        try {
            $municipios = $this->municipioModel->listarPorIdEstado($idEstado);
            if (empty($municipios)) {
                echo '<option value="">Nenhum município encontrado</option>';
            } else {
                foreach ($municipios as $m) {
                    echo '<option value="' . $m->id_municipio . '">' . $m->nome_municipio . '</option>';
                }
            }
        } catch (Exception $ex) {
            echo "Erro" . $ex->getMessage();
        }
    }*/

 /*  public function cadastrar() {
        $this->regras();
        $this->form_validation->set_rules('rfc', 'RFC', 'required|min_length[3]|max_length[45]|is_unique[usuario.rfc]');
        if ($this->form_validation->run()) {
            try {
                $data = array(
                    "rfc" => $this->input->post('rfc'),
                    "nombre" => $this->input->post('nombre'),
                    "apaterno" => $this->input->post('apaterno'),
                    "amaterno" => $this->input->post('amaterno'),
                    "correo" => $this->input->post('correo'),
					"password" => $this->input->post('password')
                );
                if ($this->profesorModel->cadastrar($data)) {
                    $data['sucesso'] = " cadastrado com sucesso";
                } else {
                    $data['erro'] = "Falha ao cadastrar ";
                }
            } catch (Exception $ext) {
                $data['erro'].=", erro:" . $ext->getMessage();
            }
        }

        try {
            //$data['estados'] = $this->estadoModel->listar();
        } catch (Exception $e) {
            //$data['erro'] = "Falha ao listar estados" . $e->getMessage();
        }
        $this->template->load($this->dirTemplate, $this->dirView . 'cadastrar-aluno', $data);
    }

    /**
     * listar
     */
   public function listar() {
        try {
            $data = array(
            		"profesorNombre" => $this->session->userdata('rfc'),
            		"usuario" => $this->profesorModel->listar()
            );
        } catch (Exception $e) {
            echo "Falha ao listar" . $e->getMessage();
        }
        $this->load->view('admin/listar_profesores_view',$data);
        //$this->template->load($this->dirTemplate, $this->dirView . 'listar-aluno', $data);
    }

    /**
     * editar
     * @param type $id
     */
    public function editar($id) {
        if (empty($id) || !is_numeric($id)) {
            redirect('admin/profesores/listar');
        }

        $this->regras();
        $this->form_validation->set_rules('rfc', 'rfc', 'required|min_length[3]|max_length[45]');

        //significa que  passou nas regras de validação
        if ($this->form_validation->run()) {
            try {
                $data = array(
                  	"rfc" => $this->input->post('rfc'),
                    "nombre" => $this->input->post('nombre'),
                    "apaterno" => $this->input->post('apaterno'),
                    "amaterno" => $this->input->post('amaterno'),
                    "correo" => $this->input->post('correo'),
					'password' => md5($this->input->post("password"))
                );
                if ($this->profesorModel->editar($id, $data)) {
                    $data['suceso'] = " Datos editados Correctamente";
                } else {
                    $data['error'] = "Falta Editar ";
                }
            } catch (Exception $ext) {
                $data['error'].=", error:" . $ext->getMessage();
            }
        }

        try {
        	$data['profesorNombre'] = $this->session->userdata('rfc');
            $data['usuario'] = $this->profesorModel->listar($id);
        } catch (Exception $e) {
            echo "Falha ao listar" . $e->getMessage();
        }

        $this->load->view('admin/editar_profesores_view',$data);
       // $this->template->load($this->dirTemplate, $this->dirView . 'editar-aluno', $data);
    }

    public function eliminar($id) {
        try {
            $this->profesorModel->eliminar($id);
        } catch (Exception $exc) {
            echo "No se pudo eliminar " . $exc->getMessage();
        }
    }

    /**
     * método para setar uma única vez as regras de validação
     */
    private function regras() {
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
			
    }
    
    
    
    
    public function agregar(){
    	//$datos['arrTipo'] = $this->registro_model->get_tipo();
    	$datos['profesorNombre'] = $this->session->userdata('rfc');
    	$this->load->view('admin/agregar_profesores_view',$datos);
    }
    
    
    
    function very_user($rfc)
    {
    	$variable = $this->agregarModel->very($rfc,'rfc');
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
    	$variable = $this->agregarModel->very($correo,'correo');
    	if($variable == true)
    	{
    		return false;
    	}
    	else
    	{
    		return true;
    	}
    }
    
    
    
    public function agregar_very()
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
    			$this->agregarModel->add_user();
    			$data = array('mensaje'=>'El usuario se registro correctamente',
    					//'arrTipo' => $this->registro_model->get_tipo()
    			);
    
    				
    
    			$this->load->view('admin/agregar_profesores_view',$data);
    		}
    		else
    		{
    			$datos = array('mensaje'=>'Asegúrese de Llenar todos los campos',
    					'profesorNombre' => $this->session->userdata('rfc'),
    					
    					
    					
    					//'arrTipo' => $this->registro_model->get_tipo()
    
    
    
    
    			);
    			$this->load->view('admin/agregar_profesores_view',$datos);
    		}
    	}
    	else
    	{
    		redirect(base_url().'admin/profesores/agregar');
    	}
    }
    
    
    

}
