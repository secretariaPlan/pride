<?php
//El DALC para cursos impartidos por el prof.
//Javier Alpizar, 7 Mar 08

include_once("phplib/DbFactory.inc.php");
//include_once("ProfesorComision.php");


class CursoDALC
{ 
	//regresa en una arr asoc todas los cursos q un profesor tiene asignado
	public static function ObtenCursosLicenciatura($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "SELECT asignatura.nombre AS asignaturaNombre, asignatura.clave as asignaturaClave, 
					curso_tipo_aux.nombre AS tipo, minutos, year, semestre,grupo,alumnos
					FROM curso_licenciatura
					LEFT JOIN asignatura ON curso_licenciatura.asignaturaId = asignatura.asignaturaId
					LEFT JOIN curso_tipo_aux ON curso_licenciatura.cursoTipoId = curso_tipo_aux.id
					where profesorId=$profesorId ";
		if ($inicio != NULL or $fin != NULL)
		{
			$yearIni = substr($inicio,0,4);
			$yearFin = ($yearIni+1);  //nota q solo toma en cuenta el año inicial y solo funcion para ese año. si el periodo seleccionado para el reporte abarca +  de un año esto ya no funciona
			$fechas = " and ( (year = '".$yearIni."' and semestre='2') or (year='".$yearFin."' and semestre='1'))"; 
			$query .= $fechas;
			//los semestres de un año son ano-2 y (ano+1)-1 ejm p 2008: 2008-2 2009-1
 		}
		$query.= " ORDER BY year DESC , semestre DESC, asignaturaNombre ASC";
		$arr = array();
		//echo $query;
		$oDb->query($query);
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("asignaturaClave"=>$rs["asignaturaClave"],
							"asignaturaNombre"=>$rs["asignaturaNombre"],
							"minutos"=>$rs["minutos"],
							"tipo"=>$rs["tipo"],
							"year"=>$rs["year"],	
							"grupo"=>$rs["grupo"],	
							"alumnos"=>$rs["alumnos"],
							"semestre"=>$rs["semestre"]);
		}
		return $arr;
	}
	
	//regresa en una arr asoc todas los cursos q un profesor tiene asignado en nivel posgrado
	public static function ObtenCursosPosgrado($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select cursoId,asignaturaClave, asignaturaNombre,horas,seminario,teoria,year,
				semestre.clave as semestre,semestreOtro,
				curso_posgrado_tipo.nombre as cursoTipo, curso_posgrado_prog.curso 
				from curso_posgrado 
				left join semestre on curso_posgrado.semestreId = semestre.semestreId
				join curso_posgrado_tipo on curso_posgrado.cursoTipoId = curso_posgrado_tipo.id
				left join curso_posgrado_prog on curso_posgrado.cursoId = curso_posgrado_prog.curso_posgradoId
				where curso_posgrado.profesorId=$profesorId ";
		/*
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and year >= '".substr($inicio,0,4)."' and year <= '".substr($fin,0,4)."'";
			$query .= $fechas;
		}
		*/
		$query.= " order by cursoTipoId,semestre";
		$arr = array();
		//echo $query;
		$oDb->query($query);
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("asignaturaClave"=>$rs["asignaturaClave"],
							"asignaturaNombre"=>$rs["asignaturaNombre"],
							"cursoTipo"=>$rs["cursoTipo"],
							"cursoId"=>$rs["cursoId"],
							"horas"=>$rs["horas"],
							"teoria"=>$rs["teoria"],
							"seminario"=>$rs["seminario"],
							"curso"=>($rs["curso"] == NULL) ? "Si" : $rs["curso"],
							"semestre"=>($rs["semestre"] == NULL) ? $rs["semestreOtro"] : $rs["semestre"]);
		}
		//var_dump($arr);
		/*$arr[] = array("asignaturaClave"=>"368",
							"asignaturaNombre"=>"Quimica I",
							"cursoTipo"=>"a1",
							"cursoId"=>3,
							"horas"=>2,
							"teoria"=>"Si",
							"seminario"=>"Si",
							"semestre"=>"2008-2");*/
		if ($inicio != NULL or $fin != NULL)
		{	
			//echo "hi".$inicio.$fin;
			$yearIni = substr($inicio,0,4);
			$arr2 = array();
			$semIni = $yearIni."-2"; $semFin = ($yearIni+1)."-1";
			foreach($arr as $reg)
			{
				//$year = substr($reg["semestre"],0,4);
				if ($reg["semestre"] == $semIni or $reg["semestre"] == $semFin)
					$arr2[] = $reg;
					
			}
			return $arr2;
		}
		else
			return $arr;
	
	}
	
	public static function ObtenCursoPosgrado($cursoId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select cursoId,asignaturaClave,cursoTipoId,asignaturaNombre,horas,seminario,teoria,
				semestreId,semestreOtro,nuevoPlan from
				curso_posgrado 
				where cursoId=$cursoId";
		$arr = array();
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		//$arr[] = array("cursoId"=>$rs["cursoId"],
		//				"cursoTipoId"=>$rs["cursoTipoId"],
		//				"asignaturaClave"=>$rs["asignaturaClave"],
			//			"asignaturaNombre"=>$rs["asignaturaNombre"],
				//		"horas"=>$rs["horas"],
					//	"teoria"=>$rs["teoria"],
						//"seminario"=>$rs["seminario"],
						//"semestreId"=>$rs["semestreId"],
						//"semestreOtro"=>$rs["semestreOtro"]);
		
		//return $arr;
		return $rs;
	}
	

	//si el tipo de curso de posgrado es programa (4), esta funcion regresa los datos del programa correpondientes
	// ese curso
	//cursoPosProgId es el id de curso_posgrado
	//posProgId es el id del aux posgrado_programa que tiene la lista de progs disponibles
	public static function ObtenCursoPosgradoPrograma($cursoId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select cursoPosProgId,posProgId,posProgOtro,curso from curso_posgrado_prog
				where curso_posgradoId=$cursoId";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
			
	}
	
	//Regresa los profesores participantes de un curso tipo prog de posgrado
	public static function ObtenProfesores($posProgId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select id,funcionId,nivelId,procedencia,profesorId,particOtroNombre,particOtroApellidoP,
				particOtroApellidoM,institucionOtro
				from curso_pos_prog_profs 
				where cursoPosProgId = $posProgId order by id";
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
							"institucionOtro"=>$rs["institucionOtro"],
			
							
							 );
		}
		return $arr;
		
	}
	
	
	public static function ObtenCursosExtraCurr($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select cursoExtracurrId,cursoTipoAuxId,curso_extracurr_tipo.nombre as cursoTipo,cursoTipoOtro,inicio,fin,
		curso_extracurr.nombre as nombre,horas,asistentes,concluido,dirigido,dirigidoOtro 
		from curso_extracurr
		left join curso_extracurr_tipo on curso_extracurr.cursoTipoAuxId = curso_extracurr_tipo.id
		where profesorId=$profesorId ";
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			$query .= $fechas;
		}
		$query.= " order by curso_extracurr_tipo.nombre, inicio desc";
		//$oDb->query($query);
		$arr = array();
		//echo $query;
		$oDb->query($query);
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("cursoExtracurrId"=>$rs["cursoExtracurrId"],
			"cursoTipo" => ($rs["cursoTipo"] == NULL) ? $rs["cursoTipoOtro"] : $rs["cursoTipo"],
			"nombre"=>$rs["nombre"],
			"horas"=>$rs["horas"],
			"asistentes"=>$rs["asistentes"],
			"dirigido"=> ($rs["dirigido"] == "Otro") ? $rs["dirigidoOtro"] : $rs["dirigido"],
			"inicio"=>$rs["inicio"],"fin"=>$rs["fin"],"concluido"=>$rs["concluido"]);
		}
		/*$arr[] = array("cursoExtracurrId"=>1,
			"cursoTipo" => "x11",
			"nombre"=>"curso1",
			"horas"=>5,
			"asistentes"=>40,
			"inicio"=>"2001-01-01","fin"=>"2002-10-11","concluido"=>"No");*/
		return $arr;
		
	}
	
	public static function ObtenCursoExtraCurr($cursoExtracurrId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select cursoExtracurrId,cursoTipoAuxId,cursoTipoOtro,nombre,horas,asistentes,inicio,fin,
					concluido,dirigido,dirigidoOtro  
		from curso_extracurr
		where cursoExtracurrId = $cursoExtracurrId";
		
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	
	}
	
	//cursos impartidos fuera de la facultad
	public static function ObtenCursosFuera($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select cursoFueraId,cursoTipoId,curso_fuera_tipo.nombre as cursoTipo,cursoTipoOtro,
		curso_fuera.nombre as nombre,inicio,fin,horas,concluido,asistentes,institucion,
		ciudad_aux.nombre as ciudad,ciudadOtro,
		pais_aux.nombre as pais,paisOtro,
		audiencia_aux.nombre as audiencia,audienciaOtro
		from curso_fuera
		left join curso_fuera_tipo on curso_fuera.cursoTipoId = curso_fuera_tipo.id
		left join ciudad_aux on curso_fuera.ciudadId = ciudad_aux.ciudadId
		left join pais_aux on curso_fuera.paisId = pais_aux.paisId
		left join audiencia_aux on curso_fuera.audienciaId = audiencia_aux.id
		where profesorId=$profesorId ";
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			$query .= $fechas;
		}
		$query.= " order by curso_fuera_tipo.nombre, inicio desc";
		//$oDb->query($query);
		$arr = array();
		//echo $query;
		$oDb->query($query);
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("cursoFueraId"=>$rs["cursoFueraId"],
			"nombre"=>$rs["nombre"],
			"horas"=>$rs["horas"],
			"inicio"=>$rs["inicio"],
			"fin"=>$rs["fin"],
			"concluido"=>$rs["concluido"],
			"institucion"=>$rs["institucion"],
			"asistentes"=>$rs["asistentes"],
			"cursoTipo" => ($rs["cursoTipo"] == NULL) ? $rs["cursoTipoOtro"] : $rs["cursoTipo"],
			"ciudad" => ($rs["ciudad"] == NULL) ? $rs["ciudadOtro"] : $rs["ciudad"],
			"pais" => ($rs["pais"] == NULL) ? $rs["paisOtro"] : $rs["pais"],
			"audiencia" => ($rs["audiencia"] == NULL) ? $rs["audienciaOtro"] : $rs["audiencia"]
			);
		}
		/*$arr[] = array("cursoFueraId"=>1,
			"nombre"=>"cursoX",
			"horas"=>3,
			"inicio"=>"2001-01-01",
			"fin"=>"2001-01-01",
			"concluido"=>"No",
			"institucion"=>"UNAM",
			"lugar"=>"Mexico",
			"asistentes"=>10,
			"cursoTipo" => "x",
			"ciudad" => "DF",
			"pais" => "Mexico",
			"audiencia" => "Todos");*/
		return $arr;
		
	}
	
	public static function ObtenCursoFuera($cursoFueraId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select cursoFueraId,cursoTipoId,cursoTipoOtro,
		nombre,inicio,fin,horas,concluido,asistentes,institucion,
		ciudadId,ciudadOtro,
		paisId,paisOtro,
		audienciaId,audienciaOtro
		from curso_fuera
		where cursoFueraId=$cursoFueraId";
		$arr = array();
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		/*
		$rs = $oDb->getRecord("C");		
			$arr[] = array("cursoFueraId"=>$rs["cursoFueraId"],
			"cursoFueraId" =>$rs["cursoFueraId"],
			"cursoTipoOtro"=>$rs["cursoTipoOtro"],
			"nombre"=>$rs["nombre"],
			"horas"=>$rs["horas"],
			"inicio"=>$rs["inicio"],
			"fin"=>$rs["fin"],
			"concluido"=>$rs["concluido"],
			"institucion"=>$rs["institucion"],
			"lugar"=>$rs["lugar"],
			"ciudadId" => $rs["ciudadId"],
			"paisId" => $rs["paisId"],
			"aucienciaId" => $rs["audienciaId"]
			);
				
		
		return $arr;
		*/
		return $rs;
	}
}
 ?>