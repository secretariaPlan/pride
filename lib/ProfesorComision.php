<?php
//Un objeto comision evaluadora para el prof.
//Javier Alpizar, 26 Feb 08

include_once("phplib/Fechas.inc.php");

class ComisionEvaluadora
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

class ComisionEspecial
{
	public $Comision,$Inicio,$Concluido,$Fin,$Comisionado;
	
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

?>