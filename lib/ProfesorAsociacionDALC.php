<?php
//El DALC para asociaciones de profesor
//javier Alpizar, 26 feb 08

include_once("phplib/DbFactory.inc.php");
include_once("fecha_rango.php");
//include_once("ProfesorAsociacion.php");


class ProfesorAsociacionDALC
{
	//regresa un arreglo con objetos Asociacion
	public static function ObtenAsociaciones($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select asociacionId,asociacionOtro,asociacion_aux.Nombre as asociacion,funcionOtro,
					funcion_aux.nombre as funcion,funcionvigente,horas,inicio,fin from
					asociacion 
					left join asociacion_aux on asociacion.asociacionAuxId = asociacion_aux.asociacionAuxId
					left join funcion_aux on asociacion.funcionId = funcion_aux.funcionId
					where profesorId=$profesorId ";
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and ".Fecha_Rango::ObtenRango($inicio,$fin);
			$query .= $fechas;
		}
		$query.= " order by asociacion.asociacionAuxId";
		
		$oDb->query($query);
		$arr = array();
		//echo $query;
		$oDb->query($query);
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("asociacionId" => $rs["asociacionId"],
			"asociacion" => ($rs["asociacion"] == NULL) ? $rs["asociacionOtro"] : $rs["asociacion"],
			"funcion" => ($rs["funcion"] == NULL) ? $rs["funcionOtro"] : $rs["funcion"],
			"funcionvigente" => $rs["funcionvigente"],
			"inicio" => $rs["inicio"],
			"fin"=>$rs["fin"],
			"horas" => $rs["horas"]);
		}
		/*$arr[] = array("asociacionId" => 1,
			"asociacion" => "Investigadores X",
			"funcion" => "Presidente",
			"funcionvigente" => "Si",
			"inicio" => "2001-01-01",
			"fin"=>"",
			"horas" => 5);*/
		return $arr;	
		/*
		$arr=array();
		$asoc = new Asociacion();
		$asoc->Funcion = "Presidente";
		$asoc->AsociacionNombre = "IEEE";
		$asoc->Inicio = date("Y-m-d");
		$asoc->Fin = date("Y-m-d");
		$arr[] = $asoc;
		
		$asoc = new Asociacion();
		$asoc->Funcion = "Miembro honorario";
		$asoc->AsociacionNombre = "TWA";
		$asoc->Inicio = date("Y-m-d");
		$asoc->Fin = date("Y-m-d");
		$arr[] = $asoc;
		return $arr;
		*/
		
	}
	
	public static function ObtenAsociacion($asocId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select asociacionId,asociacionAuxId,asociacionOtro,funcionId,funcionOtro,funcionVigente,
					inicio,fin,horas  
					from asociacion
					where asociacionId=$asocId";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		//$premio = new Premio();
		//$premio->premioId=$rs[""];
		return $rs;
		
	}
	
}
?>