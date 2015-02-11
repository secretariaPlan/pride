<?php
//El DALC de tecnicas experimentales
//javier Alpizar, 21 mar 08


include_once("phplib/DbFactory.inc.php");


class TecnicaExperimentaDALC
{ 
		
	public static function ObtenTecnica($id)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select tecnicaId,actividad,tecnica,inicio,fin,finEstimado,concluido 
				 	from tecnica_experimenta
				    where tecnicaId = $id ";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
	
	public static function ObtenTecnicas($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select tecnicaId,tecnica, inicio,fin,finEstimado,concluido from tecnica_experimenta 
				 where profesorId=$profesorId";
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and ( 
					(inicio <= '$inicio' and fin >= '$fin') or
					(fin <= '$fin' and inicio <= '$inicio' and fin >= '$inicio') or
					(inicio >= '$inicio' and fin >= '$fin' and inicio <= '$fin' ) or
					(inicio >= '$inicio' and fin <= '$fin') or
					(inicio >= '$inicio' and inicio <= '$fin') or
					(inicio <= '$inicio' and finEstimado >= '$fin') or
					(finEstimado <= '$fin' and inicio <= '$inicio' and finEstimado >= '$inicio') or
					(inicio >= '$inicio' and finEstimado >= '$fin' and inicio <= '$fin' ) or
					(inicio >= '$inicio' and finEstimado <= '$fin') or
					(inicio >= '$inicio' and inicio <= '$fin')
					
					)";
			//el primero es para fechas q empezaron antes y terminan despues del rango
			//el segundo es para fechas q iniciaron antes del rango y terminan en el  rango
			//el tercero es para fechas q incian en el rango y terminan despues
			//el cuarto es para fechas dentro del rango
			//el quinto es para eventos que tiene fecha de inicio dentro del rango y no han acabado
			$query .= $fechas;
		}
		$query.= " order by  inicio desc";		 
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = $rs;
		}
		//$arr[] = array("tecnicaId"=>1,"tecnica"=>"x11", "inicio"=>"2001-01-01","fin"=>"2001-01-02","finEstimado"=>"","concluido"=>"No");
		return $arr;
	}
}
?>