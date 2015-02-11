<?php
//El DALC de Apoyo a servicios
//Javier Alpizar, 3 Abr 08

include_once("phplib/DbFactory.inc.php");

class ServicioDALC
{
	

	public static function ObtenServicios($profesorId)
	{
		
		$oDb = DbFactory::ObtenDb();
		$query ="select servicioId,servicio_tipo_aux.nombre servicioTipo,servicioTipoOtro,servicio.nombre,inicio,fin,ingresoExtra,horasxSemana 
				from servicio
				left join servicio_tipo_aux on servicio.servicioTipoId = servicio_tipo_aux.id
				where profesorId = $profesorId ";
		//echo $query;
		
		
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("servicioId"=>$rs["servicioId"],
						   	"nombre"=>$rs["nombre"],"inicio"=>$rs["inicio"],"fin"=>$rs["fin"],"ingresoExtra"=>$rs["ingresoExtra"],
							"horasxSemana"=>$rs["horasxSemana"],
							"servicioTipo"=>($rs["servicioTipo"] == NULL) ? $rs["servicioTipoOtro"] : $rs["servicioTipo"]);
							
		}
		/*$arr[] = array("servicioId"=>1,
						   	"nombre"=>"Serv X",
							"servicioTipo"=>"tipo1");*/
			
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