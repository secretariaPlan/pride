<?php
//Un temporal para traerse rapido los datos de DGAPA que incluye apoyos y reconocimientos
//Javier Alpizar, 26 Sep 08

set_time_limit(0);

//estos son apoyos
define("INUMEMP",1);
define("PAIPA",12);
define("PRIDE",13);
define("PEPASIG",16);
define("PAPIIT",19);
define("PASPA",21);
define("PASD",25);
define("PAPIME",28);
define("PASD2",33);

//estos son reconocimientos
define("PERPAE",23);
define("PUN_RDUNJA",27);


define("APOYO",0);
define("POS",1);
define("TABLA",2);
define("CAMPO",3);



include_once("../phplib/DbFactory.inc.php");
$oDb = DbFactory::ObtenDb();

$handle = fopen("dgapa.csv","r");
$ok=0;
$mal=0;
$cont=0;

$apoyos = array( array("PAIPA",12,"apoyo_unm_paipa","nivel"),array("PRIDE",13,"apoyo_unm_pride","nivel"),array("PEPASIG",16,"apoyo_unm_pepasig","nivel"),
				 array("PAPIIT",19,"apoyo_unm_papiit","nivel"),array("PASPA",21,"apoyo_unm_paspa","nivel"),
				 array("PERPAE",23,"apoyo_unm_perpae","nombre"),				 
				 array("PASD",25,"apoyo_unm_pasd","nivel"),
				 array("PUN_RDUNJA",27,"apoyo_unm_pun_rdu","nombre"),
				 array("PAPIME",28,"apoyo_unm_papime","nombre"),array("PASD2",33,"apoyo_unm_pasd","nivel"));

foreach($apoyos as $apoyo)
{
   $query  = "truncate table ".$apoyo[TABLA];
   $oDb->query($query);
}
$data  = fgetcsv($handle); $data  = fgetcsv($handle);
while ( ($data  = fgetcsv($handle)) !== FALSE)
{
	print_r($data);
	echo "///////////////////////";
	$numTrabajador = $data[INUMEMP];
	$query = "select profesorId from profesor where numTrabajador = $numTrabajador";
	echo $query;
	$oDb->query($query);
	$rs = $oDb->getRecord();
	$profesorId = $rs["0"];
	if (is_array($rs))
	{
		foreach($apoyos as $apoyo)
		{
			if ($data[$apoyo[POS]] != "")
			{
				$query = "insert into ".$apoyo[TABLA]." set profesorId = ".$profesorId.",".$apoyo[CAMPO]."='".$data[$apoyo[POS]]."'";
				echo $query."<br>";
				$oDb->query($query);
			}
		}
		//los premios
		//if ($data[PUN_RDUNJA] != "")
		//{
		
		
				
	}
	else
	{
		$mal++;
		echo  $numTrabajador."<br>";
	}
	$cont++;
}
echo "total $cont ,  ok $ok , mal $mal";
//puded traer yyyymmdd o dd/mm/yyyy, debe regresar yyyy-mm-dd
function obtenFecha($fecha)
{
	$pos = strpos($fecha,"/");
	if ($pos === false)
	{
		//trae formato yyyymmdd
		return substr($fecha,0,4)."-".substr($fecha,4,2)."-".substr($fecha,6,2);
	}
	else
	{
		//formato yyyy-mm-dd
		
			return substr($fecha,6,4)."-".substr($fecha,3,2)."-".substr($fecha,0,2);
	}
}
?>
