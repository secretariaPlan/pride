<?

include_once("cDb.inc.php");

class cDbMysql extends cDb {
	 //la estructura de la funcion se hace asi de tal manera q en la mayoria
	 //de los casos solo sea necesario llama la funcion con el nombre de la base
	 //de datos por ejemplo connect("Educomsa") y todos los demas datos los toma de aqui
	 function connect($sDatabase, $sServer="localhost", $sUsuario="sicpa_user", $sPwd="Sicp@U2561") {
		if (!($this->iConn = @mysql_connect($sServer,$sUsuario,$sPwd))) {
			echo "Error de conexión al servidor<br>";
			return 0;		
		}
		
		if (!@mysql_select_db($sDatabase,$this->iConn) ) {
			echo "Error, no se pudo conectar a la base de datos<br>";
			return 0;
		}
		return 1;  //solo regresa 1 si se conecto al server y a la base de datos
	 }
	 
	 //realiza un query y regresa 1 si fue exitosa la busqueda aunq no necesariamente q existen registros
	 function query($sSql){
	 	//echo $sSql;
		$this->oRs = @mysql_query($sSql,$this->iConn);
		$r = 1;
		if (!$this->oRs) {
			$r = 0;
		}
		return $r;
	 }
	 
	 
	 
	 //Para ejectuar sentencias update, delete o insert, regresa 0 si la sentencia no se ejecuto correctamente o si no se afecto ningun registro
	 function executeNonQuery($sSql)
	 {
		 $this->oRs = @mysql_query($sSql,$this->iConn);
		 $nregs = mysql_affected_rows();
		 if (!$this->oRs or $nregs == 0) 
		 	return 0;
		return $nregs;
	 }
	 
	function info()
	{
		return mysql_info();
	}
	
	function getRecord($sTipo="numerico"){
		//el fetch regresa un arreglo con el registro actual y avanza al sig. reg.
		//arreglo vacio si no hay nada 
		if ($sTipo == "numerico"){
			$aRecord =  mysql_fetch_row($this->oRs);
		}else {
			$aRecord = mysql_fetch_array($this->oRs);
		}
		return $aRecord;
	}
		
	
			
	function goTop(){
		return mysql_data_seek($this->oRs,0);
	}
	 
	function len(){
		return mysql_num_rows($this->oRs);
	}
	
	function closedb(){
		mysql_close($this->iConn);
	}
	
	function close()
	{
	mysql_close($this->iConn);
	}	
	
	//regresa el ultimo numero agregado del campo de autoincremento
	function insertid() {
		return mysql_insert_id($this->iConn);
	}
	
	function nrecs() {
		return mysql_affected_rows($this->iConn);
	}
}
?>