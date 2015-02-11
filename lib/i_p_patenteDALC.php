<?php
//El DALC de patentes
//Javier Alpizar, 18 Mar 08

include_once("phplib/DbFactory.inc.php");


class PatenteDALC
{ 
		
	public static function ObtenPatente($id)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select invProdId,nombre,publicacionTipo,tipo,estatus,year,registroNumero,patenteNumero,pais,descripcion
				 	from i_p_patente
				    where id = $id ";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
	
	//estatus: C concedido, T en tramite
	//tipo: P patente, D desarrollo tecnologico
	public static function ObtenPatentes($profesorId,$yearInicio=NULL,$yearFin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id,invProdId,nombre,publicacionTipo,year,tipo,estatus,registroNumero,patenteNumero,pais,descripcion from i_p_patente 
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
						"tipo"=>"D","paginaInicio"=>1,"paginaFin"=>2,"year"=>2007,"isbn"=>"123-456","editorial"=>"random","paginas"=>10);*/
		return $arr;
	}
	
}
?>