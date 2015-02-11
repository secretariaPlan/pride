<?
	//Para crear un objeto de base de datos, esta basada en el patron Factory, que recibe un texto y regresa una clase instanciada del texto indicado
	//Javier Alpizar, 1 Nov 05

	//include_once("ebooks.config.php");
	
	class DbFactory
	{
	
		public static function ObtenDb()
		{
			require("app.config.php");	//este archivo esta incluido  en cada aplicacion y define variables como el tipo de db, nombre, etc.
			$dbms = $default["DBMS"];
			include_once($default["LIBPATH"].$dbms.".inc.php");
			$oDb = new $dbms;
			$oDb->connect($default["DBNAME"]);
			return $oDb;
		}
	}
?>