<?php    
//El DALC prod Otros de inv
//Javier Alpizar, 18 Mar 08

include_once("phplib/DbFactory.inc.php");


class OtroDALC
{ 
		
	public static function ObtenOtro($id)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select invProdId,nombre,descripcion,year 
				 from i_p_otro
				 where id = $id ";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
	
	public static function ObtenOtros($profesorId,$yearInicio=NULL,$yearFin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id,invProdId,nombre,descripcion,year 
				 from i_p_otro 
				 where profesorId=$profesorId";
		if ($yearInicio != NULL or $yearFin != NULL)
		{
			$fechas = " and year >= '$yearInicio' and year <= '$yearFin'";
			$query .= $fechas;
		}
		$query.= " order by  year desc";		 
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = $rs;
		}
		
		return $arr;
	}
}
?>