<?php
//El DALC para tutorias
//Javier Alpizar, 28 Mar 08
//Se supone q este se trae de bases externas por eso solo se definiio el display

include_once("phplib/DbFactory.inc.php");

class TutoriaDALC
{ 
	//Obtiene las tutorias q lleva el prof
	public static function ObtenTutorias($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
//		$query = "select tutoriaId,carrera_aux.nombre as carrera,prog_tutor_aux.nombre as programa,progTutorOtro,
//					tutoradoNombre,tutoradoApellidoP,tutoradoApellidoM,reuniones,semestres
//					from tutoria
//					left join carrera_aux on tutoria.carreraId = carrera_aux.carreraId
//					left join prog_tutor_aux on tutoria.progTutorAuxId = prog_tutor_aux.id
//					where profesorId = $profesorId order by programa"; 
		$query = "select tutoriaId,carrera_aux.nombre as carrera,tutoria_prog_aux.nombre as programa,progTutorOtro,
					tutoradoNombre,tutoradoApellidoP,tutoradoApellidoM,reuniones,semestres,carreraOtro,inicio,fin, periodos,progTutorAuxId 
					from tutoria
					left join carrera_aux on tutoria.carreraId = carrera_aux.carreraId
					left join tutoria_prog_aux on tutoria.progTutorAuxId = tutoria_prog_aux.id
					where profesorId = $profesorId ";
		$fechas = false; $years = array(); $semestres = array(); //$periodos = array();
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = true;
			$yearIni = substr($inicio,0,4); $yearFin = substr($fin,0,4);
			$sem = array(2,1);
			$yearCurr = $yearIni;
			while ($yearCurr <= $yearFin)
			{
				$semestres[] = $yearCurr."-2";
				$semestres[] = ($yearCurr+1)."-1";
				$years[] = $yearCurr;
				$yearCurr++;
			}
			//var_dump($semestres);
//			$semIni = $yearIni."-2";
//			$semFin = ($yearIni+1)."-1";  //nota q solo toma en cuenta el año inicial y solo funcion para ese año. si el periodo seleccionado para el reporte abarca +  de un año esto ya no funciona
//			$fechas = " and ( 
//					(inicio <= '$inicio' and fin >= '$fin') or
//					(fin <= '$fin' and inicio <= '$inicio' and fin >= '$inicio') or
//					(inicio >= '$inicio' and fin >= '$fin' and inicio <= '$fin' ) or
//					(inicio >= '$inicio' and fin <= '$fin') or
//					(inicio >= '$inicio' and inicio <= '$fin') or
//					(periodos like  '%$yearIni%') or
//					(periodos like  '%$yearFin%') or
//					(semestres like '%$semIni%') or
//					(semestres like '%$semFin%') 
//					)";
//			//el primero es para fechas q empezaron antes y terminan despues del rango
//			//el segundo es para fechas q iniciaron antes del rango y terminan en el  rango
//			//el tercero es para fechas q incian en el rango y terminan despues
//			//el cuarto es para fechas dentro del rango
//			//el quinto es para eventos que tiene fecha de inicio dentro del rango y no han acabado
//			$query .= $fechas;
		}
		$query.=  " order by programa";		
					
		//echo $query;
		$oDb->query($query);
		$arr = array();
		
		while ($rs = $oDb->getRecord("C"))
		{
			//var_dump($rs);
			if (fechaOk($fechas,$rs,$inicio,$fin,$yearIni,$yearFin,$years,$semestres))
			{
				//echo "----";
				//var_dump($rs);
				$arr[] = array("tutoriaId"=>$rs["tutoriaId"],
						   "carrera"=>($rs["carrera"]==NULL) ? $rs["carreraOtro"] : $rs["carrera"],
							"tutoradoNombre"=>$rs["tutoradoNombre"],
							"tutoradoApellidoP"=>$rs["tutoradoApellidoP"],
							"tutoradoApellidoM"=>$rs["tutoradoApellidoM"],
							"reuniones"=>$rs["reuniones"],
							"programa"=>($rs["programa"] == NULL) ? $rs["progTutorOtro"] : $rs["programa"],
							"programaId"=>$rs["progTutorAuxId"],
							"inicio"=>$rs["inicio"],"fin"=>$rs["fin"],
							"periodos"=>$rs["periodos"],
							"semestres"=>$rs["semestres"]);
			}
			
		}
		
		usort($arr,"cmp");
		
		/*
		$arr[] = array("tutoriaId"=>1,
						   "carrera"=>"Quimica",
							"tutoradoNombre"=>"Javier",
							"tutoradoApellidoP"=>"Alpi",
							"tutoradoApellidoM"=>"Mora",
							"reuniones"=>1,
							"programa"=>"x11",
							"semestre"=>"2008-2");
		$arr[] = array("tutoriaId"=>1,
						   "carrera"=>"Quimica",
							"tutoradoNombre"=>"Javier",
							"tutoradoApellidoP"=>"Alpi",
							"tutoradoApellidoM"=>"Mora",
							"programa"=>"x11",
							"reuniones"=>2,
							"semestre"=>"2008-2");
		$arr[] = array("tutoriaId"=>1,
						   "carrera"=>"Quimica",
							"tutoradoNombre"=>"Javier",
							"tutoradoApellidoP"=>"Alpi",
							"tutoradoApellidoM"=>"Mora",
							"programa"=>"x12",
							"reuniones"=>3,
							"semestre"=>"2008-2");*/
		return $arr;
	}
	
	
	//Obtiene las tutorias q lleva el prof
	public static function ObtenTutoria($tutoriaId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select tutoriaId,progTutorAuxId,progTutorOtro,carreraId,carreraOtro,asignaturaId,asignaturaOtro,
					tutoradoTituloId,tutoradoNombre,tutoradoApellidoP,tutoradoApellidoM,reuniones,nivelId,
					semestres,inicio,fin,concluido,proyecto,periodos
					from tutoria
					where tutoriaId = $tutoriaId"; 
				
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
	
}

function cmp($a,$b)
	{
		if ($a["programa"] < $b["programa"])
			return -1;
		if ($a["programa"] > $b["programa"])
			return 1;
		return 0;
	}
	
function fechaOk($revisaFechas,&$rs,$inicio,$fin,$yearIni,$yearFin,$years,$semestres)
{
	$r = false;
	if ($revisaFechas == false)
		return true;
	if ($rs["semestres"] != "")
	{
		//$semestres trae los que se solicitaron		
		$aSems = explode(" ",$rs["semestres"]); //$rs["semestres"] son lo sems del registro separados x espacio
		//Como en un registro puedes venir varios periodod que no se pidieron el campo
		//se vacia y luego se llena solo con los seleccionados
		$rs["semestres"] = "";
		foreach($aSems as $sem)
		{
			if (in_array($sem,$semestres))
			{
				$r = true;
				$rs["semestres"] .= $sem." ";
			} 
		}
		return $r;
	}
	elseif($rs["periodos"] != "")
	{
		//years es un arr, trae los años q se seleccionaron, los periodos vienen como yyyy-yyyy
		//el año q se debe contemplar es el segundo year
		$aPeriodos = explode(" ",$rs["periodos"]);
		$rs["periodos"] = "";
		foreach($aPeriodos as $per)
		{
			$yearFin=substr($per,5);
			if (in_array($yearFin,$years))
			{
				$r = true;
				$rs["periodos"] .= $per." ";
			} 
		}
		return $r;
		
	}
	else 
	{  
		//Si no hay semestres ni periodos entonces usa las fechas de inicio y fin
		//primero convierto a numeros:
		$abajo = intval(str_replace("-","",$inicio));
		$arriba = intval(str_replace("-","",$fin));
		//$inicio = 0;
		$fin = 0;
		//if ($rs["inicio"]!="") No puede haber fecha de inicio cero
		$inicio = intval(str_replace("-","",$rs["inicio"]));
		if ($rs["fin"]!="")
			$fin = intval(str_replace("-","",$rs["fin"]));
		//echo "ini:".$inicio."fin:".$fin."abajo:".$abajo."arr:".$arriba."<br>";	
		if ( ($inicio <= $abajo and $fin >= $arriba) or
			 ($inicio <= $abajo and $fin <= $arriba and $fin >= $abajo) or
			 ($inicio >= $abajo and $fin >= $arriba and $inicio <= $arriba ) or
			 ($inicio >= $abajo and $inicio <= $arriba and $fin <= $arriba) or  
			 ($inicio <= $arriba and $fin == 0) )
		{
			//el primero es para fechas q empezaron antes y terminan despues del rango
			//el segundo es para fechas q iniciaron antes del rango y terminan en el  rango
			//el tercero es para fechas q incian en el rango y terminan despues
			//el cuarto es para eventos que tiene fecha de inicio dentro del rango fin dentro del rnago
			//el quinto son acts que iniciaron antes o dentro del rango y no han terminado
			 $r = true;
		}
		//echo $r;
		return $r;
	}
	
}
?>