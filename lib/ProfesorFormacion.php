<?php
//Objetos para el formacion en investigacion
//Javier Alpizar, 27 Feb 08

//Tipo de formacion:Estancias cortas, jovenes en la inv 
class Tipo
{
	public $Nombre,$Id;
	public $Proyectos;  //Un arr de objetos Proyecto
	
	public function __construct()
	{}
}

class Proyecto
{
	public $Nombre,$Alumno,$Nivel,$Inicio,$Fin,$Horas;
	
	public function __construct()
	{}
}
?>