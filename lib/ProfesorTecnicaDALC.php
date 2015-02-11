<?php
//El DALC para Tecnicas experimentales
//Javier Alpizar, 28 Feb 08

include_once("phplib/DbFactory.inc.php");
include_once("ProfesorTecnica.php");


class ProfesorTecnicaDALC
{ 

	public static function ObtenTecnicasExperimentales($profesorId)
	{
		$arr = array();
		$tecnica = new TecnicaExperimental();
		$tecnica->Nombre = "Decantación media";
		$tecnica->Inicio = date("Y-m-d");
		$tecnica->Concluido = "Sí";
		$tecnica->Fin = date("Y-m-d");
		$arr[] = $tecnica;
		
		$tecnica = new TecnicaExperimental();
		$tecnica->Nombre = "Osmosis invertida";
		$tecnica->Inicio = date("Y-m-d");
		$tecnica->Concluido = "No";
		$tecnica->Fin = date("");
		$arr[] = $tecnica;
		
		return $arr;
		
	}
	
	
}
?>