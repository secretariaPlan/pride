<?php

/*
class LineasDeInvestigacion
{
	public $Id,$Nombre;
	
	public function __construct($id,$nombre)
	{
		$this->Id = $id;
		$this->Nombre = $nombre;
	}
}
*/

class Resumen
{
	public $ResumenId,$Texto,$ProfesorId;
	
	public function __construct($id=0,$profesorId=0,$texto="")
	{
		$this->ResumenId = $id; $this->Texto = $texto;
		$this->ProfesorId = $profesorId;
	}
}


?>