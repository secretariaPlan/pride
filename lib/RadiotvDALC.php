<?php
//El DALC para progs de radio tv, menu 5
//Javier Alpizar, 18 Abr 08

include_once("phplib/DbFactory.inc.php");



class RadiotvDALC
{ 

	public static function ObtenProgramas($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id,nombre,tema,fecha from radiotv
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
		//$arr[] = array("id"=>1,"nombre"=>"ev1","tema"=>"trabajo","fecha"=>"2001-01-01");
		return $arr;
		
	}
	
	public static function ObtenPrograma($id)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id,nombre,tema,fecha  
		from radiotv
		where id = $id";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	
	}
	
	
}