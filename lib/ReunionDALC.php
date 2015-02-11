<?php
//El DALC para los reuniones academicas
//Javier Alpizar, 21 Mar 08

include_once("phplib/DbFactory.inc.php");


Class ReunionDALC
{
	
	
	public static function ObtenReuniones($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select reunionId,reunion.nombre as nombre,institucionCant,autorCant,inicio,fin,caracter,
				  reunion_tipo_aux.nombre as reunionTipo,reunionTipoOtro,
				  ciudad_aux.nombre as ciudad,ciudadOtro,
				  pais_aux.nombre as pais,paisOtro
				  from reunion
				  left join reunion_tipo_aux on reunion.reunionTipoId = reunion_tipo_aux.id
				  left join ciudad_aux on reunion.ciudadId = ciudad_aux.ciudadId
				  left join pais_aux on reunion.paisId = pais_aux.paisId
				  where profesorId=$profesorId "; 
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			$query .= $fechas;
		}
		$query.= " order by reunion_tipo_aux.nombre,inicio desc";
		$oDb->query($query);
		$arr = array();
		//echo $query;
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array(
			"reunionId" => $rs["reunionId"],
			"nombre" => $rs["nombre"],
			"institucionCant" => $rs["institucionCant"],
			"autorCant" => $rs["autorCant"],
			"inicio" => $rs["inicio"],
			"fin" => $rs["fin"],
			"caracter" => $rs["caracter"],
			"reunionTipo" => ($rs["reunionTipo"] == NULL) ? $rs["reunionTipoOtro"] : $rs["reunionTipo"],
			"pais" => ($rs["pais"] == NULL) ? $rs["paisOtro"] : $rs["pais"],
			"ciudad" => ($rs["ciudad"] == NULL) ? $rs["ciudadOtro"] : $rs["ciudad"]);
		}
		/*$arr[] = array(
			"reunionId" => 1,
			"nombre" => "reunion x",
			"institucionCant" => 2,
			"autorCant" => 2,
			"inicio" => "2001-01-01",
			"fin" => "2001-01-01",
			"caracter" => "Nacional",
			"reunionTipo" => "tipo",
			"pais" => "Mexico",
			"ciudad" => "DF");
		$arr[] = array(
			"reunionId" => 1,
			"nombre" => "reunion y",
			"institucionCant" => 2,
			"autorCant" => 2,
			"inicio" => "2001-01-01",
			"fin" => "2001-01-01",
			"caracter" => "Nacional",
			"reunionTipo" => "tipo",
			"pais" => "Mexico",
			"ciudad" => "Qro");*/
		return $arr;		
		
	}
	
	
	public static function ObtenReunion($reunionId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select reunion.nombre as nombre,institucionCant,autorCant,inicio,fin,caracter,
				  reunionTipoId,reunionTipoOtro,
				  ciudadId,ciudadOtro,
				  paisId,paisOtro
				  from reunion
				  where reunionId=$reunionId";
		
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		
		return $rs;
		
	}
	
	//Los trabajos presentados en una reunion especifica
	public static function ObtenTrabajos($reunionId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select trabajoId,reunion_trabajo.nombre as nombre,
				  trabajo_tipo_aux.nombre as trabajoTipo,trabajoTipoOtro
				  from reunion_trabajo
				  left join trabajo_tipo_aux on reunion_trabajo.trabajoTipoId = trabajo_tipo_aux.id
				  where reunionId = $reunionId order by trabajo_tipo_aux.nombre";
		$oDb->query($query);
		$arr = array();
		//echo $query;
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array(
			"trabajoId" => $rs["trabajoId"],
			"nombre" => $rs["nombre"],
			"trabajoTipo" => ($rs["trabajoTipo"] == NULL) ? $rs["trabajoTipoOtro"] : $rs["trabajoTipo"]);
		}
		/*$arr[] = array(
			"trabajoId" => 1,
			"nombre" => "trabajo x",
			"trabajoTipo" => "tipo");*/
		return $arr;	
		
	}
	
	//Un trabajo especifico
	public static function ObtenTrabajo($trabajoId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select trabajoTipoId,trabajoTipoOtro,nombre
				  from reunion_trabajo
				  where trabajoId=$trabajoId";
		
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		
		return $rs;
		
	}
	
	//Los autores registrados para un trabajo en particular
	public static function ObtenAutores($trabajoId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select id,funcionId,nivelId,procedencia,reunion_trabajo_autor.profesorId,particOtroNombre,particOtroApellidoP,
				particOtroApellidoM,particOtroInstit,nombre,apaterno,amaterno,particOtroNombramiento
				from reunion_trabajo_autor
				left join profesor on reunion_trabajo_autor.profesorId = profesor.profesorId
				where trabajoId = $trabajoId order by id";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("id"=>$rs["id"],
							"funcionId"=>$rs["funcionId"],
							"nivelId"=>$rs["nivelId"],
							"procedencia"=>$rs["procedencia"],
							"profesorId"=>$rs["profesorId"],
							"particOtroNombre"=>($rs["particOtroNombre"] == "") ? $rs["nombre"] : $rs["particOtroNombre"] ,
							"particOtroApellidoP"=>($rs["particOtroApellidoP"] == "") ? $rs["apaterno"] : $rs["particOtroApellidoP"] ,
							"particOtroApellidoM"=>($rs["particOtroApellidoM"]== "") ? $rs["amaterno"] : $rs["particOtroApellidoM"] ,
							"particOtroNombramiento"=>$rs["particOtroNombramiento"],
							"particOtroInstitucion"=>$rs["particOtroInstit"]
							 );
		}
		
		return $arr;
		
		/*
		$query = "select profesor.profesorId as profesorId,nombre,apaterno,amaterno from reunion_trabajo_autor
					join profesor on reunion_trabajo_autor.profesorId = profesor.profesorId
					where reunion_trabajo_autor.trabajoId = $trabajoId";
				 
		$oDb->query($query);
		$arr = array();
		//echo $query;
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = $rs;
		}
		//$arr[] = array("profesorId"=>1,"nombre"=>"Javier","apaterno"=>"Alpizar","amaterno"=>"Mor");
		return $arr;
		*/	
	}
	
	public static function ObtenAutoresOnly($trabajoId)
	{

		$oDb = DbFactory::ObtenDb();
		$query ="select reunion_trabajo_autor.profesorId,particOtroNombre,particOtroApellidoP,
				particOtroApellidoM,apaterno,amaterno,nombre 
				from reunion_trabajo_autor
				left join profesor on reunion_trabajo_autor.profesorId = profesor.profesorId 
				where trabajoId = $trabajoId order by id";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			if ($rs["profesorId"] == 0)
				$arr[] = array("nombre"=>$rs["particOtroNombre"],"apaterno"=>$rs["particOtroApellidoP"],"amaterno"=>$rs["particOtroApellidoM"]);
			else
				$arr[] = array("nombre"=>$rs["nombre"],"apaterno"=>$rs["apaterno"],"amaterno"=>$rs["amaterno"]);
		}
		
		return $arr;
	}
	
	
}
 ?>