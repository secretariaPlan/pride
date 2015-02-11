<?php

interface IAuxiliar
{
	public function IdGet();
	public function NombreGet();
}

class Auxiliar implements IAuxiliar
{
	public $Id, $Nombre;
	
	public function IdGet()
	{
		return $this->Id;
	}
	
	public function NombreGet()
	{
		return $this->Nombre;
	}
}

class PosgradoCursoTipo implements IAuxiliar
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


class ExtracurrCursoTipo implements IAuxiliar
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

class FueraCursoTipo implements IAuxiliar
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


class Semestre implements IAuxiliar
{
	public $Id, $Clave;
	
	public function __construct($id=0,$clave="")
	{
		$this->Id = $id;
		$this->Clave = $clave;
	}
	
	public function IdGet()
	{
		return $this->Id;
	}
	
	public function NombreGet()
	{
		return $this->Clave;
	}
}

//Ojo por simplicidad y necesidad, esta clase de definio tambien en Auxiliares
class Ciudad implements IAuxiliar
{
	public $CiudadId, $Nombre;
	
	public function __construct($id,$nombre)
	{
		$this->CiudadId = $id;
		$this->Nombre = $nombre;
	}
	
	public function IdGet()
	{
		return $this->CiudadId;
	}
	
	public function NombreGet()
	{
		return $this->Nombre;
	}
	
	
}
//Ojo por simplicidad y necesidad, esta clase de definio tambien en Auxiliares
class Pais implements IAuxiliar
{
	public $PaisId, $Nombre;
	
	public function __construct($id,$nombre)
	{
		$this->PaisId = $id;
		$this->Nombre = $nombre;
	}
	
	public function IdGet()
	{
		return $this->PaisId;
	}
	
	public function NombreGet()
	{
		return $this->Nombre;
	}
	
	
}

class Audiencia  implements IAuxiliar
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




?>