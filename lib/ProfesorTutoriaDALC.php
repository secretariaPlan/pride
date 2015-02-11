<?php
//El DALC para tutorias
//Javier Alpizar, 26 Feb 08
//No se usa


include_once("phplib/DbFactory.inc.php");
include_once("ProfesorTutoria.php");


class ProfesorTutoriaDALC
{
	//Regresa un arreglo de programas en los que esta el profesor
	public static function ObtenProgramas($profesorId)
	{
		$programas = array();
		$tutorias = array();
		
		$tutoria = New Tutoria();
		$tutoria->Carrera = "Ingenieria Quimica";
		$tutoria->Reuniones =3;
		$tutoria->Tutorado = "Javier Alpizar Morales";
		$tutoria->Semestre = "2007-8";
		$tutorias[] = $tutoria;
		
		$tutoria = New Tutoria();
		$tutoria->Carrera = "Ing. en alimentos";
		$tutoria->Reuniones =3;
		$tutoria->Tutorado = "Salvador Alpizar Morales";
		$tutoria->Semestre = "2008-1";
		$tutorias[] = $tutoria;
		
		$programa = new ProgramaDeTutoria();
		$programa->Nombre = "Programa Nacional de Becas (PRONABES)";
		$programa->Tutorias = $tutorias;
		$programas[] = $programa;

		$tutorias = array();
		
		$tutoria = New Tutoria();
		$tutoria->Carrera = "Matematicas 1";
		$tutoria->Reuniones =4;
		$tutoria->Tutorado = "Javier X";
		$tutoria->Semestre = "2008-1";
		$tutorias[] = $tutoria;
		
		$programa = new ProgramaDeTutoria();
		$programa->Nombre = "Programa Nacional de Becas (PRONAI)";
		$programa->Tutorias = $tutorias;
		$programas[] = $programa;
		
		return $programas;
		
		
	}
}
?>