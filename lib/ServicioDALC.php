<?php
//El DALC de Apoyo a servicios
//Javier Alpizar, 3 Abr 08

include_once("phplib/DbFactory.inc.php");
include_once("fecha_rango.php");

class ServicioDALC
{
	

	public static function ObtenServicios($profesorId,$inicio=NULL,$fin=NULL)
	{
		
		$oDb = DbFactory::ObtenDb();
		$query ="select servicioId,servicio_tipo_aux.nombre servicioTipo,servicioTipoOtro,
				servicio.nombre,inicio,fin,ingresoExtra,horasxSemana,nivel,duracion,
				servicio_tipo_aux.id as servicioAuxId,descripcion
				from servicio
				left join servicio_tipo_aux on servicio.servicioTipoId = servicio_tipo_aux.id
				where profesorId = $profesorId ";
				//echo $query;
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = Fecha_Rango::ObtenRango($inicio,$fin);
			$query .= "and ".$fechas;
		}
		$query.= " order by servicio_tipo_aux.nombre,inicio desc";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("servicioId"=>$rs["servicioId"],
						   	"nombre"=>$rs["nombre"],"inicio"=>$rs["inicio"],"fin"=>$rs["fin"],"ingresoExtra"=>$rs["ingresoExtra"],
							"horasxSemana"=>$rs["horasxSemana"],
							"descripcion"=>$rs["descripcion"],
							"nivel"=>$rs["nivel"],"duracion"=>$rs["duracion"],
							"servicioTipo"=>($rs["servicioTipo"] == NULL) ? $rs["servicioTipoOtro"] : $rs["servicioTipo"],
							"servicioAuxId"=>($rs["servicioAuxId"] == NULL) ? 0 : $rs["servicioAuxId"]
			);
							
		}
		for($ix=0;$ix<sizeof($arr);$ix++)
		{
			$query = "select count(id) from servicio_instituciones where servicioId='".$arr[$ix]["servicioId"]."'";
			//echo $query;
			$oDb->query($query);
			$rs = $oDb->getRecord();
			$arr[$ix]["instituciones"] = $rs[0];
			
		}
		/*$arr[] = array("servicioId"=>1,
						   	"nombre"=>"Serv X",
							"servicioTipo"=>"tipo1");*/
			
		//var_dump($arr);
		return $arr;
		
	}
	
	public static function ObtenServicio($servicioId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select nombre,servicioTipoId,servicioTipoOtro,descripcion,ingresoExtra,inicio,fin,horasxSemana,nivel,duracion 
				 from servicio where servicioId = $servicioId";
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;		 
	}
	
	//Las instituciones a las q se les sirvio
	public static function ObtenInstituciones($servicioId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select id,facultad_aux.nombre as facultad,servicio_instituciones.facultadId as facultadId,
				facultadOtro,inicio,fin,horasxSemana,capacitadoNombre,capacitadoNivel,programaDuracion
				from servicio_instituciones
				left join facultad_aux on servicio_instituciones.facultadId = facultad_aux.facultadId
				 where servicioId = $servicioId";
		//echo $query;
		/*if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and inicio >= '$inicio' and inicio <= '$fin'";
			$query .= $fechas;
		}*/
		$query.= " order by  inicio desc";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("facultadId"=>$rs["facultadId"],
						   "facultad"=>($rs["facultad"]==NULL) ? $rs["facultadOtro"] : $rs["facultad"],
						   "inicio"=>$rs["inicio"],"fin"=>$rs["fin"],
						   "horasxSemana"=>$rs["horasxSemana"],
						   "capacitadoNombre"=>$rs["capacitadoNombre"],
						   "capacitadoNivel"=>$rs["capacitadoNivel"],
						   "programaDuracion"=>$rs["programaDuracion"]	);
		}
		//var_dump($arr);
		/*$arr[] = array("facultadId"=>1,
						   "facultad"=>"FCA",
						   "inicio"=>"2001-01-01","fin"=>"2002-02-02",
						   "horasxSemana"=>10,
						   "capacitadoNombre"=>"jav",
						   "capacitadoNivel"=>"alpi",
						   "programaDuracion"=>3);*/
		return $arr;		 
	}
}
?>