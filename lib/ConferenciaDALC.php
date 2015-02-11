<?php
//El dalc de conferencias
//Javier Alpizar, 21 Mar 08

include_once("phplib/DbFactory.inc.php");

class ConferenciaDALC
{ 
	//Obtiene los proyectos de inv 
	public static function ObtenConferencias($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select conferenciaId,conferencia.nombre as nombre,invitacion,
				facultad_aux.nombre as facultad,facultadOtro,
				institucion_aux.nombre as institucion, institucionOtro,
				ciudad_aux.nombre as ciudad, ciudadOtro,
				pais_aux.nombre as pais,paisOtro,fecha
				from conferencia 
				left join facultad_aux on conferencia.facultadId = facultad_aux.facultadId
				left join institucion_aux on conferencia.institucionId = institucion_aux.institucionId
				left join ciudad_aux on conferencia.ciudadId = ciudad_aux.ciudadId
				left join pais_aux on conferencia.paisId = pais_aux.paisId
				where profesorId = $profesorId ";
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and fecha >= '$inicio' and fecha <= '$fin'";
			$query .= $fechas;
		}
		$query.= " order by  fecha desc";
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("conferenciaId"=>$rs["conferenciaId"],
							"nombre"=>$rs["nombre"],
							"invitacion"=>$rs["invitacion"],
							"fecha"=>$rs["fecha"],
							"facultad"=>($rs["facultad"]==NULL) ? $rs["facultadOtro"] : $rs["facultad"],
							"institucion"=>($rs["institucion"]==NULL) ? $rs["institucionOtro"] : $rs["institucion"],
							"ciudad"=>($rs["ciudad"]==NULL) ? $rs["ciudadOtro"] : $rs["ciudad"],
							"pais"=>($rs["pais"]==NULL) ? $rs["paisOtro"] : $rs["pais"]
						  );
		}
		/*$arr[] = array("conferenciaId"=>1,
							"nombre"=>"Conf X",
							"invitacion"=>"Si",
							"fecha"=>"2001-01-01",
							"facultad"=>"FQ",
							"institucion"=>"UNAM",
							"ciudad"=>"DF",
							"pais"=>"MEXICO"
						  );*/
		return $arr;
	}

	public static function ObtenConferencia($conferenciaId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select conferenciaId,conferencia.nombre as nombre,invitacion,
				facultadId,facultadOtro,
				institucionId, institucionOtro,
				ciudadId, ciudadOtro,
				paisId,paisOtro,fecha
				from conferencia 
				where conferenciaId = $conferenciaId";
		$oDb->query($query);
		$arr = array();
		$rs = $oDb->getRecord("C");
		return $rs;
	}
}
?>