<?php
//El DALC para los idiomas que maneja el profesor

include_once("phplib/DbFactory.inc.php");
include_once("ProfesorIdioma.php");


Class ProfesorIdiomaDALC
{
	
	public static function ObtenIdiomas($profesorId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select profesorIdiomaId,profesor_idioma.idiomaId as idiomaId,idioma_aux.nombre as idioma,
					idiomaOtro,habla,escribe,traduce 
					from profesor_idioma 
					left join idioma_aux on profesor_idioma.idiomaId = idioma_aux.idiomaId
					where profesorId=$profesorId order by profesor_idioma.idiomaId";
		
		$idiomas = array();
		$oDb->query($query);
		//echo $query;
		while ($rs = $oDb->getRecord("C"))
		{		
			$idioma = new ProfesorIdioma();
		
			$idioma->ProfesorIdiomaId=$rs["profesorIdiomaId"];
			//el resultado de la busqueda sql con respecto al join es que idioma.nombre (idioma) regresa null
			//cuando no fue encontrado, señl q indica q se uso idiomaOtro
			$idioma->Nombre=($rs["idioma"] == null) ? $rs["idiomaOtro"] : $rs["idioma"];  
			//
			$idioma->Habla=$rs["habla"];
			$idioma->Traduce=$rs["traduce"];
			$idioma->Escribe=$rs["escribe"];
			$idiomas[] = $idioma;
		}
		return $idiomas;
		/*
		$i = new ProfesorIdioma();
		$i->Nombre="Aleman";$i->Habla="10";$i->Escribe="14";$i->Traduce="10";
		$idiomas[] = $i;
		$i = new ProfesorIdioma();
		$i->Nombre="Chino";$i->Habla="1";$i->Escribe="2";$i->Traduce="3";
		$idiomas[] = $i;
		return $idiomas;
		*/
		
		
	}
	
	public static function ObtenIdioma($profesorIdiomaId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select profesorIdiomaId,profesor_idioma.idiomaId as idiomaId,
					idiomaOtro,habla,escribe,traduce 
					from profesor_idioma 
					left join idioma_aux on profesor_idioma.idiomaId = idioma_aux.idiomaId
					where profesorIdiomaId=$profesorIdiomaId";
		
		
		$oDb->query($query);
		//echo $query;
		$rs = $oDb->getRecord("C");
		$idioma = new ProfesorIdioma();
		$idioma->ProfesorIdiomaId=$rs["profesorIdiomaId"];
		//el resultado de la busqueda sql con respecto al join es que idioma.nombre (idioma) regresa null
		//cuando no fue encontrado, señl q indica q se uso idiomaOtro
		//$idioma->Nombre=($rs["idioma"] == null) ? $rs["idiomaOtro"] : $rs["idioma"];  
		//
		$idioma->Habla=$rs["habla"];
		$idioma->Traduce=$rs["traduce"];
		$idioma->Escribe=$rs["escribe"];
		$idioma->IdiomaId=$rs["idiomaId"];
		$idioma->IdiomaOtro=$rs["idiomaOtro"];
		
		return $idioma;
		
	}
		
	
}



?>