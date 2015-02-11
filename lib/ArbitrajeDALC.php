<?php
//El DALC para arbitrajes
//Javier Alpizar, 17 Abr 08

include_once("phplib/DbFactory.inc.php");
//include_once("ProfesorComision.php");


class ArbitrajeDALC
{ 

	public static function ObtenArbitrajes($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select arbitrajeId,arbitraje_aux.nombre as arbitrajeTipo,arbitrajeTipoOtro,eventoNombre,trabajoNombre,fecha 
		from arbitraje
		left join arbitraje_aux on arbitraje.arbitrajeTipoAuxId = arbitraje_aux.id
		where profesorId=$profesorId ";
		if ($inicio != NULL )
		{
			$fechas = " and fecha >= '$inicio' and fecha <= '$fin'";
			$query .= $fechas;
		}
		$query.= " order by fecha desc";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("arbitrajeId"=>$rs["arbitrajeId"],
			"arbitrajeTipo"=>($rs["arbitrajeTipo"] == NULL) ? $rs["arbitrajeTipoOtro"] : $rs["arbitrajeTipo"],
			"eventoNombre"=>$rs["eventoNombre"],"trabajoNombre"=>$rs["trabajoNombre"],"fecha"=>$rs["fecha"]);
		}
		/*$arr[] = array("arbitrajeId"=>1,
			"arbitrajeTipo"=>"x",
			"eventoNombre"=>"Reuniones anuales","trabajoNombre"=>"El quimico en la sociedad mexicana de nuestro tiempo","fecha"=>"2001-02-03");*/
		return $arr;
		
	}
	
	public static function ObtenArbitraje($arbitrajeId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select arbitrajeId,arbitrajeTipoAuxId,arbitrajeTipoOtro,eventoNombre,trabajoNombre,fecha  
		from arbitraje
		where arbitrajeId = $arbitrajeId";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	
	}
	
	
}