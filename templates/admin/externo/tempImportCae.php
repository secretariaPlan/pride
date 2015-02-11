<?php
//Un temporal para traerse rapido los datos de un semestre de cae
//Javier Alpizar, 26 May 08

set_time_limit(0);

define("NUM_UNICO",0);
define("ASIGNATURACLAVE",1);
define("RFC",2);
define("YEAR",3);  //yyyy
define("SEM",4);   //[1,2]
define("TIPO",5); //Lab,Teoria,Probs,Discusion
define("ASIGNATURANOMBRE",6);
define("INICIO",7);   //hora de inicio, militar 0,100=1am,900=9am, 1000=10 am
define("FIN",8); //igual q arriba
define("DIA",9);  //1-7 L-D
define("GRUPO",10);  //el grupo

include_once("../phplib/DbFactory.inc.php");
$oDb = DbFactory::ObtenDb();

$handle = fopen("cae_academico080526.csv","r");
$ok=0;
$mal=0;
$cont=0;

//viene ordenado por rfc,asignatura,tipo,dia,grupo
$profesorId = 0;
$profsNoEncontrados = array();
$asignaturasMalas = array(); //las asignaturas de las q no pudo encontrar clave
$clases = array();

while ( ($data  = fgetcsv($handle)) !== FALSE ) //and $cont++ < 300)
{
	$profesorId = ObtenProfesorId($data[RFC]);
	//echo $profesorId;
	if ($profesorId == 0)
	{
		$profsNoEncontrados[] = $data[RFC];
		continue;
	}
		
	$asignaturaId = ObtenClaveAsignatura($data[ASIGNATURACLAVE],$data[ASIGNATURANOMBRE]);
	if ($asignaturaId == 0)
	{
		$asignaturasMalas[] = $data[ASIGNATURACLAVE];
		continue;
	}
	
	$llave = $profesorId."_".$asignaturaId."_".$data[TIPO]."_";
	$minutos = ObtenTiempoTranscurrido($data[INICIO],$data[FIN]);
	//echo $data[RFC]." ".$minutos." ".$llave;
	if (array_key_exists($llave,$clases))
		$clases[$llave] += $minutos;
	else
		$clases[$llave] = $minutos;	
	//echo " total: ".$llave." ".$clases[$llave]."<br>";
}
foreach($clases as $key=>$value)
{
	$aKeys = explode("_",$key);  //profesorId, asignaturaId, tipo[L,T,P,D]
	$minutos = $value;
	$query = "insert into curso_licenciatura set a_cae_semestreId = 1,year=2008,semestre=2,cursoTipoId='$aKeys[2]',
				profesorId=$aKeys[0],asignaturaId=$aKeys[1],minutos=$minutos";
	$r = $oDb->query($query);
	//if ($r == 0)
		//echo $query;
	echo $query."-".$key."-<br>";
}
//print_r($clases);
echo "Profs. no encontrados:".sizeof($profsNoEncontrados)."<br>";
print_r($profsNoEncontrados);
echo "Asig. no encontrados:".sizeof($asignaturasMalas)."<br>";
//a partir de un rfc obtiene el id del prof corresp
function ObtenProfesorId($rfc)
{
	global $oDb;
	//el largo total de un rfc es aimj700101rfw 13 incluyendo la homoclave
	$largo = strlen($rfc);
	if ($largo < 8)  //no los tomes en cuenta
		return 0;
	if ($largo == 13)
		$query = "select profesorId from profesor where rfc='".$rfc."'";
	else
		$query = "select profesorId from profesor where substring(rfc,1,$largo)='$rfc'";
	echo $query."<br>";
	$oDb->query($query);
	$rs = $oDb->getRecord();
	$profesorId = 0;
	if (is_array($rs))
		$profesorId = $rs[0];
	return $profesorId;
}
//Busca una asigntura, si no encuentra la clave la agrega, regresa el id correpondiente
function ObtenClaveAsignatura($clave,$nombre)
{
	global $oDb;
	$query = "select asignaturaId from asignatura where clave = '$clave'";
	$oDb->query($query);
	$rs = $oDb->getRecord();
	if (is_array($rs))
		return $rs[0];
	else
		return 0;
	/*	
	{
		$query = "insert into asignatura set clave='$clave',nombre='$nombre'";
		//echo $query."<br>";
		$r = $oDb->query($query);
		$id = 0;
		if ($r >0)
			$id = $oDb->insertid();
		return $id;
			
	}
	*/
}

//regresa en minutos el tiempo transcurrido entre inicio y fin
//la hoar es militar, ejm 900= 9:00, 1700 = 17:00
function obtenTiempoTranscurrido($horaInicio,$horaFinal)
{
	
	$minIni = substr($horaInicio,-2);  //2 carac de la derecha
	$horaIni = substr($horaInicio,0,-2); //empieza y deja dos caracteres
	$minFin = substr($horaFinal,-2);
	$horaFin = substr($horaFinal,0,-2);
	$tiempo =  ( ($horaFin*60)+$minFin) -  ( ($horaIni*60)+$minIni );
	return $tiempo;
}