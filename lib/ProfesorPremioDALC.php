<?php
//El DALC para los premios q recibe el profesor

include_once("phplib/DbFactory.inc.php");
include_once("ProfesorPremio.php");


Class ProfesorPremioDALC
{
	//Regresa para un profesor, un arr de objetos con los tipos de premios que a recibido
	// y para cada tipo, 
	// otro arreglo con objetos Premio con los premios recibidos
	
	
	public static function ObtenPremios($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select premioId,premio.nombre as nombre,premio.institucionOtro,
					institucion_aux.nombre as institucion,caracter,
					premio.area,premio.fecha,premioTipoOtro,premio_tipo.nombre as premioTipo 
					from premio
					left join premio_tipo on premio.premioTipoId = premio_tipo.premioTipoId 
					left join institucion_aux on premio.institucionId = institucion_aux.institucionId
					where profesorId=$profesorId ";
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and fecha >= '$inicio' and fecha <= '$fin'";
			$query .= $fechas;
		}
		$query.= " order by premio.premioTipoId";
		$oDb->query($query);
		$arr = array();
		//echo $query;
		$oDb->query($query);
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("premioId" => $rs["premioId"],
			"nombre" => $rs["nombre"],
			"institucion" => ($rs["institucion"] == NULL) ? $rs["institucionOtro"] : $rs["institucion"],
			"caracter"=>$rs["caracter"],
			"area" => $rs["area"],
			"fecha" => $rs["fecha"],
			"premioTipo" => ($rs["premioTipo"] == NULL) ? $rs["premioTipoOtro"] : $rs["premioTipo"]);
		}
		
		return $arr;
		/*$arr = array( array("nombre"=>"p1","institucion"=>"UNAM","area"=>"quimica","fecha"=>"2001-01-01","premioTipo"=>"Medalla"),
			array("nombre"=>"p1","institucion"=>"UNAM","area"=>"quimica","fecha"=>"2001-01-01","premioTipo"=>"Galardon")
		);
		return $arr;*/		

	}
	
	public static function ObtenPremio($premioId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select premioId,nombre,institucionOtro,
					institucionId,area,fecha,premioTipoOtro,premioTipoId 
					from premio
					where premioId=$premioId";
		//echo $squery;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		//$premio = new Premio();
		//$premio->premioId=$rs[""];
		return $rs;
		
	}
}
 ?>