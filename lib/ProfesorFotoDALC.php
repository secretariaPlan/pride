<?php
//para obtener y guardar la foto de un profesor

include_once("phplib/DbFactory.inc.php");

class ProfesorFotoDALC
{
	//regresa el nombre del archivo de la foto del prof.
	public static function ObtenFotoNombre($profesorId)
	{
		
		$oDb = DbFactory::ObtenDb();
		$query = "select foto from profesor where profesorId = $profesorId";
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs["foto"];
		
		//return "foto.gif";
	}
	
	public static function GuardaFotoNombre($profesorId,$fotoNombre)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "update profesor set foto='$fotoNombre' where profesorId = $profesorId";
		$oDb->query($query);
		return 0;
	}
	
	public static function BorraFoto($profesorId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "update profesor set foto='' where profesorId = $profesorId";
		$oDb->query($query);
		return 0;
	}
	
}

?>