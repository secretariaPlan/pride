<?php
//Un temporal para traerse rapido los datos de trabajos de titulacion
//Javier Alpizar, 30 May 08
//Este es el sql q se trae del sybase cae:
/*
 * select RFC_ASE,RFC_SUP,RFC_PRE,RFC_VOC,RFC_SEC,RFC_SUPL1,RFC_SUPL2,OPCION,TEMA,FECHA_EXA,saae_fq.dbo.TESIS_CUENTAS.CUENTA,saae_fq.dbo.ESTUDIA.NOMBRE,saae_fq.ESTUDIA.CARRERA from saae_fq.dbo.TESIS 
left join saae_fq.dbo.TESIS_CUENTAS on saae_fq.dbo.TESIS.NUMERO_UNICO = saae_fq.dbo.TESIS_CUENTAS.NUMERO_UNICO
left join saae_fq.dbo.ESTUDIA on saae_fq.dbo.TESIS_CUENTAS.CUENTA = saae_fq.dbo.ESTUDIA.CUENTA
 */

set_time_limit(0);

define("ALUMNO_CUENTA",10);
define("ASESOR",0);
define("SUPERVISOR",1); //
define("PDTE",2);
define("VOCAL",3);   //
define("SECRETARIO",4);
define("SUP1",5); //
define("SUP2",6); //
define("OPCION",7);
define("NOMBRE",8);   //del trabajo presentado
define("FECHA",9);   
define("ALUMNO_NOMBRE",11); 
define("ALUMNO_CARRERA",12);

$carreras = array("21"=>1,"22"=>2,"23"=>3,"24"=>5,"26"=>5,"27"=>5,"28"=>4);

include_once("../phplib/DbFactory.inc.php");
$oDb = DbFactory::ObtenDb();

$handle = fopen("trab_tit080727.csv","r");
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
	$alumnoId = ObtenAlumno($data[ALUMNO_CUENTA],$data[ALUMNO_NOMBRE],$data[ALUMNO_CARRERA]);
	///asesor
	$profesorId = ObtenProfesorId($data[ASESOR]);
	$fecha="";
	if (strlen($data[FECHA]) > 0)
		$fecha = ",fecha='".substr($data[FECHA],0,10)."'";
	if ($profesorId > 0)
	{
		
		$query = "insert into titulacion set profesorId = $profesorId,alumnoId=$alumnoId,funcionId=11,nivelId=1,
				opcionAuxId=".$data[OPCION].",nombre='".$data[NOMBRE]."'".$fecha;
		$r = $oDb->query($query);
		if ($r==0)
			echo $query."<br>";
	}
	$profesorId = ObtenProfesorId($data[SUPERVISOR]);
	if ($profesorId > 0)
	{
		
		$query = "insert into titulacion set profesorId = $profesorId,alumnoId=$alumnoId,funcionId=12,nivelId=1,
				opcionAuxId=".$data[OPCION].",nombre='".$data[NOMBRE]."'".$fecha;
		$r = $oDb->query($query);
		if ($r==0)
			echo $query."<br>";
	}
	//solo les interesa asesor y supervisor
	/*
	$profesorId = ObtenProfesorId($data[PDTE]);
	if ($profesorId > 0)
	{
		
		$query = "insert into titulacion set profesorId = $profesorId,alumnoId=$alumnoId,funcionId=1,nivelId=1,
				opcionAuxId=".$data[OPCION].",nombre='".$data[NOMBRE]."'".$fecha;
		$r = $oDb->query($query);
		if ($r==0)
			echo $query."<br>";
	}
	$profesorId = ObtenProfesorId($data[SECRETARIO]);
	if ($profesorId > 0)
	{
		
		$query = "insert into titulacion set profesorId = $profesorId,alumnoId=$alumnoId,funcionId=3,nivelId=1,
				opcionAuxId=".$data[OPCION].",nombre='".$data[NOMBRE]."'".$fecha;
		$r = $oDb->query($query);
		if ($r==0)
			echo $query."<br>";
	}
	$profesorId = ObtenProfesorId($data[VOCAL]);
	if ($profesorId > 0)
	{
		
		$query = "insert into titulacion set profesorId = $profesorId,alumnoId=$alumnoId,funcionId=7,nivelId=1,
				opcionAuxId=".$data[OPCION].",nombre='".$data[NOMBRE]."'".$fecha;
		$r = $oDb->query($query);
		if ($r==0)
			echo $query."<br>";
	}
	$profesorId = ObtenProfesorId($data[SUP1]);
	if ($profesorId > 0)
	{
		
		$query = "insert into titulacion set profesorId = $profesorId,alumnoId=$alumnoId,funcionId=9,nivelId=1,
				opcionAuxId=".$data[OPCION].",nombre='".$data[NOMBRE]."'".$fecha;
		$r = $oDb->query($query);
		if ($r==0)
			echo $query."<br>";
	}
	$profesorId = ObtenProfesorId($data[SUP2]);
	if ($profesorId > 0)
	{
		
		$query = "insert into titulacion set profesorId = $profesorId,alumnoId=$alumnoId,funcionId=10,nivelId=1,
				opcionAuxId=".$data[OPCION].",nombre='".$data[NOMBRE]."'".$fecha;
		$r = $oDb->query($query);
		if ($r==0)
			echo $query."<br>";
	}
	*/
	
}

//trae un rfc y un titulo academico separados por un espacio
function ObtenProfesorId($rfc)
{
	global $oDb;
	$arfc = explode(" ",$rfc);
	$largo = strlen($arfc[0]);
	//$query = "select profesorId from profesor where substring(rfc,1,$largo) = '".$arfc[0]."'";
	$query = "select profesorId from profesor where substring(rfc,1,10) = '".$arfc[0]."'";
	$oDb->query($query);
	$rs = $oDb->getRecord();
	echo $query."<br>";
	if (is_array($rs))
		return $rs[0];
	else
		return 0;
}

function ObtenAlumno($cuenta,$nombre,$carreraClave)
{
	global $oDb,$carreras;
	$query = "select alumnoId from alumno where cuenta='$cuenta'";
	$oDb->query($query);
	$rs = $oDb->getRecord();
	if (is_array($rs))
		return $rs[0];
	else
	{
		$carreraId = 0;
		if (array_key_exists($carreraClave,$carreras))
			$carreraId = $carreras[$carreraClave] ;
			$query = "insert into alumno set cuenta='$cuenta',nombre='$nombre',carreraId=$carreraId";
		$oDb->query($query);
		$id = $oDb->insertid();
		return $id;
	}
}