<?php
//los objetos para la formacion academica
//Javier Alpizar, 25 de feb 08

//Para guardar un nivel alcanzado, ej. Doctorado, Maestria, Licenciatura
class NivelAcademico
{
	public $Id,$Nombre;
	public $Carreras; //Es una arreglo de clases Carrera pertencientes al nviel indicado
	
	public function __construct()
	{}
	
	
}

//La carrera especifica cursada, ejm Ingenieria en Computacion
class FormacionAcademica
{
	
	public $formacionId,$nivelId,$nivelOtro,$carreraId,$carreraOtro,
			$institucionId,$institucionOtro,$facultadId,$facultadOtro,
			$ciudadId,$ciudadOtro,$paisId,$paisOtro,$inicio,$fin,$titulado,$tesis,$tituloFecha;
			
	public function __construct()
	{}
}



?>