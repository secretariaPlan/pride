<?php
//los objetos para la superacion academica
//Javier Alpizar, 2 Mar 08
/*
//Para guardar tipo de actividad ejm. Estancias, cursos, apoyos
class TipoDeActividad
{
	public $Id,$Nombre;
	public $Actividades; //Es una arreglo de clases Carrera pertencientes al nviel indicado
	
	public function __construct()
	{}
	
	
}

//La actividad especifica cursada, ejm Curso de actualizacion
class Actividad
{
	public $Id,$Nombre,$Institucion,$Horas,$Inicio,$Fin;
	
	public function __construct()
	{}
}

*/
//La carrera especifica cursada, ejm Ingenieria en Computacion
class SuperacionAcademica
{
	
	public $superacionId,$actividadId,$actividadOtro,$nombre,
			$institucionId,$institucionOtro,$programaId,$programaOtro,
			$ciudadId,$ciudadOtro,$paisId,$paisOtro,$inicio,$fin,$horas,$expositor,$nivel,
			$evaluacion,$asignaturaId,$semestreId;
			
	public function __construct()
	{}
}



?>