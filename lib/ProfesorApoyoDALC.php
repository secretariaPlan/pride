<?php
//El DALC para apoyos economicos
//Javier Alpizar, 27 Feb 08

include_once("phplib/DbFactory.inc.php");
include_once("ProfesorApoyo.php");


class ProfesorApoyoDALC
{ 

	//Un arr de onbk apyo q contiene otro arreglo con obj asignaturas
	public static function ObtenApoyosAcademicos($profesorId)
	{
		$apoyos = array();
		
		$asignaturas = array();
		
		$asignatura = new Asignatura();
		$asignatura->Nombre = "Quimica básica";
		$asignatura->Concluido = "Si";
		$asignatura->Fin = date("Y-m-d");
		$asignatura->Inicio = date("Y-m-d");
		$asignaturas[] = $asignatura ;
		
		$asignatura = new Asignatura();
		$asignatura->Nombre = "Quimica orgánica";
		$asignatura->Concluido = "No";
		$asignatura->Fin = "";
		$asignatura->Inicio = date("Y-m-d");
		$asignaturas[] = $asignatura ;
		
		
		$apoyo = new ApoyoAcademico();
		$apoyo->Nombre = "Coordinador de asignatura";
		$apoyo->Id = 1;
		$apoyo->Asignaturas = $asignaturas;
		
		$apoyos[] = $apoyo;
		//
		$asignaturas = array();
		
		$asignatura = new Asignatura();
		$asignatura->Nombre = "Quimica analítica";
		$asignatura->Concluido = "Si";
		$asignatura->Fin = date("Y-m-d");
		$asignatura->Inicio = date("Y-m-d");
		$asignaturas[] = $asignatura ;
		
		$apoyo = new ApoyoAcademico();
		$apoyo->Nombre = "Intersemestrales";
		$apoyo->Id = 2;
		$apoyo->Asignaturas = $asignaturas;
		
		$apoyos[] = $apoyo;
			
		return $apoyos;
		
	}
}

?>