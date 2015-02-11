<?php
//El DALC para ferias, menu 5
//Javier Alpizar, 18 Abr 08

include_once("phplib/DbFactory.inc.php");



class FeriaDALC
{ 

	public static function ObtenFerias($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id,eventoNombre,trabajoNombre,fecha from feria
		where profesorId=$profesorId ";
		if ($inicio != NULL )
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
		//$arr[] = array("id"=>1,"eventoNombre"=>"ev1","trabajoNombre"=>"trabajo","fecha"=>"2001-01-01");
		return $arr;
		
	}
	
	public static function ObtenFeria($id)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id,eventoNombre,trabajoNombre,fecha  
		from feria
		where id = $id";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	
	}
	
	
}