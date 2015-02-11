<?php
//El DALC de catalogos
//Javier Alpizar, 25 Abr 08
include_once("phplib/DbFactory.inc.php");

class CatalogoDALC
{
	
	//Obtiene un listado de todos los aviso limitando el numero de acuerdo al paginador
	//regrsa un arreglo 
	public static function ObtenCatalogos()
	{
		$oDb = DbFactory::ObtenDb();
		
		$query = "SELECT catalogoId,nombre,descripcion from a_catalogo order by nombre";
				
		$oDb->query($query);
		$arr= array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = $rs;
		}
		return $arr;
		
	}
	
	//Los datos de un catalogo seleccionado
	public function ObtenCatalogo($catalogoId)
	{
		$oDb = DbFactory::ObtenDb();
		
		$query = "SELECT catalogoId,nombre,descripcion,tablaNombre,colId,colNombre,colLongitud,colLongitudMuestra,scriptModificar,condicion,relacion_tabla,relacion_campo from a_catalogo where catalogoId = $catalogoId";
		//echo $query;		
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		//var_dump($rs);
		return $rs;
	}
	
	//Los registros de un catalogo
	//Condicion sirve para agregar campos adicionales a los normales tanto para buscar como para guardar
	//relacion_tabla y relacion campo es para q se agreguen otras tablas de cuales dependen los registros
	public function ObtenRegistros($tabla,$colId,$colNombre,$condicion="",$relacion_tabla="",$relacion_campo="")
	{
		$oDb = DbFactory::ObtenDb();
		
		$query = "select $tabla.$colId,$tabla.$colNombre from $tabla";
		//echo $query;
		if ($relacion_tabla != "" and $relacion_campo != "")
		{
			$query.= " join ".$relacion_tabla." on ".$tabla.".".$colId." = ".$relacion_tabla.".".$relacion_campo;
		}
		if ($condicion != "")
			$query.= " where $condicion";
		$query .= "  order by $colNombre";
		//echo $query;
		$arr = array();
		$oDb->query($query);
		while ($rs = $oDb->getRecord())
		{
			$arr[] = array("id"=>$rs[0],"nombre"=>$rs[1]);
		}
		return $arr;
	}
		
		
	
}
?>