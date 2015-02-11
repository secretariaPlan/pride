<?php

//El DALC de productos de investigacion
//Javier Alpizar, 18 Mar 08

include_once("phplib/DbFactory.inc.php");
include_once("lib/Autores.php");

class InvestigacionProductoDALC
{ 
	
	
	//los autores del proyecto.
	public static function ObtenAutores($invProdId)
	{
		
		$oDb = DbFactory::ObtenDb();
		$query ="select id,funcionId,nivelId,procedencia,profesorId,particOtroNombre,particOtroApellidoP,
				particOtroApellidoM,tipo,particOtroInstitucion,particOtroNombramiento 
				from invest_prod_autores
				where invProdId = $invProdId order by id";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("id"=>$rs["id"],
							"funcionId"=>$rs["funcionId"],
							"nivelId"=>$rs["nivelId"],
							"procedencia"=>$rs["procedencia"],
							"profesorId"=>$rs["profesorId"],
							"particOtroNombre"=>$rs["particOtroNombre"],
							"particOtroApellidoP"=>$rs["particOtroApellidoP"],
							"particOtroApellidoM"=>$rs["particOtroApellidoM"],
							"particOtroInstitucion"=>$rs["particOtroInstitucion"],
							"particOtroNombramiento"=>$rs["particOtroNombramiento"],
							"tipo"=>$rs["tipo"]
							 );
		}
			
		return $arr;
		
	} 
	
	//		Regresa un objeto autor con los nombre y su funcion en un proyecto
	
	//el valor de funcionId se refiere al tipo de funcion q desempena.Esta en la tabla invest_funcion_aux
    //cuyos primeros valores estan marcados ReadOnly pues no deben cambiar:
    //1 Resp, 2 Corresp, 3 Colaborador, 4 Estudiante
	public static function ObtenAutoresNombres($invProdId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select particOtroNombre,particOtroApellidoP,particOtroApellidoM,
				 profesor.nombre as nombre,profesor.apaterno as apaterno, profesor.amaterno as amaterno,
				 tipo,invest_funcion_aux.id as funcionId 
				 from invest_prod_autores 
				 left join profesor on invest_prod_autores.profesorId = profesor.profesorId 
				 join invest_funcion_aux on invest_prod_autores.funcionId = invest_funcion_aux.id 
				 where invest_prod_autores.invProdId=$invProdId";
		$oDb->query($query);
		//echo $query;
		$autores = new Autores();
		
		
		while ($rs = $oDb->getRecord("C"))
		{
			if ($rs["nombre"] == NULL)
				$nombre = $rs["particOtroApellidoP"]. " " . $rs["particOtroApellidoM"]." ".$rs["particOtroNombre"];
			else
				$nombre = $rs["apaterno"]. " " . $rs["amaterno"]." ".$rs["nombre"];
			$autores->Agrega($rs["tipo"],$nombre);
		}
		return $autores;
		
	}
	
	//Regresa un arreglo con los nombres unicamente autores del proyecto
	public static function ObtenAutoresProducto($invProdId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select particOtroNombre,particOtroApellidoP,particOtroApellidoM,
				 profesor.nombre as nombre,profesor.apaterno as apaterno, profesor.amaterno as amaterno
				 from invest_prod_autores 
				 left join profesor on invest_prod_autores.profesorId = profesor.profesorId 
				 where invest_prod_autores.invProdId=$invProdId";
		$oDb->query($query);
		//echo $query;
		$arr = array();
		
		
		while ($rs = $oDb->getRecord("C"))
		{
			if ($rs["nombre"] == NULL)
				$nombre = $rs["particOtroApellidoP"]. " " . $rs["particOtroApellidoM"]." ".$rs["particOtroNombre"];
			else
				$nombre = $rs["apaterno"]. " " . $rs["amaterno"]." ".$rs["nombre"];
			$arr[] = $nombre;
		}
		//$arr[] = "jav alpi mor"; $arr[] = "liz alva";
		return $arr;
	}
}
?>