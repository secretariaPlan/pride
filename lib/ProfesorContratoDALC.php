<?php
//El DALC para datos contractuales del prof
//javier Alpizar, 25 Feb 08

include_once("phplib/DbFactory.inc.php");
include_once("fecha_rango.php");
include_once("ProfesorContrato.php");

class ProfesorContratoDALC
{
	public static function ObtenContrato($profesorId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select ingreso,numTrabajador from profesor where profesorId = $profesorId";
		$oDb->query($query);
		$rs= $oDb->getRecord("C");
		$contrato = new Contrato();
		$contrato->FechaIngreso = $rs["ingreso"];
		$contrato->NumTrabajador = $rs["numTrabajador"];
		return $contrato;
		
	}
	
	public static function ObtenUbicacion($profesorId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select oficina,fax,tel8,tel5,tel3,
				 ubicacion_edificio_aux.nombre as edificio,edificioId,plantaId,
				 ubicacion_planta_aux.nombre as planta
				 from profesor
				 left join ubicacion_edificio_aux on profesor.edificioId = ubicacion_edificio_aux.id
				 left join ubicacion_planta_aux on profesor.plantaId = ubicacion_planta_aux.id
				 where profesorId=$profesorId";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		$ubicacion = new Ubicacion();
		$ubicacion->ProfesorId=$profesorId;
		$ubicacion->Edificio=$rs["edificio"];
		$ubicacion->Cubiculo=$rs["oficina"];
		$ubicacion->Fax=$rs["fax"];
		$ubicacion->Planta=$rs["planta"];
		$ubicacion->Tel3=$rs["tel3"];
		$ubicacion->Tel5=$rs["tel5"];
		$ubicacion->Tel8=$rs["tel8"];
		$ubicacion->Oficina=$rs["oficina"];
		$ubicacion->EdificioId=$rs["edificioId"];
		$ubicacion->PlantaId=$rs["plantaId"];
		return $ubicacion;
	}
	
	//Regresa un arr de obj NombramientoFacultad con los nombrams de un prof dentro de FQ
	public static function ObtenNombramientosFacultad($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select nombramiento_aux.nombre as nombramiento,
				  categoria_aux.nombre as categoria,
				  nivel_aux.nombre as nivel,
				  tiempo_aux.nombre as tiempo,
				  contrato_aux.nombre as contrato,
				  horas,
				  inicio,
				  fin,
				  depto_aux.nombre as depto,
				  deptoOtro 
				  from 	nombramiento_fq 
					left join nombramiento_aux on nombramiento_fq.nombramientoAuxId =  nombramiento_aux.nombramientoAuxId 
					left join categoria_aux on nombramiento_fq.categoriaAuxId = categoria_aux.categoriaAuxId
					left join nivel_aux on nombramiento_fq.nivelAuxId = nivel_aux.nivelAuxId
					left join contrato_aux on nombramiento_fq.contratoAuxId = contrato_aux.contratoAuxId
					left join tiempo_aux on nombramiento_fq.tiempoAuxId = tiempo_aux.tiempoAuxId
					left join depto_aux on nombramiento_fq.deptoAuxId = depto_aux.deptoAuxId
					where profesorId = $profesorId ";
		if ($inicio != NULL or $fin != NULL)
		{
			//$fechas = " and (fin <=> NULL or (inicio >='$inicio' and inicio <= '$fin') )";  //para q incluya los regs con no terminado => fin=null
			//$fechas = " ( and inicio >= '$inicio' and inicio <= '$fin' or fin <=> NULL)";
			//$fechas = " and ".Fecha_Rango::ObtenRango($inicio,$fin);
			//se pidio q no se contemplaran las fechas 8 feb 11 
			
			//$query .= $fechas;
		}
		//echo $query;
		$query.= " order by inicio desc";
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$nombr = new NombramientoFacultad();
			$nombr->Categoria = $rs["categoria"];
			$nombr->Departamento=$rs["depto"];
			$nombr->Fin=$rs["fin"];
			$nombr->Inicio=$rs["inicio"];
			$nombr->Nivel=$rs["nivel"];
			$nombr->Nombre = $rs["nombramiento"];
			$nombr->Tiempo = $rs["tiempo"]."/".$rs["horas"];
			$nombr->TipoContrato=$rs["contrato"];
			$arr[] = $nombr;
		}
		return $arr;
	}
	
	//Los nombramientos q tiene un progfesor dentro de la UNAM
	public static function ObtenNombramientosUNAM($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select nombramiento_aux.nombre as nombramiento,
				  categoria_aux.nombre as categoria,
				  nivel_aux.nombre as nivel,
				  tiempo_aux.nombre as tiempo,
				  contrato_aux.nombre as contrato,
				  dependencia_aux.nombre as dependencia,subDepAuxId,
				  horas,
				  inicio,
				  fin,
				  depto_aux.nombre as depto,
				  deptoOtro 
				  from 	nombramiento_unam 
					left join nombramiento_aux on nombramiento_unam.nombramientoAuxId =  nombramiento_aux.nombramientoAuxId 
					left join categoria_aux on nombramiento_unam.categoriaAuxId = categoria_aux.categoriaAuxId
					left join nivel_aux on nombramiento_unam.nivelAuxId = nivel_aux.nivelAuxId
					left join contrato_aux on nombramiento_unam.contratoAuxId = contrato_aux.contratoAuxId
					left join tiempo_aux on nombramiento_unam.tiempoAuxId = tiempo_aux.tiempoAuxId
					left join depto_aux on nombramiento_unam.deptoAuxId = depto_aux.deptoAuxId
					left join dependencia_aux on nombramiento_unam.dependenciaAuxId = dependencia_aux.dependenciaAuxId 
					where profesorId = $profesorId";
		if ($inicio != NULL or $fin != NULL)
		{
			//$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			//$fechas = " and (fin <=> NULL or (inicio >='$inicio' and inicio <= '$fin') )";  //para q incluya los regs con no terminado => fin=null
			//$fechas = " and ".Fecha_Rango::ObtenRango($inicio,$fin);
			//se pidio q no se contemplaran las fechas 8 feb 11
			//$query .= $fechas;
		}
		//echo $query;
		$oDb->query($query);
		$arr = array();
		
		while ($rs = $oDb->getRecord("C"))
		{
			$nombr = new NombramientoUNAM();
			$nombr->Categoria = $rs["categoria"];
			$nombr->Departamento=$rs["depto"];
			$nombr->Fin=$rs["fin"];
			$nombr->Inicio=$rs["inicio"];
			$nombr->Nivel=$rs["nivel"];
			$nombr->Nombre = $rs["nombramiento"];
			$nombr->Tiempo = $rs["tiempo"]."/".$rs["horas"];
			$nombr->TipoContrato=$rs["contrato"];
			//$arr[] = $nombr;
			$nombr->Entidad=$rs["subDepId"];  //falta definir donde esta el aux de esta
			$nombr->EntidadNombre=$rs["dependencia"];
			$arr[] = $nombr;
		}
		//echo "-------------------------------";
		//var_dump($arr);
		return $arr;
	}
	
	public static function ObtenOtrosEmpleos($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id,empresa,puesto,inicio,fin from profesor_otroempleo where profesorId = $profesorId ";
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			$query .= $fechas;
		}
		$query.= " order by inicio desc";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		
		while ($rs=$oDb->getRecord("C"))
		{
			$nombr = new EmpleoOtro();
			$nombr->Id = $rs["id"];
			$nombr->Empresa = $rs["empresa"];
			$nombr->Puesto=$rs["puesto"];
			$nombr->Fin=$rs["fin"];
			$nombr->Inicio=$rs["inicio"];
			$arr[] = $nombr;
		}
		return $arr;
	}
	
	public static function ObtenOtroEmpleo($empleoId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id,empresa,puesto,inicio,fin,tel,horas,descripcion from profesor_otroempleo where id = $empleoId";
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
		
	
	
}
?>