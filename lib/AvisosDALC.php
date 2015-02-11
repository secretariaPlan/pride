<?php
//Para obtener los avisos tanto personales como generales
//Javier Alpizar, 16 Feb 08

include_once("phplib/DbFactory.inc.php");
//aunque funciona sin el lib la llamada de abajo, si en el directorio raiz existe una archivo q se llama igual
//se carga ese en lugar de este, por eso se le pone el lib antes del archivo.
include_once("lib/Aviso.php");

class AvisosDALC
{
	/*
	//Obtiene los avisos para un profesor, todos si no se indica la cantidad
	public static function Profesores($profesorId,$cantidad=1000)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select avisoId,fecha,titulo,contenido from aviso_profesor where profesorId = $profesorId order by fecha desc limit 0,$cantidad";
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = new Aviso($rs["avisoId"],$rs["fecha"],$rs["titulo"],$rs["contenido"]);
		}
		return $arr;
		
	}
	
	//Obtiene los avisos generales, todos si no se indica la cantidad
	public static function Generales($cantidad=1000)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select avisoId,fecha,titulo,contenido from aviso_general order by fecha desc limit 0,$cantidad";
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = new Aviso($rs["avisoId"],$rs["fecha"],$rs["titulo"],$rs["contenido"]);
		}
		return $arr;
		
	}
	*/
	
	//select avisoId,titulo,fecha,contenido from aviso where destinoAuxId=0 union all select avisoId,titulo,fecha,contenido from aviso where destinoAuxId=1 order by fecha desc limit 0,2
	//Obtiene un listado de todos los mensajes uniendo profs y generales limitando el numero de acuerdo al paginador
	
	public static function ObtenAvisos($profesorId,$inicio=0,$cantidad=100000)
	{
		$oDb = DbFactory::ObtenDb();
		//la primera parte trae los avisos detinoAuxId=0 q siginifica mensajes para todos
		//la segunda parte los avisos del profesor logeado
		//y finalmente ordena el resultado de ambos por fecha y regresa los registros indicados por el limite
		$query = "select avisoId,titulo,fecha,contenido from aviso where destinoAuxId=0 and publicar='Si'
				 union all 
				 select aviso.avisoId as avisoId,titulo,fecha,contenido from aviso_destino 
				 join aviso on aviso_destino.avisoId = aviso.avisoId where profesorId= $profesorId and publicar='Si'
				 order by fecha desc limit $inicio,$cantidad";
		
		$oDb->query($query);
		//echo $query;
		$arr= array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = new Aviso($rs["avisoId"],$rs["fecha"],$rs["titulo"],$rs["contenido"]);
		}
		return $arr;
		
	}
	
	//El total de regs existentes
	public static function AvisosTotal($profesorId)
	{
		$oDb = DbFactory::ObtenDb();
		//aviso_general.fooId fue una columna q se creo para poder hacer el uniom, siempre tiene un valor cero
		//y permite diferenciar los mensajes q son para profs de los que no lo son.
		$query = "select avisoId,titulo,fecha,contenido from aviso where destinoAuxId=0
				 union all 
				 select aviso.avisoId as avisoId,titulo,fecha,contenido from aviso_destino 
				 join aviso on aviso_destino.avisoId = aviso.avisoId where profesorId= $profesorId";
				 
		//echo $query;
		$oDb->query($query);
		return $oDb->len();
	}
	
	public function ObtenAviso($avisoId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select fecha,titulo,contenido from aviso where avisoId = $avisoId";
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return new Aviso($avisoId,$rs["fecha"],$rs["titulo"],$rs["contenido"]);
	}
	/*
	//Regresa un aviso especifico
	public static function ObtenAvisoProfesor($avisoId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select fecha,titulo,contenido from aviso_profesor where avisoId = $avisoId";
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return new Aviso($avisoId,$rs["fecha"],$rs["titulo"],$rs["contenido"]);
	}
	
//Regresa un aviso especifico
	public static function ObtenAvisoGeneral($avisoId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select fecha,titulo,contenido from aviso_general where avisoId = $avisoId";
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return new Aviso($avisoId,$rs["fecha"],$rs["titulo"],$rs["contenido"]);
	}
	
	*/
	
	
}
?>