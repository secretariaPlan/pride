<?php
//Para automatizar la creacion de algunos controles html
//Javier Alpizar, 1 Mar 08

//Para crear tags option
//$elemntos es un arreglo de clases que implementa IAuxiliar por lo tanto dispone de dos metodos IdGet y NombreGet
//valor es el valor q debe dejar como seleccionado
//regresa una cadena con los option creados
function HtmlOption($elementos ,$valor)
{
	$s = "";
	foreach($elementos as $elemento)
	{
		$sel = "";
		if ($elemento->IdGet() == $valor)
			$sel = "selected";
		$s.= "<option value=".$elemento->IdGet()." ".$sel.">".$elemento->NombreGet()."</option>";
	}
	return $s;
}

//$elementos es un arreglo asociativo { "id"=>valor, ... }
function HtmlOptionArr($elementos ,$match)
{
	$s = "";
	foreach($elementos as $id=>$texto)
	{
		$sel = "";
		if ($id == $match)
			$sel = "selected";
		$s.= "<option value=".$id." ".$sel.">".$texto."</option>";
	}
	return $s;
}

//$elementos es un arreglo simple { valor, valor... }
function HtmlOptionArrSimple($elementos ,$match)
{
	$s = "";
	foreach($elementos as $texto)
	{
		$sel = "";
		if ($texto == $match)
			$sel = "selected";
		$s.= "<option value='".$texto."' ".$sel.">".$texto."</option>";
	}
	return $s;
}

//crea un checkbox, con nombre, valor y checked si $checked es true
function HtmlCheckBox($nombre,$valor,$bandera,$texto)
{
	$checked = "";
	if ($bandera == true)
		$checked = "checked";
	return "<input type='checkbox' name='".$nombre."' value='".$valor."' ".$checked.">".$texto;
	
}

?>