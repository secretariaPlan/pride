<?php
class Tipos_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	

	
	
	public function get_tipo(){
	
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
	}
	
	

}