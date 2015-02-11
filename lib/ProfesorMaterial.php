<?php
//Objetos para el materiaal diseñado por el profesor
//Javier Alpizar, 27 Feb 08

//El nivel (Licenciatura, Maestria, ... del material
class Nivel
{
	public $Nombre,$Id;
	public $Materiales;  //Un arr de objetos Tipo
	
	public function __construct()
	{}
}

class Material
{
	public $Tipo,$Asignatura,$Nombre,$Inicio,$Fin;
	
	public function __construct()
	{}
}
?>