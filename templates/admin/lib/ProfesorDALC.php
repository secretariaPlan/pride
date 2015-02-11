<?php
//Dalc de profesores
//22 Abr 08

include_once("phplib/DbFactory.inc.php");

class ProfesorDALC
{
	
	//Obtiene un listado de todos los aviso limitando el numero de acuerdo al paginador
	//regrsa un arreglo 
	public static function ObtenProfesores()
	{
		$oDb = DbFactory::ObtenDb();
		
		$query = "SELECT profesorId,nombre, apaterno, amaterno from profesor order by apaterno,amaterno,nombre";
				
		$oDb->query($query);
		$arr= array();
		while ($rs = $oDb->getRecord())
		{
			$arr[] = array($rs[0],$rs[1]." ".$rs[2]." ".$rs[3]);
		}
		return $arr;
		
	}
	
	//Obtiene el id de todos los jefes de depto
	public static function ObtenJefesDepto()
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select profesorId from depto_jefe";
		$oDb->query($query);
		$arr= array();
		while ($rs = $oDb->getRecord())
		{
			$arr[] = $rs[0];
		}
		return $arr;
	}
	
	//Regresa una arr con el correo de cada profesor
	//si el arr profsIds esta vacio regresa los correos de todos los profesores
	//si no esta vacio contiene ids de profesores y regresa los correos de estos
	public static function ObtenCorreos($profsIds)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select email from profesor ";
		$profs = ""; $coma = "";
		foreach($profsIds as $profesorId)
		{
			$profs .= ($coma."profesorId=".$profesorId);
			$coma = ", or ";
		}
		if (strlen($profs) > 0)
			$query.= " where ".$profs; 
		$oDb->query($query);
		$arr= array();
		while ($rs = $oDb->getRecord())
		{
			if (strlen($rs[0]) > 0)
				$arr[] = $rs[0];
		}
		return $arr;
	}
	
	public static function BuscaProfesores($texto)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select profesor.profesorId as profesorId,status,profesor.nombre as nombre,apaterno,amaterno,depto_aux.nombre as depto 
				  from profesor 
				  left join depto_jefe on profesor.profesorId = depto_jefe.profesorId 
				  left join depto_aux on depto_jefe.deptoAuxId = depto_aux.deptoAuxId 
				  where profesor.nombreCompleto like '%$texto%' order by nombreCompleto ";
		//echo $query;
		$oDb->query($query);
		$arr= array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = $rs;
		}
		return $arr;
	}
	
	public static function ObtenProfesor($profesorId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select profesor.profesorId,profesor.nombreCompleto as nombre,status,deptoAuxId 
				  from profesor
				  left join depto_jefe on profesor.profesorId = depto_jefe.profesorId
				  where profesor.profesorId= $profesorId";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
		
	
}

?>