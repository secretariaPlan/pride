<?php
//El DALC para materiales docentes
//Javier Alpizar, 12 Mar 08

include_once("phplib/DbFactory.inc.php");

class MaterialDocenteDALC
{ 
	//Obtiene las asesorias a profesor
	public static function ObtenMateriales($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select materialId,
				  mat_doc_actividad_aux.nombre as actividad,actividadOtro,
				  nivel_aux.nombre as nivel,
				  asignatura.clave as claveAsignatura,asignatura.nombre as nombreAsignatura, 
				  concluido,material_docente.nombre as nombre,inicio,fin,asignaturaOtro,
				  teoria,laboratorio,discusion,problemas,seminario,curso
				  minutos,www
				  from material_docente
				  left join mat_doc_actividad_aux on material_docente.actividadAuxId = mat_doc_actividad_aux.id
				  left join nivel_aux on  material_docente.nivelId = nivel_aux.nivelAuxId
				  left join asignatura on material_docente.asignaturaId = asignatura.asignaturaId
				  where profesorId = $profesorId ";
		
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			$query .= $fechas;
		}
		$query.= " order by nivel_aux.nombre, inicio desc";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("materialId"=>$rs["materialId"],
							"actividad"=>($rs["actividad"] == NULL) ? $rs["actividadOtro"] : $rs["actividad"],
							"nivel"=>$rs["nivel"],
							"asignatura"=>($rs["asignaturaOtro"] != "") ? $rs["asignaturaOtro"] : $rs["claveAsignatura"]. " ".$rs["nombreAsignatura"],
							"asignaturaOtro"=>$rs["asignaturaOtro"],
							"concluido"=>$rs["concluido"],
							"inicio"=>$rs["inicio"],
							"nombre"=>$rs["nombre"],
							"fin"=>$rs["fin"] ,
							"minutos"=>$rs["minutos"] ,
							"www"=>$rs["www"] ,
							"teoria"=>$rs["teoria"] ,
							"laboratorio"=>$rs["laboratorio"] ,
							"seminario"=>$rs["seminario"] ,
							"curso"=>$rs["curso"] ,
							"discusion"=>$rs["discusion"] ,
							"problemas"=>$rs["problemas"] );
		}
		/*$arr[] = array("materialId"=>1,
							"actividad"=>"Pruebas",
							"nivel"=>"Superior",
							"asignatura"=>"R-15 Matematicas" ,
							"concluido"=>"No",
							"inicio"=>"2002-01-01",
							"nombre"=>"X11",
							"fin"=>"2004-12-12" ,
							"minutos"=>80 ,
							"www"=>"www" ,
							"teoria"=>1 ,
							"laboratorio"=>2 ,
							"discusion"=>3 ,
							"problemas"=>4 );
		$arr[] = array("materialId"=>1,
							"actividad"=>"Pruebas",
							"nivel"=>"Basico",
							"asignatura"=>"R-15 Matematicas" ,
							"concluido"=>"No",
							"inicio"=>"2002-01-01",
							"nombre"=>"X11",
							"fin"=>"2004-12-12" ,
							"minutos"=>80 ,
							"www"=>"www" ,
							"teoria"=>1 ,
							"laboratorio"=>2 ,
							"discusion"=>3 ,
							"problemas"=>4 );*/
		return $arr;
	}
	
	public static function ObtenMaterial($materialId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select materialId,actividadAuxId,actividadOtro,nivelId,nivelOtro,concluido,asignaturaId,asignaturaOtro,nombre,teoria,laboratorio,discusion,problemas,
				minutos,www,seminario,curso,
				concluido,inicio,fin,funcionId  
				 from material_docente
				 where materialId = $materialId ";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
	
	
	//los colaboradores de un material en particular.
	//en este momento solo aplica para la act de desarrollo de softw aunque se puede usar para cualquiera
	//La opciones de tipo de colaborador se hardcodearon en el script de captura porq se despliegan dinamicamente con jscript
	//habria q ver si se pueden traer usando ajax, por el momento si se requieren otros
	//YA NO SE USA ESTE DECIDIERON ADOPTAR EL FORMATO DE PARTICIPANTES, MAS ABAJO ESTA LA FUNCION 
	public static function ObtenColaboradores($materialId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select id,material_docente_colabs.nombre as nombre,porcDeParticipacion,
						colaboradorTipoId
						from material_docente_colabs 
						where materialId = $materialId order by material_docente_colabs.nombre";
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("id"=>$rs["id"],
							"nombre"=>$rs["nombre"],
							"porcDeParticipacion"=>$rs["porcDeParticipacion"],
							"colaboradorTipoId"=>$rs["colaboradorTipoId"]);
							
							
		}
		return $arr;
	} 
	
	
	function ObtenParticipantes($id)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select id,funcionId,nivelId,procedencia,profesorId,particOtroNombre,particOtroApellidoP,
				particOtroApellidoM,particOtroInstitucion,estudNombre,estudApellidoP,estudApellidoM 
				from material_docente_participantes 
				where materialId = $id order by id";
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
							"particOtroNombre"=>$rs["particOtroNombre"],
							"particOtroApellidoP"=>$rs["particOtroApellidoP"],
							"particOtroApellidoM"=>$rs["particOtroApellidoM"],
							"particOtroInstitucion"=>$rs["particOtroInstitucion"],
							"estudNombre"=>$rs["estudNombre"],
							"estudApellidoP"=>$rs["estudApellidoP"],
							"estudApellidoM"=>$rs["estudApellidoM"],
						 );
		}
		
		return $arr;
	}
	
	
	
	
	
}
?>