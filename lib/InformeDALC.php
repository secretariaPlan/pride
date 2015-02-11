<?php

include_once("phplib/DbFactory.inc.php");

class InformeDALC
{
	
	public static function ObtenReporte($year)
	{
		$oDb = DbFactory::ObtenDb();
		
		$query = 'select nombre,apaterno,amaterno,rfc,email,terminado from profesor 
		left join profesor_informe on profesor.profesorId = profesor_informe.profesorId
		where status=1 and year="'.$year.'" order by apaterno,amaterno,nombre';
		//echo $query;
		$oDb->query($query);
		$arr=array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = $rs;
		}
		return $arr;
	}
}
?>