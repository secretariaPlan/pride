<?php
//El DALC de avisos
//Javier Alpizar, 22 Abr 08

include_once("phplib/DbFactory.inc.php");

class AvisoDALC
{
	
	//Obtiene un listado de todos los aviso limitando el numero de acuerdo al paginador
	//regrsa un arreglo 
	public static function ObtenAvisos($inicio=0,$fin=100000)
	{
		$oDb = DbFactory::ObtenDb();
		
		$query = "SELECT avisoId,fecha,titulo,contenido,publicar,web,correo,aviso_destino_aux.nombre as destino
				from aviso
				left join aviso_destino_aux on aviso.destinoAuxId = aviso_destino_aux.id
				order by fecha desc limit $inicio,$fin";
		$oDb->query($query);
		$arr= array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("avisoId"=>$rs["avisoId"],"fecha"=>$rs["fecha"],"titulo"=>$rs["titulo"],"contenido"=>$rs["contenido"],
						   "publicar"=>$rs["publicar"],"web"=>$rs["web"],"correo"=>$rs["correo"],
						   "destino"=>($rs["destino"] == NULL) ? "Todos" : $rs["destino"]);
		}
		return $arr;
		
	}
	
	//El total de avisos existentes
	public static function AvisosTotal()
	{
		$oDb = DbFactory::ObtenDb();
		$query = "SELECT count(avisoId) from aviso";
		$oDb->query($query);
		$arr= array();
		$rs = $oDb->getRecord();
		return $rs[0];
		
	}
	
	public function ObtenAviso($avisoId)
	{
		$oDb = DbFactory::ObtenDb();
		
		$query = "SELECT avisoId,fecha,titulo,contenido,publicar,web,correo,destinoAuxId from aviso where avisoId=$avisoId";
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}

	//Obtiene un arr de profesores que reciben un aviso en particular  listado de 
	public function ObtenDestinos($avisoId)
	{
		$oDb = DbFactory::ObtenDb();
		
		$query = "SELECT avisoDestinoId,nombre,apaterno,amaterno,profesor.profesorId as profesorId 
					from aviso_destino
					join profesor on aviso_destino.profesorId = profesor.profesorId order by nombre";
		$oDb->query($query);
		$arr= array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("avisoDestinoId"=>$rs["avisoDestinoId"],"profesor"=>$rs["nombre"]." ".$rs["apaterno"]." ".$rs["amaterno"],"profesorId"=>$rs["profesorId"]);
		}
		return $arr;
		
		
	}
		
}
?>