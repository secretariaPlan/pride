<?php
//Para hacer busquedas dentro del sistema
//Javier Alpizar, 19 Junio 08

include_once("phplib/DbFactory.inc.php");

class BuscarDALC
{
	public static function BuscarSeccion($texto)
	{
		$arr= array();
		if ($texto == "")
			return $arr;
		$oDb = DbFactory::ObtenDb();
		
		$query = "select id,texto,link,seccion,parte from buscar_seccion where texto like '%".$texto."%'";
		
		
		$oDb->query($query);
		//echo $query;
		
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("id"=>$rs["id"],"texto"=>$rs["texto"],"link"=>$rs["link"],"seccion"=>$rs["seccion"],"parte"=>$rs["parte"]);
		}
		return $arr;
		
	}
}

?>