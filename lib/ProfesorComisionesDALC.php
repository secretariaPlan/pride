<?php
//El DALC para comisiones evaluadoras
//Javier Alpizar, 26 Feb 08

include_once("phplib/DbFactory.inc.php");
include_once("fecha_rango.php");
//include_once("ProfesorComision.php");


class ProfesorComisionesDALC
{ 

	public static function ObtenComisionesEvaluadoras($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select comisionId,comision_eval_aux.nombre as comision,inicio,fin,concluido,comisionEvalOtro,
				funcionId,institucionId,institucionOtro,comision_evaluadora.facultadId,
				facultad_aux.nombre as facultad,facultadOtro,consejo   
		from comision_evaluadora
		left join comision_eval_aux on comision_evaluadora.comisionEvalAuxId = comision_eval_aux.comisionEvalAuxId
		left join facultad_aux on comision_evaluadora.facultadId = facultad_aux.facultadId 
		where profesorId=$profesorId ";
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and ".Fecha_Rango::ObtenRango($inicio,$fin);
			//el primero es para fechas q empezaron antes y terminan despues del rango
			//el segundo es para fechas q iniciaron antes del rango y terminan en el  rango
			//el tercero es para fechas q incian en el rango y terminan despues
			//el cuarto es para fechas dentro del rango
			//el quinto es para eventos que tiene fecha de inicio dentro del rango y no han acabado
			$query .= $fechas;
		}
		$query.= " order by fin desc";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("comisionId"=>$rs["comisionId"],
			"funcionId"=>$rs["funcionId"],
			"institucion"=>($rs["institucionId"] == 1) ? "UNAM" : $rs["institucionOtro"],
			"nombre"=>($rs["comision"] == NULL) ? $rs["comisionEvalOtro"] : $rs["comision"],
			"facultad"=>($rs["facultad"] == NULL) ? $rs["facultadOtro"] : $rs["facultad"],
			"consejo"=>($rs["consejo"] == NULL) ? "" : $rs["consejo"],
			"inicio"=>$rs["inicio"],"fin"=>$rs["fin"],"concluido"=>$rs["concluido"]);
		}
		
		return $arr;
		
	}
	
	public static function ObtenComisionEvaluadora($comisionId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select comisionId,comisionEvalAuxId,inicio,fin,concluido,comisionEvalOtro,institucionId,institucionOtro,
				  asignaturaId,asignaturaOtro,consejo,
					funcionId,facultadId,facultadOtro
		from comision_evaluadora
		where comisionId = $comisionId";
		$arr = array();
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	
	}
	
	public static function ObtenComisionesEspeciales($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		/*$query = "select comisionId,comision_eval_aux.nombre as comision,inicio,fin,concluido,comisionEvalOtro 
		from comision_evaluadora
		left join comision_eval_aux on comision_evaluadora.comisionEvalAuxId = comision_eval_aux.comisionEvalAuxId
		where profesorId=$profesorId ";*/
		
		$query = "select comisionId,comision_especial_aux.nombre as comision,comisionEspOtro,inicio,fin,concluido,comisionador 
		from comision_especial
		left join comision_especial_aux on comision_especial.comisionEspAuxId = comision_especial_aux.id
		where profesorId=$profesorId ";
	    if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and ".Fecha_Rango::ObtenRango($inicio,$fin);
			$query .= $fechas;
		}
		$query.= " order by inicio desc";
		//$oDb->query($query);
		$arr = array();
		//echo $query;
		$oDb->query($query);
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("comisionId"=>$rs["comisionId"],
							"nombre"=>($rs["comision"] == NULL) ? $rs["comisionEspOtro"] : $rs["comision"],
							"inicio"=>$rs["inicio"],"fin"=>$rs["fin"],
				"concluido"=>$rs["concluido"],"comisionador"=>$rs["comisionador"]);
		}
		/*$arr[] = array("comisionId"=>1,
							"nombre"=>"x11",
							"inicio"=>"2001-01-01","fin"=>"2002-02-02",
				"concluido"=>"No","comisionador"=>"alpi");*/
		
		return $arr;
	}
	
	public static function ObtenComisionEspecial($comisionId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select comisionId,comisionEspAuxId,comisionEspOtro,subprog121,subprog127,inicio,fin,concluido,comisionador 
		from comision_especial 
		where comisionId = $comisionId";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	
	}
	
			
}