<?php
//un clase autores para poder almacenar nombres y funciones
//Javier Alpizar, 18 Mar 08

//Para guardar y obtener los participantes de acuerso a su funcion
class Autores
{
	private $responsables,$corresponsables,$colaboradores;
	//private $
	
	public function __construct()
	{
		$this->responsables = array();
		$this->corresponsables = array();
		$this->colaboradores = array();
	}
	
	//solo registra los valores para 1,2 y 3, responsable, corresp y colaborador
	public function Agrega($funcionId,$nombre)
	{
		switch($funcionId)
		{
			case 1:
				$this->ResponsableSet($nombre);
				break;
			case 2:
				$this->CorresponsableSet($nombre);
				break;
			case 3:
				$this->ColaboradorSet($nombre);
				break;
		}
	}
	
	public function ResponsableSet($persona)
	{
		$this->responsables[] = $persona;
	}
	
	public function ResponsablesGet()
	{
		return $this->responsables;
	}
	
	public function ColaboradorSet($persona)
	{
		$this->colaboradores[] = $persona;
	}
	
	
	
	public function ColaboradoresGet()
	{
		return $this->colaboradores;
	}
	
	public function CorresponsableSet($persona)
	{
		$this->corresponsables[] = $persona;
	}
	
	public function CorresponsablesGet()
	{
		return $this->corresponsables;
	}

	
	
}


?>