<?php    
//El DALC memorias en extenso
//Javier Alpizar, 18 Mar 08

include_once("phplib/DbFactory.inc.php");


class MemoriaDALC
{ 
		
	public static function ObtenMemoria($id)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select invProdId,nombre,revista,publicacionTipo,volumen,numero,paginaInicio,paginaFin,year 
				 from i_p_memoria
				 where id = $id ";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
	
	public static function ObtenMemorias($profesorId,$yearInicio=NULL,$yearFin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id,invProdId,nombre,revista,volumen,numero,paginaInicio,paginaFin,year,publicacionTipo
				 from i_p_memoria 
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