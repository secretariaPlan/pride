<?php
class Login_model extends CI_Model
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
	
	
	
	
	public function very_sesion()
	{
		if ($this->db->table_exists('usuario'))
		{
		
		$consulta =$this->db->get_where('usuario',array(
									'rfc'=>$this->input->post('rfc',TRUE),
									'password' => md5($this->input->post("password")),
									//'tipo' =>$this->input->post('tipo',TRUE),
									
		));
		if($consulta->num_rows() == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
		}
	}
}