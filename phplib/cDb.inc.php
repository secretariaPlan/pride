<?
class cDb {
	 var $iConn,$oRs;
	 
	 function cDb(){
	 }
	 
	 	 			 
	 function connect($sDatabase,$sServer="localhost",$sUsuario="",$sPwd=""){
	 	 echo "metodo connect no definido para esta clase";
	 }
	 
	 function query($sSql){
 		 echo "metodo query no definido para esta clase";
	 }
	 
	 function getRecord($sTipo="numerico"){	 
	 	echo "metodo getrecord no definido para esta clase";
	 }
	 
	 
	 function goTop(){
	 	 echo "metodo goTop no definido para esta clase";
	 }
	 
	 //regresa el numero de filas o renglones encontrados
	 function len(){
	 	 echo "metodo len no definido para esta clase";
	 }
	 
	 function getReg(){
	 	 echo "metodo getreg no definido para esta clase";
	 }
	 
	 function closedb(){
	 echo "metodo closedb no definido para esta clase";
	 }
	 
	 //regresa el ultimo numero agregado de un cmapo autoincrement
	 function insertid(){
	 	echo "metodo insertid no definido en esta clase";
	}
	
	//regresa el numero de regs afectados por una sentencia insert,delete update o replace
	function nrecs() {
		echo "metodo nrecs no esta definido en esta clase";
	} 
}?>