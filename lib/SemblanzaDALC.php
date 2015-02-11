<?php

//El DALC para la semblanza profesional
//javier Alpizar, 22 Feb 08

include_once("phplib/DbFactory.inc.php");
include_once("Semblanza.php");


class SemblanzaDALC
{
	
	public static function ObtenSemblanza($profesorId)
	{
		$resumen = new Resumen();
		$oDb = DbFactory::ObtenDb();
		$query = "select semblanzaId,texto from semblanza where profesorId = $profesorId";
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		if (is_array($rs))
		{
			$resumen->ResumenId = $rs["semblanzaId"];
			$resumen->Texto = str_replace("\'","'",$rs["texto"]);
			$resumen->ProfesorId = $profesorId;
		}
		return $resumen; 
	}
	
	//Recibe un objeto resumen q se quiere guardar
	public static function Guardar($resumen)
	{
		
		$oDb = DbFactory::ObtenDb();
		$resumen->Texto = mysql_real_escape_string($resumen->Texto);
		$query = "update semblanza set texto='".$resumen->Texto."' where semblanzaId = $resumen->ResumenId"; 
		//echo $query;
		if ($resumen->ResumenId == 0) //es un nuevo
		{
			$query = "insert into semblanza set texto = '$resumen->Texto',profesorId= $resumen->ProfesorId";
		}
		$r = $oDb->executeNonQuery($query);
		
		//echo $query;
		
		return $r;
	}
}
	
	/*
	//regresa un listado de las lineas de investigacion disponibles para un profesor en base al depto al que pertenece
	public static function ObtenLineasDeInvestigacion($profesorId)
	{
//		$oDbNombrams = DbFactory::ObtenDb();
//		$oDbDepto = DbFactory::ObtenDb();
//		//ver todos los campos q se involucran, params se debe traer como esta del sist anterior
//		$query = "select tipo,depto from nombramientos where profesorId = $profesorId";
//		$oDbNombrams->query($query);
//		$deptos = array();
//		while ($rs = $oDbNombrams->getRecord("C"))
//		{
//			$queryDepto = "select departamentoId from departamento where tipo=".$rs["tipo"]." and numero=".$rs["depto"];
//			$oDbDepto->query($queryDepto);
//			$rsDepto = $oDbDepto->getRecord("C");
//			$queryLineas = "select invLineaId,investigacion_linea.nombre from depto_investigacion_linea 
//							join investigacion_linea on depto_investigacion_linea.invLineaId = investigacion_linea.invLineaId
//							left join lineas_profesionales on lineas_profesionales.invLineaId = investigacion_linea.invLineaId 
//							where depto_investigacion_linea.departamentoId = ".$rs["departamentoId"]." and
//							lineas_profesionales.profesorId = $profesorId;
//									
//		}
//		foreach($deptos as $depto)
//		{
//			
//		}
//		return $rs; 
	}
	
	//Regresa un arreglo de investigacion a las que pertenece un profesor
	public static function ObtenLineasDeInvestigacionActuales($profesorId)
	{
		$arr=array();
		$arr[] = new LineasDeInvestigacion(1,"Evolucion de variable");
		$arr[] = new LineasDeInvestigacion(1,"Operacion");
		$arr[] = new LineasDeInvestigacion(1,"Productividad y rentabilidad");
		return $arr;
		
	}
}

*/


?>