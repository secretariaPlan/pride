<?php
//El DALC para cargos academicos admivos
//Javier Alpizar, 26 Feb 08

include_once("phplib/DbFactory.inc.php");
//include_once("ProfesorCargo.php");


class ProfesorCargoDALC
{ 

	public static function ObtenCargos($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select cargoId,cargo_aux.nombre as cargo,inicio,fin,concluido,cargoOtro,lugar,lugarOtro,
				depto_aux.nombre as depto,dependencia_aux.nombre as dependencia
		from cargo
		left join cargo_aux on cargo.cargoAuxId = cargo_aux.cargoAuxId
		left join depto_aux on cargo.deptoAuxId = depto_aux.deptoAuxId
		left join dependencia_aux on cargo.dependenciaAuxId = dependencia_aux.dependenciaAuxId
		where profesorId=$profesorId ";
		if ($inicio != NULL or $fin != NULL)
		{
			/*$fechas = " and ( 
					(inicio <= '$inicio' and fin >= '$fin') or
					(fin <= '$fin' and inicio <= '$inicio' and fin >= '$inicio') or
					(inicio >= '$inicio' and fin >= '$fin' and inicio <= '$fin' ) or
					(inicio >= '$inicio' and fin <= '$fin') or
					(inicio >= '$inicio' and inicio <= '$fin') or
					isnull(fin) or fin = '0000-00-00' or concluido = 'No'
					)"; 
			$query .= $fechas;
			*/
			//se pidio q no se contemplaran las fechas 8 feb 11
		}
		
		
		$query.= " order by lugar DESC, inicio DESC";
		
		$oDb->query($query);
		$arr = array();
		//echo $query;
		$oDb->query($query);
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("cargoId"=>$rs["cargoId"],
			"cargo"=>($rs["cargo"] == NULL) ? $rs["cargoOtro"] : $rs["cargo"],
			"lugar"=>$rs["lugar"],"lugarOtro"=>($rs["dependencia"] == "") ? $rs["lugarOtro"] : $rs["dependencia"],
			"inicio"=>$rs["inicio"],"fin"=>$rs["fin"],"concluido"=>$rs["concluido"],"depto"=>$rs["depto"]);
		}
		/*
		$arr[] = array("cargoId"=>1,
			"cargo"=>"Jefe",
			"lugar"=>"FC",
			"inicio"=>"2001-01-01","fin"=>"2002-02-02","concluido"=>"No");
		$arr[] = array("cargoId"=>2,
			"cargo"=>"Director",
			"lugar"=>"FC",
			"inicio"=>"2001-01-01","fin"=>"2002-02-02","concluido"=>"No");
		$arr[] = array("cargoId"=>2,
			"cargo"=>"Director",
			"lugar"=>"UNAM",
			"inicio"=>"2001-01-01","fin"=>"2002-02-02","concluido"=>"Si");
		*/
		//var_dump($arr);
		return $arr;
		
	}
	
	public static function ObtenCargo($cargoId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select cargoId,cargoAuxId,inicio,fin,concluido,cargoOtro,lugar,lugarOtro,deptoAuxId 
		from cargo
		where cargoId = $cargoId";
		//$arr = array();
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	
	
		
		/*
		$arr = array();
		$organo = new CargoAcadAdmivo();
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
}
?>