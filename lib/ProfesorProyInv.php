<?php
//Un objeto proyecto de investigacion
//Javier Alpizar, 28 feb 08
//No se usa

class ProyectoDeInvestigacion
{
	public $Titulo,$Responsable,$CoResponsable;
	public $Colaboradores; //Un arreglo de objetos Colaborador
	public $Inicio,$Fin;
	public $Id;
	
	public function __construct()
	{}
	
	
}

class ProyectoContratado extends ProyectoDeInvestigacion
{
	public $Empresa;
	
	public function __construct()
	{}
	
}
?>