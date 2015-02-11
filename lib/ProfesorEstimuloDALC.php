<?php
//El DALC de los estimulos al prof.
//Javier Alpizar, 26 Feb 08

include_once("phplib/DbFactory.inc.php");
include_once("fecha_rango.php");
include_once("ProfesorEstimulo.php");


Class ProfesorEstimuloDALC
{
	//Obtiene los progrs de estimulos ofrecidos en facultad de quim
	public static function ObtenEstimulosFQ($profesorId)
	{
		
		
	}
	//Obtiene los progrs de estimulos paipa	
	//Todos los programas de la UNAM se importan de DGAPA  y cada vez q se importan se borra
	//todo previamente asi que las fechas no aplican
	public static function ObtenProgramasPaipa($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select nivel,consejo,inicio,fin,id from apoyo_unm_paipa where profesorId = $profesorId";
		/*
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			$query .= $fechas;
		}
		*/
		$query.= " order by inicio DESC";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$paipa = new ProgramaPaipa();
			$paipa->Nivel=$rs["nivel"];
			$paipa->Consejo=$rs["consejo"];
			$paipa->Inicio=$rs["inicio"];
			$paipa->Fin=$rs["fin"];
			$paipa->Id = $rs["id"];
			$arr[] = $paipa;
		}
		/*$paipa = new ProgramaPaipa();
		$paipa->Nivel="1";
			$paipa->Consejo="a1";
			$paipa->Inicio="2001-01-01";
			$paipa->Fin="2001-02-02";
			$arr[] = $paipa;*/	
		return $arr;
	}
	
	public static function ObtenProgramasPride($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select nivel,consejo,inicio,fin,id from apoyo_unm_pride where profesorId = $profesorId";
		/*if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			$query .= $fechas;
		}*/
		$query.= " order by inicio DESC";
		$oDb->query($query);
		//echo $query;
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$pride = new ProgramaPride();
			$pride->Nivel=$rs["nivel"];
			$pride->Consejo=$rs["consejo"];
			$pride->Inicio=$rs["inicio"];
			$pride->Fin=$rs["fin"];
			$pride->Id=$rs["id"];
			$arr[] = $pride;
		}
		/*$pride = new ProgramaPride();
			$pride->Nivel=1;
			$pride->Consejo="x11";
			$pride->Inicio="2001-01-01";
			$pride->Fin="2002-02-02";
			$arr[] = $pride;*/
		
		return $arr;
	}
	

	public static function ObtenProgramasPapime($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select nombre,responsable,inicio,fin from apoyo_unm_papime where profesorId = $profesorId";
		/*if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			$query .= $fechas;
		}*/
		$query.= " order by inicio DESC";
		$oDb->query($query);
		//echo $query;
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$papime = new ProgramaPapime();
			$papime->Proyecto=$rs["nombre"];
			$papime->Responsable=$rs["responsable"];
			$papime->Colaboradores="";
			$papime->Inicio=$rs["inicio"];
			$papime->Fin=$rs["fin"];
			$arr[] = $papime;
		}
		/*$papime = new ProgramaPapime();
			$papime->Proyecto="x11";
			$papime->Responsable="yo mero";
			$papime->Colaboradores="ninguno";
			$papime->Inicio="2001-01-01";
			$papime->Fin="2002-02-02";
			$arr[] = $papime;*/
		return $arr;
	}
	
	public static function ObtenProgramasFomdoc($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select nivel,inicio,fin from apoyo_unm_fomdoc where profesorId = $profesorId";
		/*if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			$query .= $fechas;
		}*/
		$query.= " order by inicio DESC";
		$oDb->query($query);
		//echo $query;
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$fomdoc = new ProgramaFomdoc();
			$fomdoc->Nivel=$rs["nivel"];
			$fomdoc->Inicio=$rs["inicio"];
			$fomdoc->Fin=$rs["fin"];
			$arr[] = $fomdoc;
		}
		/*$fomdoc = new ProgramaFomdoc();
			$fomdoc->Nivel="1A";
			$fomdoc->Inicio="2001-01-01";
			$fomdoc->Fin="";
			$arr[] = $fomdoc;*/
		return $arr;
	}
	
	public static function ObtenProgramasPapiit($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select nivel,inicio,fin from apoyo_unm_papiit where profesorId = $profesorId";
		/*if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			$query .= $fechas;
		}*/
		$query.= " order by inicio DESC";
		$oDb->query($query);
		//echo $query;
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$papiit = new ProgramaPapiit();
			$papiit->Nivel = $rs["nivel"];
			$papiit->Inicio=$rs["inicio"];
			$papiit->Fin=$rs["fin"];
			$arr[] = $papiit;
		}
		
		return $arr;
	}
	
	public static function ObtenProgramasPasd($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select nivel,inicio,fin from apoyo_unm_pasd where profesorId = $profesorId";
		/*if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			$query .= $fechas;
		}*/
		$query.= " order by inicio DESC";
		$oDb->query($query);
		//echo $query;
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$pasd = new ProgramaPASD();
			$pasd->Nivel = $rs["nivel"];
			$pasd->Inicio=$rs["inicio"];
			$pasd->Fin=$rs["fin"];
			$arr[] = $pasd;
		}
		
		return $arr;
	}
	
	public static function ObtenProgramasPaspa($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select nivel,inicio,fin from apoyo_unm_paspa where profesorId = $profesorId";
		/*if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			$query .= $fechas;
		}*/
		$query.= " order by inicio DESC";
		$oDb->query($query);
		//echo $query;
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$paspa = new ProgramaPASPA();
			$paspa->Nivel = $rs["nivel"];
			$paspa->Inicio=$rs["inicio"];
			$paspa->Fin=$rs["fin"];
			$arr[] = $paspa;
		}
		
		return $arr;
	}
	
	
	public static function ObtenProgramasPepasig($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select nivel,inicio,fin,id from apoyo_unm_pepasig where profesorId = $profesorId";
		/*if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			$query .= $fechas;
		}*/
		$query.= " order by inicio DESC";
		$oDb->query($query);
		//echo $query;
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$pepasig = new ProgramaPEPASIG();
			$pepasig->Nivel = $rs["nivel"];
			$pepasig->Inicio=$rs["inicio"];
			$pepasig->Fin=$rs["fin"];
			$pepasig->Id=$rs["id"];
			$arr[] = $pepasig;
		}
		
		return $arr;
	}
	
	//estimulos fq
	public static function ObtenProgramasPal($profesorId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select year from apoyo_fq_pal where profesorId = $profesorId";
		$oDb->query($query);
		//echo $query;
		$arr = array();
		$rs = $oDb->getRecord("C");		
		if (is_array($rs))
		{
			$pal = new ProgramaPAL();
			$pal->Year=$rs["year"];
			$arr[] = $pal;
		}
	
		
		/*
		$arr = array();
		$pal = new ProgramaPal();
		$pal->Nivel="A";
		$pal->Inicio=date("Y-m-d");
		$pal->Fin="";
		$arr[] = $pal;
		
		$pal = new ProgramaPal();
		$pal->Nivel="B";
		$pal->Inicio=date("Y-m-d");
		$pal->Fin=date("Y-m-d");
		
		$arr[] = $pal;
		*/
		
		
		return $arr;
	}
	
	public static function ObtenProgramasPaip($profesorId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select year from apoyo_fq_paip where profesorId = $profesorId";
		$oDb->query($query);
		//echo $query;
		$arr = array();
		$rs = $oDb->getRecord("C");		
		if (is_array($rs))
		{
			$paip = new ProgramaPAIP();
			$paip->Year=$rs["year"];
			$arr[] = $paip;
		}
		return $arr;
	}
	
	
	
	
	
	public static function ObtenProgramasPerpae($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select nombre,responsable,inicio,fin from apoyo_unm_perpae where profesorId = $profesorId";
		/*if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			$query .= $fechas;
		}*/
		$query.= " order by inicio DESC";
		$oDb->query($query);
		//echo $query;
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$perpae = new ProgramaPerpae();
			$perpae->Proyecto=$rs["nombre"];
			$perpae->Responsable=$rs["responsable"];
			$perpae->Colaboradores="";
			//$perpae->Inicio=$rs["inicio"];
			//$perpae->Fin=$rs["fin"];
			$arr[] = $perpae;
		}
		/*$papime = new ProgramaPapime();
			$papime->Proyecto="x11";
			$papime->Responsable="yo mero";
			$papime->Colaboradores="ninguno";
			$papime->Inicio="2001-01-01";
			$papime->Fin="2002-02-02";
			$arr[] = $papime;*/
		return $arr;
	}	
	
	
	public static function ObtenProgramasPun_Rdu($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select nombre,responsable,inicio,fin from apoyo_unm_pun_rdu where profesorId = $profesorId";
		/*if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			$query .= $fechas;
		}*/
		$query.= " order by inicio DESC";
		$oDb->query($query);
		//echo $query;
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$pun_rdu = new ProgramaPun_Rdu();
			$pun_rdu->Proyecto=$rs["nombre"];
			$pun_rdu->Responsable=$rs["responsable"];
			$pun_rdu->Colaboradores="";
			//$pun_rdu->Inicio=$rs["inicio"];
			//$pun_rdu->Fin=$rs["fin"];
			$arr[] = $pun_rdu;
		}
		/*$papime = new ProgramaPapime();
			$papime->Proyecto="x11";
			$papime->Responsable="yo mero";
			$papime->Colaboradores="ninguno";
			$papime->Inicio="2001-01-01";
			$papime->Fin="2002-02-02";
			$arr[] = $papime;*/
		return $arr;
	}
	
	
	public static function ObtenRegistroUnam($id,$programa)
	{
		$oDb = DbFactory::ObtenDb();
		
		$tabla = "apoyo_unm_".$programa;
		$query = "select consejo,inicio,fin from $tabla where id = '".intval($id)."'";
		//echo $query;
		
		
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
		
	}
	
	
		//Obtiene los progrs de estimulos (apoyos) ofrecidos por  organismos externos
	public static function ObtenEstimulosExternos($profesorId,$inicio=NULL,$fin=NULL)
	{
		 
		$oDb = DbFactory::ObtenDb();
		$query ="select apoyoExtId,prog_externo_aux.nombre as programa,progExternoOtro,prog_externo_nivel_aux.nombre as nivel,
				vigente,inicio,fin from apoyo_prog_externo
				left join prog_externo_aux on apoyo_prog_externo.progExternoId = prog_externo_aux.id
				join prog_externo_nivel_aux on apoyo_prog_externo.nivelId = prog_externo_nivel_aux.id 
				where profesorId = $profesorId ";
		if ($inicio != NULL or $fin != NULL)
		{
			//$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			$fechas = " and ".Fecha_Rango::ObtenRango($inicio,$fin);
			$query .= $fechas;
		}
		$query.= " order by inicio desc";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("apoyoExtId"=>$rs["apoyoExtId"],
							"programa"=>($rs["programa"] == NULL) ? $rs["progExternoOtro"] : $rs["programa"],
							"nivel"=>$rs["nivel"],
							"vigente"=>$rs["vigente"],
							"inicio"=>$rs["inicio"],
							"fin"=>$rs["fin"]);
		}
		/*$arr[] = array("apoyoExtId"=>1,
							"programa"=>"la NASA en su CASA",
							"nivel"=>1,
							"vigente"=>"Si",
							"inicio"=>"2001-01-01",
							"fin"=>"");*/
		return $arr;
		
		
	}
	
	public static function ObtenEstimuloExterno($apoyoExtId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select apoyoExtId,progExternoId,progExternoOtro,nivelId,vigente,inicio,fin from apoyo_prog_externo
				where apoyoExtId = $apoyoExtId";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
}

?>