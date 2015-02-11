<?php
//Las areas de inv necesita metodos especiales
//Javier Alpizar, 16 Jul 08

include_once("phplib/DbFactory.inc.php");

class AreasInvDALC
{ 
	//Las areas de un depto
	public static function ObtenAreasxDepto($departamentoId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select investigacion_linea.invLineaId as id, investigacion_linea.nombre as nombre from investigacion_linea
				 join depto_investigacion_linea on investigacion_linea.invLineaId = depto_investigacion_linea.invLineaId
				 where depto_investigacion_linea.departamentoId = $departamentoId order by nombre";
				 
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("id"=>$rs["id"],"nombre"=>$rs["nombre"]);
							
							
		}
		return $arr;
		
	}
	
//todas las areas
	public static function ObtenAreas()
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select investigacion_linea.invLineaId as id, investigacion_linea.nombre as nombre from investigacion_linea order by nombre";
				 
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("id"=>$rs["id"],"nombre"=>$rs["nombre"]);
							
							
		}
		return $arr;
		
	}
}
	
?>