<?php
//Objetos de apoyo academico
//Javier Alpizar, 27 Feb 08

include_once("phplib/Fechas.inc.php");

class ApoyoAcademico
{
	public $Id,$Nombre;
	public $Asignaturas; //un arreglo q contiene objetos Asignatura integrantes del apoyo 
	
	public function __construct()
	{}
}

class Asignatura
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