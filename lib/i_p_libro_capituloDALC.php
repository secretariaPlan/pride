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
					pais,ciudad,paginas,tiraje,paginaInicio,paginaFin 
				 	from i_p_libro_capitulo
				    where id = $id ";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
}
?>

