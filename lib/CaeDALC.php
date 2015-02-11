<?php
//El DALC para coordinacion de asuntos escolares
//Javier Alpizar, 11 Abr 08

include_once("phplib/DbFactory.inc.php");

class CaeDALC
{ 
	
	
	//Los semestres que han sido importados
	public static function ObtenSemestres()
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select id,semestre,fecha,clave
				 from a_cae_semestre
				 order by fecha desc limit 10";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("id"=>$rs["id"],"semestre"=>substr($rs["semestre"],0,4)."-".substr($rs["semestre"],4),
					"fecha"=>$rs["fecha"],"clave"=>$rs["clave"]);
							
							
		}
		return $arr;
		
	}
	
	/*
	//Para el semestre indicado busca las asignaturas que no estan en la tabla de asignaturas y las agrega 
	public static function NuevasAsignaturas($a_cae_semestreId)
	{
		
		$oDb = DbFactory::ObtenDb();
		//la sig obtiene todas las claves y nombres de asignatura que no esten en la tabla de asignatura
		//y que aparezcan en cae_semestre_h
		$query ="select distinct(asignaturaClave) as asignaturaClave,asignaturaNombre,asignatura.clave 
				from a_cae_semestre_h 
				left join asignatura on a_cae_semestre_h.asignaturaClave = asignatura.clave 
				where a_cae_semestre_h.a_cae_semestreId = $a_cae_semestreId and asignatura.clave is NULL";
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = $rs;
		}
		//arr trae las asignaturas q son nuevas, luego las agrega:
		$query = "insert into asignatura (nombre,clave) values ";
		$coma = "";
		foreach($arr as $reg)
		{
			$query.=($coma."('".$reg["asignaturaNombre"]."','".$reg["asignaturaClave"]."')");
			$coma = ",";
		}
		$oDb->query($query);
		echo $query;
	}
	
	//Recorre el semestre indicado y agrega los cursos
	public static function AgregaCursos($a_cae_semestreId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select inicio,fin,tipo,dia,grupo,asignatura.asignaturaId as asignaturaId,profesor.profesorId as profesorId 
				from a_cae_semestre_h 
				join asignatura on a_cae_semestre_h.asignaturaClave = asignatura.clave
				left join profesor on a_cae_semestre_h.rfc = profesor.rfc
				where a_cae_semestreId = $a_cae_semestrId order by a_cae_semestre_h.rfc,asignaturaClave,tipo";
	}
	*/
	public static function Borrar($semestreId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "delete from curso_licenciatura where a_cae_semestreId = '".$semestreId."'";
		//echo $query;
		$oDb->query($query);
		$query = "delete from a_cae_semestre where id='".$semestreId."'";
		//echo $query;
		$oDb->query($query);
	}
	
}

?>