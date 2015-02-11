<?php
//Dalc de profesores
//22 Abr 08

include_once("phplib/DbFactory.inc.php");

class PwdMaestroDALC
{
	
	//Obtiene un listado de todos los aviso limitando el numero de acuerdo al paginador
	//regrsa un arreglo 
	public static function ObtenPwd()
	{
		$oDb = DbFactory::ObtenDb();
		
		$query = "SELECT pwd from pwdmaestro limit 0,1";
				
		$oDb->query($query);
		$arr= array();
		$rs = $oDb->getRecord();
		return $rs[0];
		
	}
	
	public static function Cambia($pwd)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "update pwdmaestro set pwd='".$pwd."'";
		$r = $oDb->executeNonQuery($query);
		return $r;
	}
}
	