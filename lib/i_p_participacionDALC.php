<?php
//El DALC de participacion (agradecimientos)
//Javier Alpizar, 18 Mar 08

include_once("phplib/DbFactory.inc.php");


class ParticipacionDALC
{ 
		
	public static function ObtenParticipacion($id)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select invProdId,nombre,publicacionTipo,impactoIndice,revista,volumen,numero,paginaInicio,paginaFin,year,
					autocitas,citas,citasDatos,formatoElectronico,url,motivo
				 	from i_p_participacion
				    where id = $id ";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
	
	public static function ObtenParticipaciones($profesorId,$yearInicio=NULL,$yearFin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id,invProdId,nombre,revista,publicacionTipo,impactoIndice,volumen,numero,paginaInicio,paginaFin,year, 
				 autocitas,citas,citasDatos,formatoElectronico,url,motivo from i_p_participacion 
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
						"paginaInicio"=>1,"paginaFin"=>2,"year"=>2007);*/
		return $arr;
	}
	
}
?>