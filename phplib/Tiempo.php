<?php
//Algunas funciones de tiempo

//reccibe una cantidad de minutos y regresa en formato de horas 300 => 5:00, 345 => 5:45
function AHoras($tiempo)
{
	$minutos = $tiempo%60;
	$mins = str_pad($minutos,2,"0",STR_PAD_LEFT);
	$horas = ($tiempo - $minutos) / 60;
	return $horas.":".$mins;
}
?>