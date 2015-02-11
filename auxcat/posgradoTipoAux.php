<?php

//El catalogo auxliar de niveles posgrado
//Asi es como se debe implementar un catalogo auxiliar, se incluye la interface, la clase para db, el objeto q almacena cada reg
//y su DALC

include_once("IAuxiliar.php");
include_once("phplib/DbFactory.inc.php");


class PosgradoNivel implements IAuxiliarP
{
	public $Id, $Nombre;
	
	public function __construct($id,$nombre)
	{
		$this->Id = $id;
		$this->Nombre = $nombre;
	}
	
	public function IdGet()
	{
		return $this->Id;
	}
	
	public function NombreGet()
	{
		return $this->Nombre;
	}
	
	
}


	 function PosgradoNivelObtener()
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id, nombre from curso_posgrado_tipo order by nombre";
		$oDb->query($query);
		$arr = array();
		while($rs = $oDb->getRecord("C"))
		{
			$arr[] = new PosgradoPrograma($rs["id"],$rs["nombre"]);
		}
		return $arr;
	}
	
	
	


?>