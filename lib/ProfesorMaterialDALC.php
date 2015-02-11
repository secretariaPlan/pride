<?php
//EL DACL para materiales diseñados por el prof.
//Javier Alpizar, 27 feb 08

include_once("phplib/DbFactory.inc.php");
include_once("ProfesorMaterial.php");

class ProfesorMaterialDALC
{
	//Obtiene un arr de clases nivel q a su vez contienen los materiales desarrollados por tal nivel
	public static function ObtenNiveles($profesorId)
	{
		$niveles = array();
		
		$materiales = array();
		
		$material = new Material();
		$material->Tipo = "Elaboracion de problemas";
		$material->Asignatura = "1828-Aceracion";
		$material->Nombre = "Problemas selectos 1";
		$material->Inicio = date("Y-m-d");
		$material->Fin = date("Y-m-d");
		$materiales[] = $material;
		
		$material = new Material();
		$material->Tipo = "Elaboracion de problemas";
		$material->Asignatura = "1838-Procesos";
		$material->Nombre = "Problemas selectos 2";
		$material->Inicio = date("Y-m-d");
		$material->Fin = date("Y-m-d");
		$materiales[] = $material;
		
		$nivel = new Nivel();
		$nivel->Id=1;
		$nivel->Nombre = "Licenciatura";
		$nivel->Materiales = $materiales;
		
		$niveles[] = $nivel;
		
		return $niveles;
		
	}
}

?>