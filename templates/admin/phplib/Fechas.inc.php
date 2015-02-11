<?
//algunos formatos de fechas
class Fechas
{
	public static $meses = array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
	
	//recibe una fecha tipo 2008-10-23
	//regresa Oct 23, 2008
	public static function FechaEspCorta($fecha)
	{
		//$meses = array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
		if ($fecha == NULL)
			return "";
		return substr(self::$meses[substr($fecha,5,2)],0,3)." ".substr($fecha,8,2).", ".substr($fecha,0,4);
	}

	//recibe una fecha tipo 2008-10-23 10:20:45
	//regresa Oct 23, 2008 10:20:45
	public static function FechaTiempoEspCorta($fecha)
	{
		//$meses = array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
		if ($fecha == NULL)
			return "";
		return substr(self::$meses[substr($fecha,5,2)],0,3)." ".substr($fecha,8,2).", ".substr($fecha,0,4).substr($fecha,11);
	}
	
	//recibe una fecha tipo 2008-10-23
	//regresa Octubre 23, 2008
	public static function FechaEspLarga($fecha)
	{
		//$meses = array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");

		if ($fecha == NULL)
			return "";
		return self::$meses[substr($fecha,5,2)]." ".substr($fecha,8,2).", ".substr($fecha,0,4);
	}
	
	//Para convertir fechas  del tipo dd-mm-yyyy a yyyy-mm-dd q es como lo necesita recibir mysql
	public static function ObtenFechaDb($fecha)
	{
		if ($fecha=="")
			return NULL; //ojo, ver q la db este configurada para aceptar NULLS
		else
			return substr($fecha,6)."-".substr($fecha,3,2)."-".substr($fecha,0,2);
	}
	
	//Para convertir fechas  del tipo dd-mm-yyyy a yyyy-mm-dd hh:mm:ss q es como lo necesita recibir mysql
	public static function ObtenFechaTiempoDb($fecha)
	{
		if ($fecha=="")
			return NULL; //ojo, ver q la db este configurada para aceptar NULLS
		else
			return substr($fecha,6)."-".substr($fecha,3,2)."-".substr($fecha,0,2)." ".date("H").":".date("i").":".date("s");
	}
	
	//Para convertir fechas  del tipo yyyy-mm-dd a dd-mm-yyyy  q es como lo necesita ve el usuario
	public static function ObtenFechaUsuario($fecha)
	{
		if ($fecha=="" or $fecha==NULL)
			return  "";
		else
		 return substr($fecha,8,2)."-".substr($fecha,5,2)."-".substr($fecha,0,4);
	}
}
?>