<?php
class AgregarModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function very($variable,$campo)
	{
		$consulta = $this->db->get_where('usuario',array($campo=>$variable));
		if($consulta->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function add_user()
	{
		$this->db->insert('usuario',array(
							//'tipo'=>$this->input->post('tipo',TRUE),//
							'rfc'=>$this->input->post('rfc',TRUE),
							'nombre'=>$this->input->post('nombre',TRUE),
							'apaterno'=>$this->input->post('apaterno',TRUE),
							'amaterno'=>$this->input->post('amaterno',TRUE),
							//'password'=>$this->input->post('password',TRUE),
							'password' => md5($this->input->post("password")),
							'correo'=>$this->input->post('correo',TRUE),
							//'codigo'=>'123456',
							//'estado'=>'0'
							));
	}
	
	
	/*public function get_tipo(){
	
		// armamos la consulta
		$query = $this->db-> query('SELECT id_tipo,tipo FROM tipos');
	
		// si hay resultados
		if ($query->num_rows() > 0) {
			// almacenamos en una matriz bidimensional
			foreach($query->result() as $row)
				$arrDatos[htmlspecialchars($row->id_tipo, ENT_QUOTES)] =
				htmlspecialchars($row->tipo, ENT_QUOTES);
	
			$query->free_result();
			return $arrDatos;
		}
	}*/
	
	
	

}
?>