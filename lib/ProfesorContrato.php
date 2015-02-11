<?php
//Un obj para los datos del profesor
//Javier Alpizar, 25 Feb 08

class Contrato
{
	public $FechaIngreso,$NumTrabajador;
	
	public function __construct()
	{}
}

class Ubicacion
{
	public $ProfesorId,$Edificio,$Planta,$Oficina,$Tel8,$Tel5,$Tel3,$Fax,$EdificioId,$PlantaId;
	
	public function __construct()
	{}
}

//Guarda un nombramiento dentro de facultad de quim
class NombramientoFacultad
{
	public $Nombre,$Categoria,$Nivel,$Tiempo,$TipoContrato,$Inicio,$Fin,$Departamento;
	public $id;	
	public function __construct()
	{}
}

//Guarda un nombramiento dentro de la UNAM fuera de FQ
class NombramientoUNAM extends NombramientoFacultad
{
	public $Entidad,$EntidadNombre;
		
	public function __construct()
	{}
}

class EmpleoOtro
{
	public $Id,$Empresa,$Puesto,$Inicio,$Fin;

	public function __construct()
	{}
}
?>