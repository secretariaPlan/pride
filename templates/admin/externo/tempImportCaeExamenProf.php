<?php
//Un temporal para traerse rapido los datos de examenes profesionales
//Javier Alpizar, 28 May 08

set_time_limit(0);

define("ALUMNO_CUENTA",0);
define("ASESOR",1);
define("PDTE",2);
define("SECRETARIO",3);  
define("VOCAL",4);   //
define("SUP1",5); //
define("SUP2",6);
define("FECHA",7);   
define("NOMBRE",8);   //del trabajo presentado
define("ALUMNO_NOMBRE",9); 

include_once("../phplib/DbFactory.inc.php");
$oDb = DbFactory::ObtenDb();

$handle = fopen("cae_exprof080530.csv","r");
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
	$alumnoId = ObtenAlumno($data[ALUMNO_CUENTA],$data[ALUMNO_NOMBRE]);
	///asesor
	/*
	$profesorId = ObtenProfesorId($data[ASESOR]);
	if ($profesorId > 0)
	{
		$fecha="";
		if (strlen($data[FECHA]) > 0)
			$fecha = ",fecha='".$data[FECHA]."'";
		$query = "insert into examen_prof set profesorId = $profesorId,alumnoId=$alumnoId,funcionId=11,nivelId=1,
				nombre='".$data[NOMBRE]."'".$fecha;
		$r = $oDb->query($query);
		if ($r==0)
			echo $query."<br>";
	}*/
	$profesorId = ObtenProfesorId($data[PDTE]);
	if ($profesorId > 0)
	{
		$fecha="";
		if (strlen($data[FECHA]) > 0)
			$fecha = ",fecha='".$data[FECHA]."'";
		$query = "insert into examen_prof set profesorId = $profesorId,alumnoId=$alumnoId,funcionId=1,nivelId=1,
				nombre='".$data[NOMBRE]."'".$fecha;
		$r = $oDb->query($query);
		if ($r==0)
			echo $query."<br>";
	}
	$profesorId = ObtenProfesorId($data[SECRETARIO]);
	if ($profesorId > 0)
	{
		$fecha="";
		if (strlen($data[FECHA]) > 0)
			$fecha = ",fecha='".$data[FECHA]."'";
		$query = "insert into examen_prof set profesorId = $profesorId,alumnoId=$alumnoId,funcionId=3,nivelId=1,
				nombre='".$data[NOMBRE]."'".$fecha;
		$r = $oDb->query($query);
		if ($r==0)
			echo $query."<br>";
	}
	$profesorId = ObtenProfesorId($data[VOCAL]);
	if ($profesorId > 0)
	{
		$fecha="";
		if (strlen($data[FECHA]) > 0)
			$fecha = ",fecha='".$data[FECHA]."'";
		$query = "insert into examen_prof set profesorId = $profesorId,alumnoId=$alumnoId,funcionId=7,nivelId=1,
				nombre='".$data[NOMBRE]."'".$fecha;
		$r = $oDb->query($query);
		if ($r==0)
			echo $query."<br>";
	}
	/*
	$profesorId = ObtenProfesorId($data[SUP1]);
	if ($profesorId > 0)
	{
		$fecha="";
		if (strlen($data[FECHA]) > 0)
			$fecha = ",fecha='".$data[FECHA]."'";
		$query = "insert into examen_prof set profesorId = $profesorId,alumnoId=$alumnoId,funcionId=9,nivelId=1,
				nombre='".$data[NOMBRE]."'".$fecha;
		$r = $oDb->query($query);
		if ($r==0)
			echo $query."<br>";
	}
	$profesorId = ObtenProfesorId($data[SUP2]);
	if ($profesorId > 0)
	{
		$fecha="";
		if (strlen($data[FECHA]) > 0)
			$fecha = ",fecha='".$data[FECHA]."'";
		$query = "insert into examen_prof set profesorId = $profesorId,alumnoId=$alumnoId,funcionId=10,nivelId=1,
				nombre='".$data[NOMBRE]."'".$fecha;
		$r = $oDb->query($query);
		if ($r==0)
			echo $query."<br>";
	}*/
	
}

//trae un rfc y un titulo academico separados por un espacio
function ObtenProfesorId($rfc)
{
	global $oDb;
	$arfc = explode(" ",$rfc);
	$largo = strlen($arfc[0]);
	$query = "select profesorId from profesor where substring(rfc,1,10) = '".$arfc[0]."'";
	$oDb->query($query);
	$rs = $oDb->getRecord();
	//echo $query."<br>";
	if (is_array($rs))
		return $rs[0];
	else
		return 0;
}

function ObtenAlumno($cuenta,$nombre)
{
	global $oDb;
	$query = "select alumnoId from alumno where cuenta='$cuenta'";
	$oDb->query($query);
	$rs = $oDb->getRecord();
	if (is_array($rs))
		return $rs[0];
	else
	{
		$query = "insert into alumno set cuenta='$cuenta',nombre='$nombre'";
		$oDb->query($query);
		$id = $oDb->insertid();
		return $id;
	}
}