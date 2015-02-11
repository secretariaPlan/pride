<?php
//El DALC para la formacion academica del profesor

include_once("phplib/DbFactory.inc.php");
include_once("ProfesorFormacionAcademica.php");


Class ProfesorFormacionAcademicaDALC
{
	
	public static function Agrega($fAcad,$profesorId)
	{
		$oDb = DbFactory::ObtenDb();
		$tituloFecha="";
		if ($fAcad->tituloFecha != "")
			$tituloFecha = ",tituloFecha='$fAcad->tituloFecha'";
		$inicio = "";
		if ($fAcad->inicio != "")
			$inicio = ",inicio='".$fAcad->inicio."'";
		$fin="";
		if ($fAcad->fin != "")
			$fin = ",fin='".$fAcad->fin."'";
		$query = "insert into formacion_academica set profesorId=$profesorId,nivelId=$fAcad->nivelId,nivelOtro='$fAcad->nivelOtro',carreraId=$fAcad->carreraId,
					carreraOtro='$fAcad->carreraOtro',institucionId=$fAcad->institucionId,
					institucionOtro='$fAcad->institucionOtro',facultadId=$fAcad->facultadId,facultadOtro='$fAcad->facultadOtro',
					ciudadId=$fAcad->ciudadId,ciudadOtro='$fAcad->ciudadOtro',
					paisId=$fAcad->paisId,paisOtro='$fAcad->paisOtro',
					titulado=$fAcad->titulado,tesis='$fAcad->tesis'".$inicio.$fin.$tituloFecha;
		//echo $query;
		$r = $oDb->executeNonQuery($query);
		return $r;		  
	}
	
	public static function Modifica($fAcad,$formacionId)
	{
		$oDb = DbFactory::ObtenDb();
		if($fAcad->tituloFecha == "")
			$tituloFecha=",tituloFecha=NULL";
		else
			$tituloFecha=",tituloFecha='".$fAcad->tituloFecha."'";
		$inicio = "";
		if ($fAcad->inicio != "")
			$inicio = ",inicio='".$fAcad->inicio."'";
		$fin="";
		if ($fAcad->fin != "")
			$fin = ",fin='".$fAcad->fin."'";	
		$query = "update formacion_academica set nivelId=$fAcad->nivelId,nivelOtro='$fAcad->nivelOtro',carreraId=$fAcad->carreraId,
					carreraOtro='$fAcad->carreraOtro',institucionId=$fAcad->institucionId,
					institucionOtro='$fAcad->institucionOtro',facultadId=$fAcad->facultadId,facultadOtro='$fAcad->facultadOtro',
					ciudadId=$fAcad->ciudadId,ciudadOtro='$fAcad->ciudadOtro',
					paisId=$fAcad->paisId,paisOtro='$fAcad->paisOtro',
					titulado=$fAcad->titulado,tesis='$fAcad->tesis'".$inicio.$fin.$tituloFecha." where formacionId = $formacionId";
				  
		//echo $query;
		$r = $oDb->executeNonQuery($query);
		return $r;		  
	}
	
	public static function Borra($formacionId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "delete from formacion_academica where formacionId = $formacionId";
				  
		//echo $query;
		$r = $oDb->executeNonQuery($query);
		return $r;	
	}
	
	//Obtiene un registro especifico de formacion academica
	public static function ObtenFormacionAcademica($formacionId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select formacion_academica.formacionId as formacionId,nivelId,nivelOtro,
					carreraId,carreraOtro,inicio,fin,facultadId,facultadOtro,paisId,paisOtro,
					institucionOtro,institucionId,ciudadOtro,ciudadId,tituloFecha,tesis,titulado from
					formacion_academica 
					where formacionId=$formacionId";
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		$fAcad = new FormacionAcademica();
		$fAcad->carreraId=$rs["carreraId"];
		$fAcad->carreraOtro=$rs["carreraOtro"];
		$fAcad->ciudadId=$rs["ciudadId"];
		$fAcad->ciudadOtro=$rs["ciudadOtro"];
		$fAcad->facultadId=$rs["facultadId"];
		$fAcad->facultadOtro=$rs["facultadOtro"];
		$fAcad->fin=$rs["fin"];
		$fAcad->formacionId=$rs["formacionId"];
		$fAcad->inicio=$rs["inicio"];
		$fAcad->institucionId=$rs["institucionId"];
		$fAcad->institucionOtro=$rs["institucionOtro"];
		$fAcad->nivelId=$rs["nivelId"];
		$fAcad->nivelOtro=$rs["nivelOtro"];
		$fAcad->paisId=$rs["paisId"];
		$fAcad->paisOtro=$rs["paisOtro"];
		$fAcad->tesis=$rs["tesis"];
		$fAcad->titulado=$rs["titulado"];
		$fAcad->tituloFecha=$rs["tituloFecha"];
		return $fAcad;
		
	}
	
	//Regresa para un profesor, un arr de objetos con los niveles que ha obtenido (maestria, doctorado) y dentro de cada
	//nivel otro arreglo con objetos de las carreras que curso en dicho nivel
	//van ordenados del menor al mayor
	public static function ObtenNivelesAcademicos($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select formacion_academica.formacionId as formacionId,nivel_aux.Nombre as nivel,nivelOtro,
					carrera_aux.Nombre as carrera,carreraOtro,inicio,fin,formacion_academica.nivelId as nivelId,tituloFecha,
					institucionOtro,institucion_aux.nombre as institucion,ciudadOtro,ciudad_aux.nombre as ciudad,
					pais_aux.nombre as pais,paisOtro from
					formacion_academica 
					left join nivel_aux on formacion_academica.nivelId = nivel_aux.nivelAuxId
					left join carrera_aux on formacion_academica.carreraId = carrera_aux.carreraId
					left join institucion_aux on formacion_academica.institucionId = institucion_aux.institucionId
					left join ciudad_aux on formacion_academica.ciudadId = ciudad_aux.ciudadId 
					left join pais_aux on formacion_academica.paisId = pais_aux.paisId 
					where profesorId=$profesorId ";
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and ( 
					(inicio <= '$inicio' and (fin >= '$fin' or tituloFecha >= '$fin')) or
					( (fin <= '$fin'  or tituloFecha <= '$fin') 
					and inicio <= '$inicio' and (fin >= '$inicio'  or tituloFecha >= '$inicio')) or
					(inicio >= '$inicio' and (fin >= '$fin'  or tituloFecha >= '$fin') 
					and (inicio <= '$fin' ) ) or
					(inicio >= '$inicio' and (fin <= '$fin'  or tituloFecha <= '$fin') ) or
					(inicio >= '$inicio' and (inicio <= '$fin'))
					)";
			//el primero es para fechas q empezaron antes y terminan despues del rango
			//el segundo es para fechas q iniciaron antes del rango y terminan en el  rango
			//el tercero es para fechas q incian en el rango y terminan despues
			//el cuarto es para fechas dentro del rango
			//el quinto es para eventos que tiene fecha de inicio dentro del rango y no han acabado
			$query .= $fechas;
		}
		$query.= " order by formacion_academica.nivelId";
		//echo $query;
		$arr = array();
		$oDb->query($query);
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("carrera" => ($rs["carrera"] == "") ? $rs["carreraOtro"] : $rs["carrera"],
			"fin"  => ($rs["tituloFecha"] == NULL) ? $rs["fin"] : $rs["tituloFecha"],
			"formacionId"  => $rs["formacionId"],
			"inicio" => $rs["inicio"],
			"institucion" => ($rs["institucion"] == NULL) ? $rs["institucionOtro"] : $rs["institucion"],
			"ciudad" => ($rs["ciudad"] == NULL) ? $rs["ciudadOtro"] : $rs["ciudad"],
			"pais" => ($rs["pais"] == NULL) ? $rs["paisOtro"] : $rs["pais"],
			"nivel" => ($rs["nivel"] == NULL) ? $rs["nivelOtro"] : $rs["nivel"],
			"nivelId" => $rs["nivelId"]
			);
		}
		//pidieron q se ordenara por fecha:
		usort($arr,"datecmp");
		return $arr;
		//return array(array("carrera"=>"Fisica","fin"=>"2008-01-01","formacionId"=>"1","inicio"=>"2008-01-01",
		//			"institucion"=>"UNAM","ciudad"=>"Mexico","nivel"=>"Licenciatura"),
		//			array("carrera"=>"Fisica","fin"=>"2008-01-01","formacionId"=>"1","inicio"=>"2008-01-01",
		//			"institucion"=>"UNAM","ciudad"=>"Mexico","nivel"=>"Posgrado"));
				
		
	}
}

function datecmp($a,$b)
  {
	return (strtotime($a["fin"]) < strtotime($b["fin"]))?1:-1;
  }

?>