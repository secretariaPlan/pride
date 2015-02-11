<?php
//Para manejar los catalogos auxiliares (ejm titulos, nacionalidades, edo civil, etc)
//javier Alpizar, 18 Feb 08

include_once("phplib/DbFactory.inc.php");
include_once("lib/Auxiliares.php");

//Como los catalogo suelen usarse varios dentro del mismo programa y para no generar conexiones en cada uno
//los metodos no se hacen estaticos y asi comparten la conexion.
class AuxiliaresDALC
{
	private $oDb;

	public function __construct()
	{	
		$this->oDb = DbFactory::ObtenDb();
	}
	
	//permite construir un auxiliar en forma generica
	//Usado por las tablas:
	//a_nivel_aux
	public function AuxiliarObtener($tabla,$id,$nombre)
	{
		$query = "select $id, $nombre from $tabla order by $nombre";
		//echo $query;
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Auxiliar($rs[$id],$rs[$nombre]);
		}
		
		return $arr;
	}
	
	//dependiendo del nivel del usaurio logeado regresa los niveles que tiene derecho para usar (para dar de alta) 
	public function NivelesObtener($nivelActual)
	{
		$query = "select id,nombre from a_nivel_aux where nivelMinimo >= $nivelActual";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Auxiliar($rs["id"],$rs["nombre"]);
		}
		return $arr;
	}
	
	public static function MesesObtener()
	{
		$meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$arr = array();
		$iCont=1;
		foreach($meses as $mes)
		{
			$arr[] = new Mes($iCont++,$mes);
		}
		return $arr;
	}
		
	public static function AniosObtener()
	{
		
		$arr = array();
		$iCont=0;
		$yearHoy = date("Y");
		$inicio = $yearHoy - 70;
		$fin = $yearHoy + 10; 
		for($i=$inicio; $i<$fin;$i++)
		{
			$arr[] = new Anio($i,$i);
		}
		return $arr;
	}
	
	
}


?>