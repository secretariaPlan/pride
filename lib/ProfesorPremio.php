<?php
//Un objeto Premio
//Javier Alpizar, 25 Feb 08

class Premio
{
	public $Nombre,$Institucion,$Area,$Fecha;
	
	public function __construct()
	{}
	
}

//Para guardar tipo de actividad ejm. Estancias, cursos, apoyos
class TipoDePremio
{
	public $Id,$Nombre;
	public $Premios; //Es una arreglo de clases Premio pertencientes al Tipo indicado
	
	public function __construct()
	{}
	
	
}

?>