<?php

//El DALC de organizacion de actividades
//Javier Alpizar, 22 Mar 08
//Menu 5,4
include_once("phplib/DbFactory.inc.php");
include_once("lib/Autores.php");

class ActividadDALC
{ 
	
	
	
	public static function ObtenActividades($profesorId,$inicio=NULL,$fin=NULL)
	{
		
		$oDb = DbFactory::ObtenDb();
		$query ="select actividadId,actividad.nombre as nombre,seccion,sede,inicio,fin,asistentes,
				actividad_tipo_aux.nombre as actividadTipo, actividadTipoOtro,ciclo_conferencias,ciclo_nombre
				from actividad
				left join actividad_tipo_aux on actividad.actividadTipoId = actividad_tipo_aux.id
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
		$query.= "order by seccion,inicio desc";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("actividadId"=>$rs["actividadId"],
							"nombre"=>$rs["nombre"],
							"seccion"=>$rs["seccion"],
							"sede"=>$rs["sede"],
							"inicio"=>$rs["inicio"],
							"asistentes"=>$rs["asistentes"],
							"ciclo_nombre"=>($rs["ciclo_conferencias"] == "Si") ? $rs["ciclo_nombre"] : "",
							"fin"=>$rs["fin"],
							"actividadTipo"=>($rs["actividadTipo"] == NULL) ? $rs["actividadTipoOtro"] : $rs["actividadTipo"]);
							
		}
		/*$arr[] = array("actividadId"=>1,
							"nombre"=>"actx",
							"seccion"=>"A",
							"sede"=>"CU",
							"inicio"=>"2001-01-01",
							"fin"=>"2002-02-02",
							"actividadTipo"=>"academica");*/
		return $arr;
		
	}

	public static function ObtenActividad($actividadId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select nombre,sede,inicio,fin,actividadTipoId,actividadTipoOtro,concluido,asistentes,acciones,ciclo_conferencias,ciclo_nombre 
				 from actividad where actividadId = $actividadId";
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;		 
	}
	
	//Las instituciones organizadoras
	public static function ObtenInstituciones($actividadId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select id,facultad_aux.nombre as institucion,facultad_aux.facultadId as facultadId,facultadOtro 
				 from actividad_instituciones
				 left join facultad_aux on actividad_instituciones.facultadId = facultad_aux.facultadId
				 where actividadId = $actividadId";
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("id"=>($rs["facultadId"]==NULL) ? $rs["facultadId"] : $rs["facultadId"],
						   "institucion"=>($rs["institucion"]==NULL) ? $rs["facultadOtro"] : $rs["institucion"]);
		}
		return $arr;		 
	}
	
	public static function ObtenOrganizadores($actividadId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select id,procedencia,profesorId,particOtroNombre,particOtroApellidoP,
				particOtroApellidoM,particOtroInstit
				 from actividad_organizadores
				 where actividadId = $actividadId";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = $rs;
		}
		return $arr;		 
	}
	
	public static function ObtenOrganizadoresOnly($actividadId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select id,procedencia,actividad_organizadores.profesorId,particOtroNombre,particOtroApellidoP,
				particOtroApellidoM,particOtroInstit,apaterno,amaterno,nombre
				 from actividad_organizadores
				 left join profesor on actividad_organizadores.profesorId = profesor.profesorId
				 where actividadId = $actividadId";
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
	
	public static function obtenCampos()
	{
	
		$campos = array('seccion'=>"" ,
  			"actividadTipoId"=>1 ,  "actividadTipoOtro"=>"" ,  "nombre"=>"" ,  "sede"=>"" ,  "asistentes"=>0 ,
  			"concluido"=>"No" ,  "inicio"=>"" ,  "fin"=>"" ,  "acciones" =>"", "ciclo_conferencias" => "No", "ciclo_nombre" => "");
		return $campos;
	}
	
	//extrae los valores de una tabla y los coloca en el arreglo correspondiente
	//constuye una sentencia sql tipo select campo1,campo2 from tabla where condicion y la ejecuta
	//el valor de campo1,2.... se extrae del arreglo definido en obtenReferencia
	public static function ObtenValoresTabla($actividadId)
	{
		$arr = ActividadDALC::obtenCampos(); //
		$campos = array_keys($arr);
		$query ="select ";
		$coma = "";
		foreach($campos as $campo)
		{
			$query.= ($coma.$campo);
			$coma = ",";
		}
		$query.=" from actividad where actividadId = ".$actividadId;
		//echo "func valores tabla:".$query;
		$oDb = DbFactory::ObtenDb();
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;  //el arreglo q regresa trae la misma estructura q el q se trajo de otenReferencia pero ya con valores
	}
	
}