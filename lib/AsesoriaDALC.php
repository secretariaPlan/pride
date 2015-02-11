<?php
//El DALC para asesorias
//Javier Alpizar, 11 Mar 08

include_once("phplib/DbFactory.inc.php");

class AsesoriaDALC
{ 
	//Obtiene las asesorias a profesor
	public static function ObtenAsesoriasProfesor($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select asesoriaProfId,
				subprograma_aux.nombre as subprograma,subprogramaOtro,
				tutoradoNombre,tutoradoApellidoP,tutoradoApellidoM,
				nivel_aux.nombre as nivel,nivelOtro,
				asesoria_profesor.asignaturaId,asignatura as asignaturaOtro,asignatura.nombre as asignatura,
				concluido,inicio,fin 
				 from asesoria_profesor
				 left join subprograma_aux on asesoria_profesor.subprogramaId = subprograma_aux.id
				 left join nivel_aux on asesoria_profesor.nivelId = nivel_aux.nivelAuxId
				 left join asignatura on asesoria_profesor.asignaturaId = asignatura.asignaturaId
				 where profesorId = $profesorId ";
			if ($inicio != NULL or $fin != NULL)
			{
				$fechas = " and  ( 
					(inicio <= '$inicio' and fin >= '$fin') or
					(fin <= '$fin' and inicio <= '$inicio' and fin >= '$inicio') or
					(inicio >= '$inicio' and fin >= '$fin' and inicio <= '$fin' ) or
					(inicio >= '$inicio' and fin <= '$fin') or
					(inicio >= '$inicio' and inicio <= '$fin') 
					)";
				//el primero es para fechas q empezaron antes y terminan despues del rango
				//el segundo es para fechas q iniciaron antes del rango y terminan en el  rango
				//el tercero es para fechas q incian en el rango y terminan despues
				//el cuarto es para fechas dentro del rango
				//el quinto es para eventos que tiene fecha de inicio dentro del rango y no han acabado
				$query .= $fechas;
			}
		$query.= " order by subprograma_aux.id,inicio desc";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("asesoriaProfId"=>$rs["asesoriaProfId"],
							"subprograma"=>($rs["subprograma"] == NULL) ? $rs["subprogramaOtro"] : $rs["subprograma"],
							"tutoradoNombre"=>$rs["tutoradoNombre"],
							"tutoradoApellidoP"=>$rs["tutoradoApellidoP"],
							"tutoradoApellidoM"=>$rs["tutoradoApellidoM"],
							"nivel"=>($rs["nivel"]==NULL) ? $rs["nivelOtro"] : $rs["nivel"],
							"asignaturaId"=>$rs["asignaturaId"],
							"asignatura"=>($rs["asignatura"] == NULL) ? $rs["asignaturaOtro"] : $rs["asignatura"],
							"concluido"=>$rs["concluido"],
							"inicio"=>$rs["inicio"],
							"fin"=>$rs["fin"] );
		}
		/*$arr[] = array("asesoriaProfId"=>1,
							"subprograma"=>"x11",
							"tutoradoNombre"=>"Javi",
							"tutoradoApellidoP"=>"Alpi",
							"tutoradoApellidoM"=>"Mor",
							"nivel"=>1,
							"asignatura"=>"Mate",
							"concluido"=>"No",
							"inicio"=>"2001-01-01",
							"fin"=>"2002-05-05" );*/
		return $arr;
	}
	
	public static function ObtenAsesoriaProfesor($asesoriaProfId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select asesoriaProfId,
				subprogramaId,subprogramaOtro,
				tutoradoNombre,tutoradoApellidoP,tutoradoApellidoM,asignaturaId,
				asignatura,concluido,inicio,fin,nivelId,nivelOtro 
				 from asesoria_profesor
				 where asesoriaProfId = $asesoriaProfId ";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
	
	
	//Obtiene las asesorias a alumno
	public static function ObtenAsesoriasAlumno($profesorId,$inicio=NULL,$fin=NULL)
	{
		$actividades = array("Otra (especifique)","Asesoría dentro de la Facultad","Visita industrial con grupo de alumnos");
		$oDb = DbFactory::ObtenDb();
//		$query ="select asesoriaAlumnoId,tutoradoNombre,tutoradoApellidoP,tutoradoApellidoM,
//				reuniones,semestre.clave as semestre,
//				programa_alumno_aux.nombre as programa,
//				carrera_aux.nombre as carrera
//				from asesoria_alumno
//				left join programa_alumno_aux on asesoria_alumno.progAlumnoAuxId = programa_alumno_aux.id
//				left join semestre on asesoria_alumno.semestreId = semestre.semestreId
//				left join carrera_aux on asesoria_alumno.carreraId = carrera_aux.carreraId  
//				where profesorId = $profesorId ";
			$query ="select asesoriaAlumnoId,programa,progAlumnoAuxId,
				horas,inicio,fin,nivel_aux.nombre as nivel,carrera_aux.nombre as carrera,asignatura.nombre as asignatura,asignatura.clave,
				carreraOtro,asignaturaOtro,empresa,asistentes
				from asesoria_alumno
				left join nivel_aux on asesoria_alumno.nivelAuxId = nivel_aux.nivelAuxId
				left join carrera_aux on asesoria_alumno.carreraId = carrera_aux.carreraId
				left join asignatura on asesoria_alumno.asignaturaId = asignatura.asignaturaId
				where profesorId = $profesorId ";
				
	if ($inicio != NULL or $fin != NULL)
			{
				$fechas = " and  ( 
					(inicio <= '$inicio' and fin >= '$fin') or
					(fin <= '$fin' and inicio <= '$inicio' and fin >= '$inicio') or
					(inicio >= '$inicio' and fin >= '$fin' and inicio <= '$fin' ) or
					(inicio >= '$inicio' and fin <= '$fin') or
					(inicio >= '$inicio' and inicio <= '$fin') 
					)";
				//el primero es para fechas q empezaron antes y terminan despues del rango
				//el segundo es para fechas q iniciaron antes del rango y terminan en el  rango
				//el tercero es para fechas q incian en el rango y terminan despues
				//el cuarto es para fechas dentro del rango
				//el quinto es para eventos que tiene fecha de inicio dentro del rango y no han acabado
				$query .= $fechas;
			}
		$query.= " order  by programa";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("asesoriaAlumnoId"=>$rs["asesoriaAlumnoId"],
							"programa"=>($rs["progAlumnoAuxId"] > 0) ? $actividades[$rs["progAlumnoAuxId"]] : $rs["programa"],
							"horas"=>$rs["horas"],"inicio"=>$rs["inicio"],"fin"=>$rs["fin"],
							"programaAlumnoAuxId"=>$rs["progAlumnoAuxId"],"nivel"=>$rs["nivel"],
							"carrera"=>($rs["carrera"]==NULL) ? $rs["carreraOtro"] : $rs["carrera"],
							"asignatura"=>($rs["asignatura"]==NULL) ? $rs["asignaturaOtro"] : $rs["asignatura"],
							"clave"=>$rs["clave"],
							"alumnos"=>$rs["asistentes"],"empresa"=>$rs["empresa"]);
		}
		/*$arr[] = array("asesoriaAlumnoId"=>1,
							"programa"=>"x11",
							"tutoradoNombre"=>"Javi",
							"tutoradoApellidoP"=>"Alpi",
							"tutoradoApellidoM"=>"Mor",
							"carrera"=>"ICE",
							"reuniones"=>3,
							"semestre"=>"2008-2");*/
		//var_dump($arr);
		return $arr;
	} 
	
	public static function ObtenAsesoriaAlumno($asesoriaAlumnoId)
	{
		$oDb = DbFactory::ObtenDb();
//		$query = "select asesoriaAlumnoId,
//				 progAlumnoAuxId,carreraId,reuniones,semestreId,
//				 tutoradoNombre,tutoradoApellidoP,tutoradoApellidoM
//				 from asesoria_alumno
//				 where asesoriaAlumnoId = $asesoriaAlumnoId ";
		$query = "select asesoriaAlumnoId,progAlumnoAuxId,
				 programa,carreraId,reuniones,semestreId,
				 tutoradoNombre,tutoradoApellidoP,tutoradoApellidoM,nivelAuxId,asignaturaId,inicio,fin,horas,
				 empresa,asistentes,asignaturaOtro,carreraOtro 
				 from asesoria_alumno
				 where asesoriaAlumnoId = $asesoriaAlumnoId ";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
		
	}
	
	
	
}
?>