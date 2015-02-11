<?php
//El DALC de contactos
//Javier Alpizar, 24 Abr 08

include_once("phplib/DbFactory.inc.php");

class ContactoDALC
{
	
	//Obtiene un listado de todos los aviso limitando el numero de acuerdo al paginador
	//regrsa un arreglo 
	public static function ObtenContactos($inicio=0,$fin=100000,$estatus="")
	{
		$estatusSQL ="";
		if ($estatus != "")
		{
			$estatusSQL = " where estatus = '$estatus' ";
		}
		$oDb = DbFactory::ObtenDb();
		
		$query = "SELECT contactoId,fecha,comentario,profesorEmail,estatus,respuesta,respuestaFecha,nombre,apaterno,amaterno
				from contacto
				left join profesor on contacto.profesorId = profesor.profesorId".$estatusSQL."
				order by fecha desc limit $inicio,$fin";
		$oDb->query($query);
		$arr= array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("contactoId"=>$rs["contactoId"],"fecha"=>$rs["fecha"],"comentario"=>$rs["comentario"],"estatus"=>$rs["estatus"],
						   "nombre"=>$rs["nombre"]." ".$rs["apaterno"]." ".$rs["amaterno"],
						   "correo"=>$rs["profesorEmail"],
						   "respuesta"=>$rs["respuesta"],
						   "respuestaFecha"=>$rs["respuestaFecha"]);
		}
		return $arr;
		
	}
	
	//El total de avisos existentes
	public static function ContactosTotal($estatus="")
	{
		$estatusSQL ="";
		if ($estatus != "")
		{
			$estatusSQL = " where estatus = '$estatus' ";
		}
		$oDb = DbFactory::ObtenDb();
		$query = "SELECT count(contactoId) from contacto".$estatusSQL;
		$oDb->query($query);
		$arr= array();
		$rs = $oDb->getRecord();
		return $rs[0];
		
	}
	
	public static function ObtenContacto($contactoId)
	{
		$oDb = DbFactory::ObtenDb();
		
		$query = "SELECT contactoId,fecha,comentario,respuestaFecha,respuesta,profesorEmail,estatus,nombre,apaterno,amaterno 
		from contacto 
		join profesor on contacto.profesorId = profesor.profesorId
		where contactoId=$contactoId";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
}
?>