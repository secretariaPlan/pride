<?php
//El DALC de informe
//Javier Alpizar, 18 Mar 08

include_once("phplib/DbFactory.inc.php");


class InformeDALC
{ 
		
	public static function ObtenInforme($id)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select invProdId,nombre,year,paginas,instancia,publicacionTipo,descripcion
				 	from i_p_informe
				    where id = $id ";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
	
	public static function ObtenInformes($profesorId,$yearInicio=NULL,$yearFin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id,invProdId,nombre,publicacionTipo,year, 
				 paginas,instancia,descripcion  from i_p_informe 
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
		/*$arr[] = array("id"=>1,"invProdId"=>1,"nombre"=>"Quimica aplicada","titulo"=>"Science","volumen"=>"XX","numero"=>1,
						"instancia"=>"Consejo","paginaInicio"=>1,"paginaFin"=>2,"year"=>2007,"isbn"=>"123-456","editorial"=>"random","paginas"=>10);*/
		
		return $arr;
	}
}
?>