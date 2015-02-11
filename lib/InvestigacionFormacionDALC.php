<?php
//El DALC para formaion en la investigacion
//Javier Alpizar, 21 Mar 08

include_once("phplib/DbFactory.inc.php");
include_once("lib/Autores.php");

class InvestigacionFormacionDALC
{ 
	
	
	//los registros de un profesor.
	public static function ObtenRegistros($profesorId,$inicio=NULL,$fin=NULL)
	{
		
		$oDb = DbFactory::ObtenDb();
		$query ="select invFormId,investigacion_formacion.nombre as nombre,alumnoNombre,alumnoApellidoP,alumnoApellidoM,nivelEscolarOtro,
				 formacionTipoOtro,formacionTipoId,
				 nivel_aux.nombre as nivelEscolar,escuela as escuelaOtro,carreraOtro,semestre,carrera_aux.nombre as carrera,
				 inicio,fin,horas,
				 formacion_aux.nombre as formacionTipo,
				 facultad_aux.nombre as escuela
				 from investigacion_formacion
				 left join nivel_aux on investigacion_formacion.nivelEscolarId = nivel_aux.nivelAuxId
				 left join formacion_aux on investigacion_formacion.formacionTipoId = formacion_aux.formacionId
				 left join facultad_aux on investigacion_formacion.escuelaId = facultad_aux.facultadId
				 left join carrera_aux on investigacion_formacion.carreraId = carrera_aux.carreraId
				 where profesorId = $profesorId ";
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and ( 
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
		$query.= " order by orden DESC,inicio desc";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("invFormId"=>$rs["invFormId"],"nombre"=>$rs["nombre"],"formacionTipoId"=>$rs["formacionTipoId"],
						   "alumno"=>$rs["alumnoApellidoP"]." ".$rs["alumnoApellidoM"]." ".$rs["alumnoNombre"],
						   "nivel"=>($rs["nivelEscolar"] == NULL) ? $rs["nivelEscolarOtro"] : $rs["nivelEscolar"],
						   "escuela"=>($rs["escuelaOtro"] == "") ? $rs["escuela"] : $rs["escuelaOtro"],
						   "carrera"=>($rs["carrera"] == NULL) ? $rs["carreraOtro"] : $rs["carrera"],
						   "semestre"=>$rs["semestre"],
						   "formacionTipo"=>($rs["formacionTipo"] == NULL) ? $rs["formacionTipoOtro"] : $rs["formacionTipo"],
						   "inicio"=>$rs["inicio"],"fin"=>$rs["fin"],"horas"=>$rs["horas"]); 	
			
		}
		/*$arr[] = array("invFormId"=>1,"nombre"=>"nombre","formacionTipoId"=>1,
						   "alumno"=>"jav alpi",
						   "nivel"=>"Doctor",
						   "formacionTipo"=>"ayuda",
						   "inicio"=>"2001-01-01","fin"=>"2001-01-01","horas"=>2);*/
		//var_dump($arr);
		return $arr;
		
	}
	
	public static function ObtenFormacion($invFormId)
	{
	 	$oDb = DbFactory::ObtenDb();
		$query ="select formacionTipoId,formacionTipoOtro,nombre,alumnoNombre,alumnoApellidoP,alumnoApellidoM,
					nivelEscolarId,nivelEscolarOtro,escuela,escuelaId,carrera,semestre,inicio,fin,horas,carreraOtro,carreraId 
					from investigacion_formacion where invFormId = $invFormId";
				
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
}
?>