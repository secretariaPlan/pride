<?php

//El DALC de publicaciones
//Javier Alpizar, 21 Mar 08

include_once("phplib/DbFactory.inc.php");
include_once("lib/Autores.php");

class PublicacionDALC
{ 
	
	
	//los autores del proyecto.
	public static function ObtenAutores($publicacionId)
	{
		
		$oDb = DbFactory::ObtenDb();
		$query ="select id,funcionId,nivelId,procedencia,profesorId,particOtroNombre,particOtroApellidoP,
				particOtroApellidoM,particOtroInstit,estudNombre,estudApellidoP,estudApellidoM,
				particOtroNombramiento
				from publicacion_autores
				where publicacionId = $publicacionId order by id";
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
							"particOtroInstitucion"=>$rs["particOtroInstit"],
							"particOtroNombramiento"=>$rs["particOtroNombramiento"],
							"estudNombre"=>$rs["estudNombre"],
							"estudApellidoP"=>$rs["estudApellidoP"],
							"estudApellidoM"=>$rs["estudApellidoM"],
			
							 );
		}
		return $arr;
		
	} 
	
	//		Regresa un objeto autor con los nombre y su funcion en un proyecto
	
	//el valor de funcionId se refiere al tipo de funcion q desempena.Esta en la tabla invest_funcion_aux
    //cuyos primeros valores estan marcados ReadOnly pues no deben cambiar:
    //1 Resp, 2 Corresp, 3 Colaborador, 4 Estudiante
	public static function ObtenAutoresNombres($publicacionId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select particOtroNombre,particOtroApellidoP,particOtroApellidoM,
				 profesor.nombre as nombre,profesor.apaterno as apaterno, profesor.amaterno as amaterno,
				 invest_funcion_aux.id as funcionId 
				 from publicacion_autores 
				 left join profesor on publicacion_autores.profesorId = profesor.profesorId 
				 join invest_funcion_aux on publicacion_autores.funcionId = invest_funcion_aux.id 
				 where publicacion_autores.publicacionId=$publicacionId";
		$oDb->query($query);
		//echo $query;
		$autores = new Autores();
		
		
		while ($rs = $oDb->getRecord("C"))
		{
			if ($rs["nombre"] == NULL)
				$nombre = $rs["particOtroApellidoP"]. " " . $rs["particOtroApellidoM"]." ".$rs["particOtroNombre"];
			else
				$nombre = $rs["apaterno"]. " " . $rs["amaterno"]." ".$rs["nombre"];
			$autores->Agrega($rs["funcionId"],$nombre);
		}
		return $autores;
		
	}
	
	//Regresa un arreglo con los nombres unicamente autores del proyecto
	public static function ObtenAutoresPublicacion($publicacionId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select particOtroNombre,particOtroApellidoP,particOtroApellidoM,
				 profesor.nombre as nombre,profesor.apaterno as apaterno, profesor.amaterno as amaterno
				 from publicacion_autores 
				 left join profesor on publicacion_autores.profesorId = profesor.profesorId 
				 where publicacion_autores.publicacionId=$publicacionId";
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
		//$arr = array("javier alpi","liz alva");
		return $arr;
	}
	
	//Obtiene un arreglo con los campos que se deben usar para una tabla especifica
	//el arrelgo como tal ya esta inicizlizad, se pueden obtener las keys para el sql
	//o cambiar alguna dato como se necesite
	public static function obtenCampos($tabla)
	{
	
		$tablas = array();
		$tablas["pub_libro"] = array('nombre'=>"" ,
  			'isbn'=>"" ,  'year'=>date("Y") ,  'volumen'=>"" , 
  			'edicion'=>"" ,'reimpresion'=>"",  'editor'=>"" ,  'editorial'=>"" ,  'pais' =>"",  'ciudad'=>"" ,
  			'paginas'=>0 ,  'tiraje' =>0,"antologia"=>"No","prologo"=>"No","capitulos"=>1,"paisId"=>1,"paisOtro"=>"","ciudadId"=>1,"ciudadOtro"=>"");
		$tablas["pub_libro_capitulo"] = array("nombre"=>"",
			"alcance"=>"N","titulo"=>"","isbn"=>"","year"=>date("Y"),"volumen"=>"","coleccion"=>"",
			"edicion"=>"","editor"=>"","editorial"=>"","pais"=>"","ciudad"=>"","tiraje"=>0,
			"paginaInicio"=>0,"paginaFin"=>0);
		$tablas["pub_periodico"] = array("nombre"=>"",
			"alcance"=>"N","paginaInicio"=>0,"paginaFin"=>0,"numero"=>"","fecha"=>"","epoca"=>"","year"=>0);
		$tablas["pub_catalogo"] = array("nombre"=>"",
			"alcance"=>"N","issn"=>"","year"=>date("Y"),"volumen"=>"","editorial"=>"","pais"=>"",
			"ciudad"=>"","paginas"=>0,"tiraje"=>0,"numero"=>"");
		$tablas["pub_informe"] = array("nombre"=>"",
			"alcance"=>"N","year"=>date("Y"),"paginas"=>0,"instancia"=>"","descripcion"=>"");
		$tablas["pub_material"] = array("nombre"=>"",
			"alcance"=>"N","isbn"=>"","year"=>date("Y"),"volumen"=>"","coleccion"=>"","edicion"=>"",
			"editorial"=>"","paginas"=>0,"tiraje"=>0);
		$tablas["pub_prologo"] = array("nombre"=>"",
			"alcance"=>"N","formato"=>"R","isbn"=>"","year"=>date("Y"),"volumen"=>"","coleccion"=>"",
			"edicion"=>"","editorial"=>"","pais"=>"","ciudad"=>"","tiraje"=>0,
			"paginaInicio"=>0,"paginaFin"=>0);
		$tablas["pub_tecnico"] = array("nombre"=>"",
			"alcance"=>"N","isbn"=>"","year"=>date("Y"),"volumen"=>"","coleccion"=>"","edicion"=>"",
			"editorial"=>"","pais"=>"","ciudad"=>"","tiraje"=>0,"paginaInicio"=>0,"paginaFin"=>0);
		$tablas["pub_electronico"] = array("nombre"=>"",
			"alcance"=>"N","year"=>date("Y"),"volumen"=>"","url"=>"","numero"=>"");
		$tablas["pub_traduccion"] = array("nombre"=>"",
			"alcance"=>"N","isbn"=>"","year"=>date("Y"),"volumen"=>"","coleccion"=>"","edicion"=>"",
			"editor"=>"","editorial"=>"","pais"=>"","ciudad"=>"","paginas"=>"","tiraje"=>0,
			"paginaInicio"=>0,"paginaFin"=>0,"capitulos"=>"","cantTraducida"=>"T");
		$tablas["pub_articulo"] = array("nombre"=>"",
			"revista"=>"","alcance"=>"N","tipo"=>"I","arbitrada"=>"Si","formato"=>"I","volumen"=>"",'numero'=>"","paginaInicio"=>0,"paginaFin"=>0,"fecha"=>"","year"=>date("Y"));
		return $tablas[$tabla];
	}
	
	//Regresa el encabezado y el programa de mantenimiento que usa segun la el nombre del la talba
	public static function obtenReferencia($tabla)
	{
		$tablas = array();
		$tablas["pub_libro"] = array("destino"=>"pub_libroMant.php","titulo"=>"Libro");
		$tablas["pub_libro_capitulo"] = array("destino"=>"pub_libro_capituloMant.php","titulo"=>"Capítulo de libro");
		$tablas["pub_periodico"] = array("destino"=>"pub_periodicoMant.php","titulo"=>"Artículo en periódico");
		$tablas["pub_catalogo"] = array("destino"=>"pub_catalogoMant.php","titulo"=>"Catálogo");
		$tablas["pub_informe"] = array("destino"=>"pub_informeMant.php","titulo"=>"Informe");
		$tablas["pub_material"] = array("destino"=>"pub_materialMant.php","titulo"=>"Material de apoyo docente");
		$tablas["pub_prologo"] = array("destino"=>"pub_prologoMant.php","titulo"=>"Prólogo");
		$tablas["pub_tecnico"] = array("destino"=>"pub_tecnicoMant.php","titulo"=>"Artículo técnico");
		$tablas["pub_electronico"] = array("destino"=>"pub_electronicoMant.php","titulo"=>"Artículo electrónico");
		$tablas["pub_traduccion"] = array("destino"=>"pub_traduccionMant.php","titulo"=>"Traducción de libro");
		$tablas["pub_articulo"] = array("destino"=>"pub_articuloMant.php","titulo"=>"Artículo");
		return $tablas[$tabla];
	}
	
		
	
	
	
	//Obtiene los datos q se despliegan en la seccion de view (publicaciones.php)
	public static function ObtenDisplay($tabla,$profesorId,$yearInicio=NULL,$yearFin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id,publicacionId,nombre,alcance,year from ".$tabla." where profesorId = $profesorId";
		if ($yearInicio != NULL or $yearFin != NULL)
		{
			$fechas = " and year >= '$yearInicio' and year <= '$yearFin'";
			$query .= $fechas;
		}
		$query.= " order by  year desc";			
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = $rs;
		}
		//$arr[] = array("id"=>1,"publicacionId"=>1,"nombre"=>"Jav","alcance"=>"N","year"=>2004);
		return $arr;
	}
	
//Obtiene los datos q se despliegan en la seccion de view (publicaciones.php)
	public static function ObtenDisplayArticulo($tabla,$profesorId,$yearInicio=NULL,$yearFin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id,publicacionId,nombre,alcance,tipo,formato,revista,volumen,numero,paginaInicio,paginaFin,fecha from ".$tabla." where profesorId = $profesorId";
		if ($yearInicio != NULL or $yearFin != NULL)
		{
			$fechas = " and year >= '$yearInicio' and year <= '$yearFin'";
			$query .= $fechas;
		}
		$query.= " order by  year desc";			
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = $rs;
		}
		//$arr[] = array("id"=>1,"publicacionId"=>1,"nombre"=>"Jav","alcance"=>"N","year"=>2004);
		return $arr;
	}
	
//Obtiene los datos q se despliegan en la seccion de view (publicaciones.php)
	public static function ObtenDisplayLibro($tabla,$profesorId,$yearInicio=NULL,$yearFin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select id,publicacionId,pub_libro.nombre,alcance,year,antologia,prologo,isbn,year,volumen,edicion,reimpresion,paginas,tiraje,editorial,
		editor,pais_aux.nombre as pais,paisOtro,ciudad_aux.nombre as ciudad,ciudadOtro,pub_libro.paisId,pub_libro.ciudadId from ".$tabla." 
		left join pais_aux on pub_libro.paisId = pais_aux.paisId
		left join ciudad_aux on pub_libro.ciudadId = ciudad_aux.ciudadId
		where profesorId = $profesorId";
		if ($yearInicio != NULL or $yearFin != NULL)
		{
			$fechas = " and year >= '$yearInicio' and year <= '$yearFin'";
			$query .= $fechas;
		}
		$query.= " order by  year desc";			
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			//var_dump($rs);
			$arr[] = $rs;
		}
		//$arr[] = array("id"=>1,"publicacionId"=>1,"nombre"=>"Jav","alcance"=>"N","year"=>2004);
		return $arr;
	}
	
	//extrae los valores de una tabla y los coloca en el arreglo correspondiente
	//constuye una sentencia sql tipo select campo1,campo2 from tabla where condicion y la ejecuta
	//el valor de campo1,2.... se extrae del arreglo definido en obtenReferencia
	public static function ObtenValoresTabla($tabla,$publicacionId)
	{
		$arr = PublicacionDALC::obtenCampos($tabla); //
		$campos = array_keys($arr);
		$query ="select ";
		$coma = "";
		foreach($campos as $campo)
		{
			$query.= ($coma.$campo);
			$coma = ",";
		}
		$query.=" from ".$tabla." where publicacionId = ".$publicacionId;
		//echo "func valores tabla:".$query;
		$oDb = DbFactory::ObtenDb();
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;  //el arreglo q regresa trae la misma estructura q el q se trajo de otenReferencia pero ya con valores
	}
	
}
?>