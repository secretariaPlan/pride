<?php
//El DALC para la superacion academica del profesor

include_once("phplib/DbFactory.inc.php");
include_once("ProfesorSuperacionAcademica.php");


Class ProfesorSuperacionAcademicaDALC
{
	
	public static function Agrega($fAcad,$profesorId)
	{
		//var_dump($fAcad);
		$oDb = DbFactory::ObtenDb();
		//esto es para q no incluya (y deje null en la db) si no trae ninguna fecha
		$inicio="";
		if ($fAcad->inicio != "")
			$inicio = ",inicio='$fAcad->inicio'";
		$fin="";
		if ($fAcad->fin != "")
			$fin = ",fin='$fAcad->fin'";
		$query = "insert into superacion_academica set profesorId=$profesorId,
					institucionId=$fAcad->institucionId,
					institucionOtro='$fAcad->institucionOtro',
					ciudadId=$fAcad->ciudadId,ciudadOtro='$fAcad->ciudadOtro',
					paisId=$fAcad->paisId,paisOtro='$fAcad->paisOtro',
					actividadId=$fAcad->actividadId,
					actividadOtro='$fAcad->actividadOtro',
					nombre='$fAcad->nombre',
					horas=$fAcad->horas,
					expositor='$fAcad->expositor',
					programaId=$fAcad->programaId,
					nivel='$fAcad->nivel',
					evaluacion='$fAcad->evaluacion',
					asignaturaId='$fAcad->asignaturaId',
					semestreId='$fAcad->semestreId',
					programaOtro='$fAcad->programaOtro'".$inicio.$fin;
		//echo $query;
		$r = $oDb->executeNonQuery($query);
		return $r;		  
	}
	
	public static function Modifica($fAcad,$superacionId)
	{
		//var_dump($fAcad);
		$oDb = DbFactory::ObtenDb();
		//esto es para q no incluya (y deje null en la db) si no trae ninguna fecha
		$inicio=",inicio=NULL";
		if ($fAcad->inicio != "")
			$inicio = ",inicio='$fAcad->inicio'";
		$fin=",fin=NULL";
		if ($fAcad->fin != "")
			$fin = ",fin='$fAcad->fin'";
		$query = "update superacion_academica set 
					institucionId=$fAcad->institucionId,
					institucionOtro='$fAcad->institucionOtro',
					ciudadId=$fAcad->ciudadId,ciudadOtro='$fAcad->ciudadOtro',
					paisId=$fAcad->paisId,paisOtro='$fAcad->paisOtro',
					actividadId=$fAcad->actividadId,
					actividadOtro='$fAcad->actividadOtro',
					nombre='$fAcad->nombre',
					horas=$fAcad->horas,
					expositor='$fAcad->expositor',
					nivel='$fAcad->nivel',
					evaluacion='$fAcad->evaluacion',
					asignaturaId='$fAcad->asignaturaId',
					semestreId='$fAcad->semestreId',
					programaId=$fAcad->programaId,
					programaOtro='$fAcad->programaOtro'".$inicio.$fin." where superacionId=$superacionId";
		//echo $query;
		$r = $oDb->executeNonQuery($query);
		return $r;		  
	}
	
	public static function Borra($superacionId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "delete from superacion_academica where superacionId = $superacionId";
				  
		//echo $query;
		$r = $oDb->executeNonQuery($query);
		return $r;	
	}
	
	
//Obtiene un registro especifico de formacion academica
	public static function ObtenActividad($superacionId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select superacionId,inicio,fin,paisId,paisOtro,
					institucionOtro,institucionId,ciudadOtro,ciudadId,nombre,actividadId,actividadOtro,horas,expositor,
					programaId,programaOtro,nivel,evaluacion,asignaturaId,semestreId from
					superacion_academica 
					where superacionId=$superacionId";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		$fAcad = new SuperacionAcademica();
		$fAcad->actividadId=$rs["actividadId"];
		$fAcad->actividadOtro=$rs["actividadOtro"];
		$fAcad->ciudadId=$rs["ciudadId"];
		$fAcad->ciudadOtro=$rs["ciudadOtro"];
		$fAcad->fin=$rs["fin"];
		$fAcad->superacionId=$superacionId;
		$fAcad->inicio=$rs["inicio"];
		$fAcad->institucionId=$rs["institucionId"];
		$fAcad->institucionOtro=$rs["institucionOtro"];
		$fAcad->paisId=$rs["paisId"];
		$fAcad->paisOtro=$rs["paisOtro"];
		$fAcad->nombre=$rs["nombre"];
		$fAcad->horas=$rs["horas"];
		$fAcad->expositor=$rs["expositor"];
		$fAcad->programaId=$rs["programaId"];
		$fAcad->programaOtro=$rs["programaOtro"];
		$fAcad->nivel=$rs["nivel"];
		$fAcad->evaluacion=$rs["evaluacion"];
		$fAcad->asignaturaId=$rs["asignaturaId"];
		$fAcad->semestreId=$rs["semestreId"];
		return $fAcad;
		
	}
	
	//Regresa para un profesor, un arr de asociativo orndeado por el tipo de actividad
	
	public static function ObtenSuperacionAcademica($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select superacion_academica.superacionId as superacionId,sup_acad_acts.nombre as actividad,actividadOtro,
					superacion_academica.nombre as nombre,institucionOtro,institucion_aux.nombre as institucion,
					horas,inicio,fin,ciudad_aux.nombre as ciudad,ciudadOtro,superacion_academica.actividadId,
					pais_aux.nombre as pais,paisOtro
					from
					superacion_academica 
					left join sup_acad_acts on superacion_academica.actividadId = sup_acad_acts.actividadId
					left join institucion_aux on superacion_academica.institucionId = institucion_aux.institucionId
					left join ciudad_aux on superacion_academica.ciudadId = ciudad_aux.ciudadId
					left join pais_aux on superacion_academica.paisId = pais_aux.paisId
					where profesorId=$profesorId ";
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			$query .= $fechas;
		}
		$query.= " order by superacion_academica.fin DESC"; //.actividadId";
		$arr = array();
		//echo $query;
		$oDb->query($query);
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("actividad" => ($rs["actividad"] == NULL) ? $rs["actividadOtro"] : $rs["actividad"],
			"actividadId"=>$rs["actividadId"],
			"fin"  => $rs["fin"] ,
			"nombre"=>$rs["nombre"],
			"superacionId"  => $rs["superacionId"],
			"horas"=>$rs["horas"],
			"inicio" => $rs["inicio"],
			"institucion" => ($rs["institucion"] == NULL) ? $rs["institucionOtro"] : $rs["institucion"],
			"ciudad" => ($rs["ciudad"] == NULL) ? $rs["ciudadOtro"] : $rs["ciudad"],
			"pais" => ($rs["pais"] == NULL) ? $rs["paisOtro"] : $rs["pais"]);
			
		}
		return $arr;
		//return array(array("actividad"=>"Pobemas","fin"=>"2008-01-01","superacionId"=>"2","nombre"=>"x1","inicio"=>"2008-01-01",
		//			"institucion"=>"UNAM","ciudad"=>"Mexico","horas"=>10),
		//			array("actividad"=>"Doctor","fin"=>"2008-01-01","superacionId"=>"1","nombre"=>"x2","inicio"=>"2008-01-01",
		//			"institucion"=>"UNAM","ciudad"=>"Mexico","horas"=>10));
		
		
		/*
		$actividades = array();
		$tipos = array();
		///		
		$actividad = new Actividad();
		$actividad->Nombre="Diplomado de reactivos";
		$actividad->Fin=date("Y-m-d");
		$actividad->Id=1;
		$actividad->Inicio=date("Y-m-d");
		$actividad->Institucion="UAM";
		$actividad->Horas="10";
		$actividades[] = $actividad;
		
		$actividad = new Actividad();
		$actividad->Nombre="Curso de actualizacion";
		$actividad->Fin=date("Y-m-d");
		$actividad->Id=2;
		$actividad->Inicio=date("Y-m-d");
		$actividad->Institucion="UNAM";
		$actividad->Horas="10";
		$actividades[] = $actividad;
		
		$tipo = new TipoDeActividad();
		$tipo->Nombre = "Asistencia comprobada";
		$tipo->Id = 1;
		$tipo->Actividades = $actividades;
		$tipos[] = $tipo;
		//

		//
		return $tipos;
		*/
		
		
	}
}



?>