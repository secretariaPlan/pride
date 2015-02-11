<?php
//El DALC revista arbitrada
//Javier Alpizar, 18 Mar 08

include_once("phplib/DbFactory.inc.php");


class RevistaADALC
{ 
		
	public static function ObtenRevista($id)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select invProdId,nombre,revista,publicacionTipo,impactoIndice,volumen,numero,paginaInicio,paginaFin,year,
					autocitas,citas,citasDatos,formatoElectronico,url 
				 	from i_p_revista_a
				    where id = $id ";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
}
?>

