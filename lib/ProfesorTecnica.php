<?php
//Un objeto Tecnica experimental
//Javier Alpizar, 28 Feb 08

include_once("phplib/Fechas.inc.php");

class TecnicaExperimental
{
	public $Nombre,$Inicio,$Concluido,$Fin;
	
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