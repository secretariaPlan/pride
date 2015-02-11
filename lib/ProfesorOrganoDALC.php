<?php
//El DALC para organos colegiados
//Javier Alpizar, 26 Feb 08

include_once("phplib/DbFactory.inc.php");
include_once("fecha_rango.php");
//include_once("ProfesorOrgano.php");


class ProfesorOrganoDALC
{ 

	public static function ObtenOrganosColegiados($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select organoId,organocolegiado_aux.Nombre as organo,inicio,fin,concluido from
					organocolegiado 
					left join organocolegiado_aux on organocolegiado.organoAuxId = organocolegiado_aux.organoAuxId
					where profesorId=$profesorId ";
		
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and ".Fecha_Rango::ObtenRango($inicio,$fin);
			$query .= $fechas;
			
		}
		$query.= " order by organocolegiado_aux.nombre, inicio desc";
		$arr = array();
		//echo $query;
		$oDb->query($query);
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("organoId" => $rs["organoId"],
			"organo" => $rs["organo"] ,
			"inicio" => $rs["inicio"],
			"fin"=>$rs["fin"],
			"concluido" => $rs["concluido"]);
		}
		/*$arr[] = array("organoId" => 1,
			"organo" => "Organo X" ,
			"inicio" => "2001-01-01",
			"fin"=>"",
			"concluido" => "No");*/
		return $arr;	
		/*
		$arr = array();
		$organo = new OrganoColegiado();
		$organo->Miembro = "Junta de Gobierno 1";
		$organo->Inicio = date("Y-m-d");
		$organo->Concluido = "Sí";
		$organo->Fin = date("Y-m-d");
		$arr[] = $organo;
		
		$organo = new OrganoColegiado();
		$organo->Miembro = "Junta de Gobierno 2";
		$organo->Inicio = date("Y-m-d");
		$organo->Concluido = "No";
		$organo->Fin = date("");
		$arr[] = $organo;
		
		return $arr;
		*/
	}
	
	public function ObtenOrganoColegiado($organoId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select organoId,organoAuxId,inicio,fin,concluido  
					from organocolegiado
					where organoId=$organoId";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		//$premio = new Premio();
		//$premio->premioId=$rs[""];
		return $rs;
		
	}
	
	public static function ObtenOrganosAsesores($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select organoId,organoOtro,organoasesor_aux.Nombre as organo,inicio,fin,concluido from
					organoasesor 
					left join organoasesor_aux on organoasesor.organoAuxId = organoasesor_aux.organoAuxId
					where profesorId=$profesorId ";
		if ($inicio != NULL or $fin != NULL)
		{
			//Eduardo Pavon B. 25-01-2012
			//se realiza el cambio para que muestre los organos asesores actualmente activos
			//$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			$fechas="and((fin is not null AND ( fin >= '$inicio' and inicio <= '$fin')) OR ( fin is null AND inicio<'$fin'))";
			$query .= $fechas;
		}
		$query.= " order by inicio desc";
		$oDb->query($query);
		$arr = array();
		//echo $query;
		$oDb->query($query);
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("organoId" => $rs["organoId"],
			"organo" => ($rs["organo"] == NULL) ? $rs["organoOtro"] : $rs["organo"],
			"inicio" => $rs["inicio"],
			"fin"=>$rs["fin"],
			"concluido" => $rs["concluido"]);
		}
		//$arr[] = array("organoId"=>"1","organo"=>"Junta de Gobierno 1","inicio"=>"2001-01-04","fin"=>"2002-01-01","concluido"=>"No");
		
		
		return $arr;	

		/*$arr = array();
		$organo = new OrganoAsesor();
		$organo->Miembro = "Consejo Asesor de docencia 1";
		$organo->Inicio = date("Y-m-d");
		$organo->Concluido = "Sí";
		$organo->Fin = date("Y-m-d");
		$arr[] = $organo;
		
		$organo = new OrganoColegiado();
		$organo->Miembro = "Consejo Asesor de docencia 2";
		$organo->Inicio = date("Y-m-d");
		$organo->Concluido = "No";
		$organo->Fin = date("");
		$arr[] = $organo;
		
		return $arr;
		*/
	}
	
	public function ObtenOrganoAsesor($organoId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select organoId,organoAuxId,organoOtro,inicio,fin,concluido 
					from organoasesor
					where organoId=$organoId";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		//$premio = new Premio();
		//$premio->premioId=$rs[""];
		return $rs;
		
	}
	
	
}
?>