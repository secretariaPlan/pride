<?

//El DALC de organizacion de actividades
//Javier Alpizar, 22 Mar 08

include_once("phplib/DbFactory.inc.php");
include_once("fecha_rango.php");

class ActividadOtraDALC
{ 
	
	
	
	public static function ObtenActividades($profesorId,$inicio=NULL,$fin=NULL)
	{
		
		$oDb = DbFactory::ObtenDb();
		$query ="select actividadId,nombre,descripcion,inicio,fin,concluido
				from actividad_otra
				where profesorId = $profesorId ";
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = Fecha_Rango::ObtenRango($inicio,$fin);
			$query .= "and ".$fechas;
		}
		$query.= " order by  inicio desc";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = $rs;
							
							
		}
		//$arr[] = array("nombre"=>"ActividadX","inicio"=>"2001-01-01","fin"=>"2002-05-05");
		return $arr;
		
	}

	public static function ObtenActividad($actividadId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select nombre,descripcion,inicio,fin,concluido
				 from actividad_otra where actividadId = $actividadId";
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;		 
	}
}	
 ?>