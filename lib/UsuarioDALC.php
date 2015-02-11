<?

//El DALC de usuaros
//Javier Alpizar, 2 Abr 08

include_once("phplib/DbFactory.inc.php");

class UsuarioDALC
{ 
	
	
	
	public static function ObtenUsuarios()
	{
		
		$oDb = DbFactory::ObtenDb();
		$query ="select usuarioId,clave,a_usuario.nombre as nombre,activo,
				 a_nivel_aux.nombre as nivel 
				 from a_usuario
				 join a_nivel_aux on a_usuario.nivelId = a_nivel_aux.id
				  order by nombre";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = $rs;
							
							
		}
		return $arr;
		
	}

	public static function ObtenUsuario($usuarioId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select clave,nombre,nivelId,activo,pwd
				 from a_usuario where usuarioId = $usuarioId";
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;		 
	}
}	
 ?>