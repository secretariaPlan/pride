<?php
//EL DACL para materiales diseñados por el prof.
//Javier Alpizar, 27 feb 08

include_once("phplib/DbFactory.inc.php");
include_once("ProfesorFormacion.php");

class ProfesorFormacionDALC
{
	//Obtiene un arr de clases tipo q a su vez contienen los proyectos desarrollados por tal tipo
	public static function ObtenTipos($profesorId)
	{
		$tipos = array();
		
		$proyectos = array();
		
		$proyecto = new Proyecto();
		$proyecto->Nombre = "Tecnicas basicas 1";
		$proyecto->Alumno = "Jorge Reyes";
		$proyecto->Inicio = date("Y-m-d");
		$proyecto->Fin = date("Y-m-d");
		$proyecto->Horas = 120;
		
		$proyectos[] = $proyecto;
		
		$proyecto = new Proyecto();
		$proyecto->Nombre = "Tecnicas basicas 2";
		$proyecto->Alumno = "Jorge Reyes";
		$proyecto->Inicio = date("Y-m-d");
		$proyecto->Fin = date("Y-m-d");
		$proyecto->Horas = 100;
		
		$proyectos[] = $proyecto;
		
		
		$tipo = new Tipo();
		$tipo->Id=1;
		$tipo->Nombre = "Estancias cortas";
		$tipo->Proyectos = $proyectos;
		
		$tipos[] = $tipo;
		
		return $tipos;
		
	}
}

?>