<?php
//Un objeto organo colegiado para el prof.
//Javier Alpizar, 26 Feb 08

include_once("phplib/Fechas.inc.php");

class OrganoColegiado
{
	public $Miembro,$Inicio,$Concluido,$Fin;
	
	public function __construct()
	{}
	
	public function Fin()
	{
		if ($this->Fin == "")
			return "Vigente";
		else
			return Fechas::FechaEspCorta($this->Fin);
	}
}

class OrganoAsesor extends OrganoColegiado
{

	public function __construct()
	{}
	
}

?>