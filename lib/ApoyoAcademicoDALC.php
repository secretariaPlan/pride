<?php
//El DALC para comisiones evaluadoras
//Javier Alpizar, 26 Feb 08

include_once("phplib/DbFactory.inc.php");
include_once("fecha_rango.php");
//include_once("ProfesorComision.php");


class ApoyoAcademicoDALC
{ 

	public static function ObtenApoyosAcademicos($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select apoyoAcadId,apoyo_academico.apoyoAcadAuxId as apoyoAcadAuxId,apoyoAcadOtro,
		apoyo_acad_aux.nombre as nombre,inicio,fin,concluido,asignatura.nombre as asignatura,
		asignaturaOtro,asignatura.clave as clave
		from apoyo_academico
		left join apoyo_acad_aux on apoyo_academico.apoyoAcadAuxId = apoyo_acad_aux.apoyoAcadAuxId
		left join asignatura on apoyo_academico.asignaturaId = asignatura.asignaturaId
		where profesorId=$profesorId ";
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and ".Fecha_Rango::ObtenRango($inicio,$fin);
			$query .= $fechas;
		}
		$query.= " order by apoyo_acad_aux.nombre, inicio desc";
		$oDb->query($query);
		$arr = array();
		//echo $query;
		$oDb->query($query);
		while ($rs = $oDb->getRecord("C"))
		{
			//var_dump($rs);
			$arr[] = array("apoyoAcadId"=>$rs["apoyoAcadId"],
			"nombre"=>($rs["nombre"] == NULL) ? $rs["apoyoAcadOtro"] :$rs["nombre"],"asignatura"=>($rs["asignatura"] == NULL) ? $rs["asignaturaOtro"] : $rs["clave"]." ".$rs["asignatura"],
			"inicio"=>$rs["inicio"],"fin"=>$rs["fin"],"concluido"=>$rs["concluido"],"apoyoAcadAuxId"=>$rs["apoyoAcadAuxId"]);
		}
		/*
		$arr[] = array("apoyoAcadId"=>1,
			"nombre"=>"apoyo1","asignatura"=>"mate",
			"inicio"=>"2001-01-01","fin"=>"2001-01-02","concluido"=>"Si");
		$arr[] = array("apoyoAcadId"=>2,
			"nombre"=>"apoyo1","asignatura"=>"fisica",
			"inicio"=>"2001-01-01","fin"=>"","concluido"=>"No");
		$arr[] = array("apoyoAcadId"=>2,
			"nombre"=>"apoyo2","asignatura"=>"quimica",
			"inicio"=>"2001-01-01","fin"=>"2001-01-02","concluido"=>"Si");
		*/
		return $arr;
		
	}
	
	public static function ObtenApoyoAcademico($apoyoAcadId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select apoyoAcadId,apoyoAcadAuxId,apoyoAcadOtro,asignaturaId,asignaturaOtro,asignatura,inicio,fin,
					concluido,objetivo,contraparte,funcion,participantes,actividad 
		from apoyo_academico
		where apoyoAcadId = $apoyoAcadId";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	
	}
	
	public static function ObtenParticipantes($apoyoAcadId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select id,apoyoAcadId,funcion,procedencia,profesorId,particOtroNombre,particOtroApellidoP,
				particOtroApellidoM,particOtroInstitucion
				from apoyo_acad_partic
				where apoyoAcadId = $apoyoAcadId order by id";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("id"=>$rs["id"],
							"funcion"=>$rs["funcion"],
							"procedencia"=>$rs["procedencia"],
							"profesorId"=>$rs["profesorId"],
							"particOtroNombre"=>$rs["particOtroNombre"],
							"particOtroApellidoP"=>$rs["particOtroApellidoP"],
							"particOtroApellidoM"=>$rs["particOtroApellidoM"],
							"particOtroInstitucion"=>$rs["particOtroInstitucion"],
							"tipo"=>$rs["funcion"]
							 );
		}
			
		return $arr;
		
	}
}
 ?>