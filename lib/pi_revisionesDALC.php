<?php
//Para revisiones de parti institucional

//Javier Alpizar, 23 Mar 10

include_once("phplib/DbFactory.inc.php");

class pi_revisionesDALC
{ 
	//Obtiene las asesorias a profesor
	public static function ObtenRegistros($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id,
				nombre,editorial,fecha
				from pi_revisiones
				where profesorId = $profesorId ";
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and fecha >= '$inicio' and fecha <= '$fin'";
			$query .= $fechas;
		}
		$query.= " order by fecha desc";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = $rs;
		}
		return $arr;
	}
	
	function ObtenRegistro($id)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id,
				nombre,editorial,fecha
				from pi_revisiones
				where id = $id ";
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
	
	
}
		
?>