<?php
//El DALC de libro
//Javier Alpizar, 18 Mar 08

include_once("phplib/DbFactory.inc.php");


class LibroDALC
{ 
		
	public static function ObtenLibro($id)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select invProdId,nombre,publicacionTipo,isbn,year,volumen,coleccion,edicion,editor,editorial,
					pais,ciudad,paginas,tiraje,autocitas,citas,citasDatos 
				 	from i_p_libro
				    where id = $id ";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
	
	public static function ObtenLibros($profesorId,$yearInicio=NULL,$yearFin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id,invProdId,nombre,publicacionTipo,isbn,volumen,coleccion,edicion,editor,editorial,year,
				pais,ciudad,paginas,tiraje,citas,autocitas,citasDatos 
				 from i_p_libro
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
		/*$arr[] = array("id"=>1,"invProdId"=>1,"nombre"=>"Quimica aplicada","revista"=>"Science","volumen"=>"XX","numero"=>1,
						"paginaInicio"=>1,"paginaFin"=>2,"year"=>2007,"isbn"=>"123-456","editorial"=>"random","paginas"=>10);*/
		return $arr;
	}
}
?>