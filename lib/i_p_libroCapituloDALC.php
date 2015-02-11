<?php
//El DALC de capitulo de  libro
//Javier Alpizar, 18 Mar 08

include_once("phplib/DbFactory.inc.php");


class LibroCapituloDALC
{ 
		
	public static function ObtenCapituloDeLibro($id)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select invProdId,nombre,titulo,publicacionTipo,isbn,year,volumen,coleccion,edicion,editor,editorial,
					pais,ciudad,paginas,tiraje,paginaInicio,paginaFin,autocitas,citas,citasDatos  
				 	from i_p_libro_capitulo
				    where id = $id ";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
	
	public static function ObtenCapitulos($profesorId,$yearInicio=NULL,$yearFin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id,invProdId,nombre,publicacionTipo,titulo,isbn,volumen,coleccion,edicion,editor,editorial,year,
				pais,ciudad,paginas,tiraje,paginaInicio,paginaFin,citas,autocitas,citasDatos
				 from i_p_libro_capitulo
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
						"paginaInicio"=>1,"paginaFin"=>2,"year"=>2007,"isbn"=>"123-456","editorial"=>"random","paginas"=>10);*/
		return $arr;
	}
}
?>