<?php
//El edificio necesita metodos especiales
//Javier Alpizar, 16 Jul 08

include_once("phplib/DbFactory.inc.php");

class EdificioDALC
{ 
	//Las plantas para un edificio
	public static function ObtenPlantasxEdificio($edificioId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select ubicacion_planta_aux.id as id, ubicacion_planta_aux.nombre as nombre from ubicacion_planta_aux
				 join ubicacion_edificio_planta on ubicacion_edificio_planta.plantaId = ubicacion_planta_aux.id
				 where ubicacion_edificio_planta.edificioId = $edificioId";
				 
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("id"=>$rs["id"],"nombre"=>$rs["nombre"]);
							
							
		}
		return $arr;
		
	}
	
//todas las plantas
	public static function ObtenPlantas()
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select ubicacion_planta_aux.id as id, ubicacion_planta_aux.nombre as nombre from ubicacion_planta_aux";
				 
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