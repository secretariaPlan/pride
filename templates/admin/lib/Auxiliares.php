<?php

interface IAuxiliar
{
	public function IdGet();
	public function NombreGet();
}

class Auxiliar  implements IAuxiliar
{
	public $Id, $Nombre;
	
	public function __construct($id,$nombre)
	{
		$this->Id = $id;
		$this->Nombre = $nombre;
	}
	
	public function IdGet()
	{
		return $this->Id;
	}
	
	public function NombreGet()
	{
		return $this->Nombre;
	}
	
	
}


class Mes Implements IAuxiliar
{
	public $MesId, $Nombre;
	
	public function __construct($id,$nombre)
	{
		$this->MesId = $id;
		$this->Nombre = $nombre;
	}
	
	public function IdGet()
	{
		return $this->MesId;
	}
	
	public function NombreGet()
	{
		return $this->Nombre;
	}
	
	
}

class Anio Implements IAuxiliar
{
	public $AnioId, $Nombre;
	
	//id y nombre son iguales YYYY
	public function __construct($id,$nombre)
	{
		$this->AnioId = $id;
		$this->Nombre = $nombre;
	}
	
	public function IdGet()
	{
		return $this->AnioId;
	}
	
	public function NombreGet()
	{
		return $this->Nombre;
	}
	
	
}

?>