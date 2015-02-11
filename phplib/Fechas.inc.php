<?
//algunos formatos de fechas
class Fechas
{
	public static $meses = array("01"=>"enero","02"=>"febrero","03"=>"marzo","04"=>"abril","05"=>"mayo","06"=>"junio","07"=>"julio","08"=>"agosto","09"=>"septiembre","10"=>"octubre","11"=>"noviembre","12"=>"diciembre");
	
	//recibe una fecha tipo 2008-10-23
	//regresa 23/10/08
	//pidieron q el formato fuero mmddaa
	public static function FechaEspCorta($fecha)
	{
		/*
		//$meses = array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
		if ($fecha == NULL or $fecha == "")
			return "";
		//return substr(self::$meses[substr($fecha,5,2)],0,3)." ".substr($fecha,8,2).", ".substr($fecha,0,4);
		return substr($fecha,8,2)."/".substr($fecha,5,2)."/".substr($fecha,2,2);
		*/
		//$meses = array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
		if ($fecha == NULL or $fecha == ""  or $fecha == "0000-00-00")
			return "";//return "No";
		//return substr(self::$meses[substr($fecha,5,2)],0,3)." ".substr($fecha,8,2).", ".substr($fecha,0,4);
		return substr($fecha,8,2).substr($fecha,5,2).substr($fecha,2,2);
	}
	
	//regresa 23/10/08
	public static function FechaEspCorta2($fecha)
	{
		/*
		//$meses = array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
		if ($fecha == NULL or $fecha == "")
			return "";
		//return substr(self::$meses[substr($fecha,5,2)],0,3)." ".substr($fecha,8,2).", ".substr($fecha,0,4);
		return substr($fecha,8,2)."/".substr($fecha,5,2)."/".substr($fecha,2,2);
		*/
		//$meses = array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
		if ($fecha == NULL or $fecha == "")
			return "";//return "No";
		//return substr(self::$meses[substr($fecha,5,2)],0,3)." ".substr($fecha,8,2).", ".substr($fecha,0,4);
		return substr($fecha,8,2)."/".substr($fecha,5,2)."/".substr($fecha,2,2);
	}
	
	public static function FechaFinEspCorta($fecha)
	{
		//$meses = array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
		if ($fecha == NULL or $fecha == "")
			return "";
		//return substr(self::$meses[substr($fecha,5,2)],0,3)." ".substr($fecha,8,2).", ".substr($fecha,0,4);
		return substr($fecha,8,2).substr($fecha,5,2).substr($fecha,2,2);
	}
	
	//recibe una fecha tipo 2008-10-23
	//regresa Octubre 23, 2008
	public static function FechaEspLarga($fecha)
	{
		//$meses = array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");

		if ($fecha == NULL)
			return "";
		return intval(substr($fecha,8,2))." de ".ucfirst(self::$meses[substr($fecha,5,2)])." de ".substr($fecha,0,4);
	}
	
	//Para convertir fechas  del tipo dd-mm-yyyy a yyyy-mm-dd q es como lo necesita recibir mysql
	public static function ObtenFechaDb($fecha)
	{
		if ($fecha=="")
			return NULL; //ojo, ver q la db este configurada para aceptar NULLS
		else
			return substr($fecha,6)."-".substr($fecha,3,2)."-".substr($fecha,0,2);
	}
	
	//Para convertir fechas  del tipo yyyy-mm-dd a dd-mm-yyyy  q es como lo necesita ve el usuario
	public static function ObtenFechaUsuario($fecha)
	{
		if ($fecha=="" or $fecha==NULL)
			return  "";
		else
		 return substr($fecha,8)."-".substr($fecha,5,2)."-".substr($fecha,0,4);
	}
}
?>