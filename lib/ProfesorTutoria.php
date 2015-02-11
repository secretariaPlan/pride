<?php
//Un objeto tutoria y programa que lo contiene
//Javier Alpizar, 26 de feb 08

class ProgramaDeTutoria
{
	public $Nombre,$Id;
	public $Tutorias; //un arreglo con las tutorias del programa.
	
	public function __construct()
	{}
}

class Tutoria
{
	public $Carrera,$Tutorado,$Reuniones,$Semestre;
	
	public function __construct()
	{}
}
?>