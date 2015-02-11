<?php
//para valida un acceso al sistema
//Javier Alpizar, 15 Feb 07


session_start();
$browser = $_SERVER["HTTP_USER_AGENT"];
$ip = $_SERVER["REMOTE_ADDR"]; 


include_once("lib/Login.php");


if (!isset($_REQUEST["usuario"]) or !isset($_REQUEST["pwd"]))
	header('Location:login.php?error=0');

//
//echo $_REQUEST["usuario"];
//echo $_REQUEST["pwd"];
//
$tipo="n";  //normal
if (isset($_REQUEST["tipo"]))
	$tipo = substr(filter_var($_REQUEST["tipo"],FILTER_SANITIZE_STRING),0,1);
 
$login = new Login();
if ($login->LogOk($_REQUEST["usuario"],$_REQUEST["pwd"],$tipo))
{
	if ($tipo == "n")  //solo graba el acceso si es tipo normal, la otra opc es tipo m acceso con pwd maestro
		LoginDALC::GrabaAcceso($_REQUEST["usuario"],$ip,1,$browser);
	
	header('Location:welcome.php');
}
else
{
	LoginDALC::GrabaAcceso($_REQUEST["usuario"],$ip,0,$browser);
	header('Location:login.php?error=0');
}

?>