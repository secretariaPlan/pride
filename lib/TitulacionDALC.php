<?php
//El DALC para aopyos en titulacion
//Javier Alpizar, 10 Mar 08

include_once("phplib/DbFactory.inc.php");
include_once("fecha_rango.php");
//include_once("ProfesorComision.php");


class TitulacionDALC
{ 
	//Obtiene los programas de servicio social y sus respectivos alumnos q estan dados de alta
	public static function ObtenServSocialProgramas($profesorId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id,programa from serv_social where profesorId = $profesorId";
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("id"=>$rs["id"],"programa"=>$rs["programa"]);
		}
		/*
		$arr[] = array("id"=>1,"programa"=>"x11");
		$arr[] = array("id"=>2,"programa"=>"x12");*/
		return $arr;
	}
	
	//Obtiene los alumnos de un servicio social en particular 
	public static function ObtenServSocialAlumnos($programaId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select servSocAlumnoId,alumnoNombre,alumnoApellidoP,alumnoApellidoM,
				 institucion_aux.nombre as institucion,institucionOtro,
				 facultad_aux.nombre as facultad,facultadOtro,
				 carrera_aux.nombre as carrera,carreraOtro,
				 inicio,fin 
				 from serv_social_alumno
				 left join institucion_aux on serv_social_alumno.institucionId = institucion_aux.institucionId
				 left join facultad_aux on serv_social_alumno.facultadId = facultad_aux.facultadId
				 left join carrera_aux on serv_social_alumno.carreraId = carrera_aux.carreraId
				 where servSocialId = $programaId ";
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and ".Fecha_Rango::ObtenRango($inicio,$fin);
			$query .= $fechas;
		}
		$query.= " order by inicio desc";  //serv_social_alumno.alumnoApellidoP";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("servSocAlumnoId"=>$rs["servSocAlumnoId"],
							"alumnoNombre"=>$rs["alumnoNombre"],"alumnoApellidoP"=>$rs["alumnoApellidoP"],
							"alumnoApellidoM"=>$rs["alumnoApellidoM"],
							"institucion"=>($rs["institucion"] == NULL) ? $rs["institucionOtro"] : $rs["institucion"],
							"facultad"=>($rs["facultad"] == NULL) ? $rs["facultadOtro"] : $rs["facultad"],
							"carrera"=>($rs["carrera"] == NULL) ? $rs["carreraOtro"] : $rs["carrera"],
							"inicio"=>$rs["inicio"]
							,"fin"=>$rs["fin"] );
		}
		
		/*$arr[] = array("servSocAlumnoId"=>1,
							"alumnoNombre"=>"Jav","alumnoApellidoP"=>"Alpi",
							"alumnoApellidoM"=>"Mor",
							"institucion"=>"UNAM",
							"facultad"=>"FCA",
							"carrera"=>"ICE",
							"inicio"=>"2001-01-01"
							,"fin"=>"2002-02-02" );
		$arr[] = array("servSocAlumnoId"=>1,
							"alumnoNombre"=>"Jav","alumnoApellidoP"=>"Alpi",
							"alumnoApellidoM"=>"Mor",
							"institucion"=>"UNAM",
							"facultad"=>"Fac.Ing",
							"carrera"=>"ICE",
							"inicio"=>"2001-01-01"
							,"fin"=>"2002-02-02" );
		$arr[] = array("servSocAlumnoId"=>2,
							"alumnoNombre"=>"Jav","alumnoApellidoP"=>"Alpi",
							"alumnoApellidoM"=>"Mor",
							"institucion"=>"IPN",
							"facultad"=>"ESIME",
							"carrera"=>"ICE",
							"inicio"=>"2001-01-01"
							,"fin"=>"2002-02-02" );*/
		return $arr;
	}
	
	
	
	
	
	//Obtieen los datos de un alumno en particular
	public static function ObtenServCocialAlumno($servSocialAlumnoId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select servSocAlumnoId,alumnoNombre,alumnoApellidoP,alumnoApellidoM,institucionId,institucionOtro
				 ,concluido,facultadId,facultadOtro,carreraId,carreraOtro,
				 inicio,fin from serv_social_alumno where servSocAlumnoId = $servSocialAlumnoId";
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
		
		
	}
	
	
	public static function ObtenComitesTutorales($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select comiteTutId,curso_posgrado_tipo.nombre as nivel,
				alumnos,concluido,progPosOtro,carrera_aux.nombre as programa,inicio,fin
				from comite_tutoral
				join curso_posgrado_tipo on comite_tutoral.nivelId = curso_posgrado_tipo.id
				left join carrera_aux on comite_tutoral.progPosId = carrera_aux.carreraId
				where profesorId = $profesorId ";

		// las fechas son por alumno
		/*
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			$query .= $fechas;
		}
		*/
		$query.= " order by nivel,programa";  //serv_social_alumno.alumnoApellidoP";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("comiteTutId"=>$rs["comiteTutId"],"nivel"=>$rs["nivel"],"alumnos"=>$rs["alumnos"],
						   "concluido"=>$rs["concluido"],
						   "programa"=>($rs["programa"] == NULL) ? $rs["progPosOtro"] : $rs["programa"]);
		}
		/*$arr[] = array("comiteTutId"=>1,"nivel"=>"posg","alumnos"=>"3",
						   "concluido"=>"no",
						   "programa"=>"p1",
						   	"inicio"=>"2001-01-01","fin"=>"2001-01-01");*/
		return $arr;
			
		
	}
	
	//obtiene todos los alumnos inscritos al comite especificado
	public static function ObtenComiteTutoralAlumnos($comiteTutId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id,nombre,apellidoP,apellidoM,inicio,fin from comite_tutoral_alumno where comiteTutId = $comiteTutId";
		
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and ".Fecha_Rango::ObtenRango($inicio,$fin);
			$query .= $fechas;
		}
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("id"=>$rs["id"],"nombre"=>$rs["nombre"],"apellidoP"=>$rs["apellidoP"],"apellidoM"=>$rs["apellidoM"],"inicio"=>$rs["inicio"],"fin"=>$rs["fin"]);
		}
		/*$arr[] = array("id"=>1,"nombre"=>"Javier","apellidoP"=>"Alpi","apellidoM"=>"Mor");
		$arr[] = array("id"=>2,"nombre"=>"Liz","apellidoP"=>"Alva","apellidoM"=>"Mor");*/
		//var_dump($arr);
		return $arr;
			
	}
	
	//Para obtener los datos de un comite especifico
	public static function ObtenComiteTutoral($comiteTutId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select nivelId,
				alumnos,concluido,progPosOtro,progPosId,inicio,fin
				from comite_tutoral
				where comiteTutId = $comiteTutId"; 
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
	
	public static function ObtenExamenesProfesionales($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select examen_profId,funcion_aux.nombre as funcion,examen_prof.nombre,alumno.nombre as alumno,fecha from examen_prof
				 left join funcion_aux on examen_prof.funcionId = funcion_aux.funcionId
				 left join alumno on examen_prof.alumnoId = alumno.alumnoId 
				where profesorId = $profesorId ";

		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and fecha >= '$inicio' and fecha <= '$fin'";
			$query .= $fechas;
		}
		$query.= " order by fecha desc";  //serv_social_alumno.alumnoApellidoP";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("examen_profId"=>$rs["examen_profId"],"funcion"=>$rs["funcion"],"nombre"=>$rs["nombre"],
							"alumno"=>$rs["alumno"],
						   	"fecha"=>$rs["fecha"]);
		}
		
		return $arr;
	}	
	
	public static function ObtenTitulacion($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select titulacionId,funcion_aux.nombre as funcion,titulacion.nombre,fechaExamen,
				 titulacion_aux.nombre as opcionTitulacion from titulacion
				 left join funcion_aux on titulacion.funcionId = funcion_aux.funcionId
				 left join titulacion_aux on titulacion.opcionAuxId = titulacion_aux.id
				where profesorId = $profesorId ";

		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and fechaExamen >= '$inicio' and fechaExamen <= '$fin'";
			$query .= $fechas;
		}
		$query.= " order by fechaExamen desc";  //serv_social_alumno.alumnoApellidoP";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("titulacionId"=>$rs["titulacionId"],"funcion"=>$rs["funcion"],"nombre"=>$rs["nombre"],
							"opcionTitulacion"=>$rs["opcionTitulacion"],
						   	"fecha"=>$rs["fechaExamen"]);
		}
		return $arr;
	}

	public static function ObtenTitulacionAlumnos($titulacionId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select titulacion_alumno.alumnoId,alumno.nombre,carrera_aux.nombre as carrera from titulacion_alumno  
				  join alumno on titulacion_alumno.alumnoId = alumno.alumnoId
				  join carrera_aux on alumno.carreraId = carrera_aux.carreraCaeId
				  where titulacionId = '$titulacionId'";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("alumno"=>$rs["nombre"],"carrera"=>$rs["carrera"]);
		}
		return $arr;
	}
	
	public static function ObtenExamenProfAlumnos($examenId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select alumno.nombre,carrera_aux.nombre as carrera from examen_prof_alumno  
				  join alumno on examen_prof_alumno.alumnoId = alumno.alumnoId
				  join carrera_aux on alumno.carreraId = carrera_aux.carreraCaeId
				  where examenId = '$examenId'";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("alumno"=>$rs["nombre"],"carrera"=>$rs["carrera"]);
		}
		return $arr;
	}
	
	
				  
	public static function ObtenTitulacionPosgrado($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "SELECT nivel_aux.nombre as nivel,titulacionId,titulacion_posgrado.nombre,fechaExamen,alumnoApellidoP,alumnoApellidoM,alumnoNombre,
					funcionId,funcionOtro,tit_pos_funciones.nombre as funcion,
					opcionTitId,opcionTitOtro,tit_pos_opciones.nombre as opcionTit,
					titulacion_posgrado.institucionId,institucionOtro,institucion_aux.nombre as institucion,
					titulacion_posgrado.carreraId,carreraOtro,carrera_aux.nombre as carrera
					from titulacion_posgrado 
					left join tit_pos_funciones on titulacion_posgrado.funcionId = tit_pos_funciones.id 
					left join tit_pos_opciones on titulacion_posgrado.opcionTitId = tit_pos_opciones.id 
					left join institucion_aux on titulacion_posgrado.institucionId = institucion_aux.institucionId
					left join nivel_aux on titulacion_posgrado.nivelId = nivel_aux.nivelAuxId
					left join carrera_aux on titulacion_posgrado.carreraId = carrera_aux.carreraId
				 	where profesorId = $profesorId ";

		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and fechaExamen >= '$inicio' and fechaExamen <= '$fin'";
			$query .= $fechas;
		}
		$query.= " order by nivel,fechaExamen desc";  //serv_social_alumno.alumnoApellidoP";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("titulacionId"=>$rs["titulacionId"],
						   "nivel"=>$rs["nivel"],
						   "nombre"=>$rs["nombre"],
						   "fechaExamen"=>$rs["fechaExamen"],
						   "alumno"=>$rs["alumnoApellidoP"]." ".$rs["alumnoApellidoM"]." ".$rs["alumnoNombre"],
						   "funcion"=>($rs["funcion"] == NULL) ? $rs["funcionOtro"] : $rs["funcion"],
						   "opcionTit"=>($rs["opcionTit"] == NULL) ? $rs["opcionTitOtro"] : $rs["opcionTit"],
						   "carrera"=>($rs["carrera"] == NULL) ? $rs["carreraOtro"] : $rs["carrera"],		
						   "institucion"=>($rs["institucion"] == NULL) ? $rs["institucionOtro"] : $rs["institucion"]);
		}
		return $arr;
	}
	
	public static function ObtenTitulacionPosgradoRegistro($titulacionId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select funcionId,funcionOtro,nivelId,opcionTitId,opcionTitOtro,nombre,fecha,titulado,
					institucionId,institucionOtro,carreraId,carreraOtro,fechaExamen,alumnoApellidoP,
					alumnoApellidoM,alumnoNombre,facultadId,facultadOtro from titulacion_posgrado where
					titulacionId = '".$titulacionId."'";
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
		
	}
	
	public static function ObtenExamenesPosgrado($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "SELECT nivel_aux_exposgrado.nombre as nivel,examenId,examen_posgrado.nombre,fechaExamen,alumnoApellidoP,alumnoApellidoM,alumnoNombre,
					examen_posgrado.funcionId,funcionOtro,funcion_aux.nombre as funcion,
					examen_posgrado.institucionId,institucionOtro,institucion_aux.nombre as institucion,
					examen_posgrado.carreraId,carreraOtro,carrera_aux.nombre as carrera
					from examen_posgrado 
					left join funcion_aux on examen_posgrado.funcionId = funcion_aux.funcionId 
					left join tit_pos_opciones on examen_posgrado.opcionTitId = tit_pos_opciones.id 
					left join institucion_aux on examen_posgrado.institucionId = institucion_aux.institucionId
					left join nivel_aux_exposgrado on examen_posgrado.nivelId = nivel_aux_exposgrado.nivelAuxId
				 	left join carrera_aux on examen_posgrado.carreraId = carrera_aux.carreraId
					where profesorId = $profesorId ";

		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and fechaExamen >= '$inicio' and fechaExamen <= '$fin'";
			$query .= $fechas;
		}
		$query.= " order by nivel_aux_exposgrado.nivelAuxId, fechaExamen desc";  //serv_social_alumno.alumnoApellidoP";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("examenId"=>$rs["examenId"],
						   "nivel"=>$rs["nivel"],
						   "nombre"=>$rs["nombre"],
						   "fechaExamen"=>$rs["fechaExamen"],
						   "alumno"=>$rs["alumnoApellidoP"]." ".$rs["alumnoApellidoM"]." ".$rs["alumnoNombre"],
						   "funcion"=>($rs["funcion"] == NULL) ? $rs["funcionOtro"] : $rs["funcion"],
							"carrera"=>($rs["carrera"] == NULL) ? $rs["carreraOtro"] : $rs["carrera"],
						   "institucion"=>($rs["institucion"] == NULL) ? $rs["institucionOtro"] : $rs["institucion"]);
		}
		return $arr;
	}	
	
	public static function ObtenExamenPosgrado($examenId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select funcionId,funcionOtro,nivelId,nombre,fecha,titulado,
					institucionId,institucionOtro,carreraId,carreraOtro,fechaExamen,alumnoApellidoP,
					alumnoApellidoM,alumnoNombre,facultadId,facultadOtro from examen_posgrado where
					examenId = '".$examenId."'";
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
		
	}
}
?>