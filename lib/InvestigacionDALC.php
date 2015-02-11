<?php
//El DALC para materiales docentes
//Javier Alpizar, 12 Mar 08

include_once("phplib/DbFactory.inc.php");

class InvestigacionDALC
{ 
	//Obtiene los proyectos de inv 
	public static function ObtenProyectosDeInvestigacion($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		//este 	query esta bien y se trae todos los datos auxiliares
		/*
		$query = "select invProyId,
				 titulo,clave,financiamientoInicio,financiamientoFin,financiamientoOtro,inicio,fin,concluido,
				 depto_aux.nombre as departamento,
				 investigacion_linea.nombre as area,
				 ciencia_aux.nombre as ciencia,
				 invest_tipo_aux.nombre as tipo,
				 invest_prods_aux.nombre as producto,productoOtro,
				 invest_funcion_aux.nombre as funcion
				 from investigacion_proyecto
				 left join depto_aux on investigacion_proyecto.departamentoId = depto_aux.deptoAuxid
				 left join investigacion_linea on investigacion_proyecto.areaId = investigacion_linea.invLineaId
				 left join ciencia_aux on investigacion_proyecto.cienciaId = ciencia_aux.id
				 left join invest_tipo_aux on investigacion_proyecto.tipoId = invest_tipo_aux.id
				 left join invest_prods_aux on investigacion_proyecto.productoId = invest_prods_aux.id
				 left join invest_funcion_aux on investigacion_proyecto.funcionId = invest_funcion_aux.id
				  where profesorId = $profesorId order by titulo";
		*/
		$query = "select invProyId,
				 titulo,inicio,fin,concluido,funcionId,
				 investigacion_linea.nombre as area
				 from investigacion_proyecto
				 left join investigacion_linea on investigacion_proyecto.areaId = investigacion_linea.invLineaId
				 where profesorId = $profesorId ";
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and ( 
					(inicio <= '$inicio' and fin >= '$fin') or
					(fin <= '$fin' and inicio <= '$inicio' and fin >= '$inicio') or
					(inicio >= '$inicio' and fin >= '$fin' and inicio <= '$fin' ) or
					(inicio >= '$inicio' and fin <= '$fin') or
					(inicio >= '$inicio' and inicio <= '$fin')
					)";
			//el primero es para fechas q empezaron antes y terminan despues del rango
			//el segundo es para fechas q iniciaron antes del rango y terminan en el  rango
			//el tercero es para fechas q incian en el rango y terminan despues
			//el cuarto es para fechas dentro del rango
			//el quinto es para eventos que tiene fecha de inicio dentro del rango y no han acabado
			$query .= $fechas;
		}
		$query.= " order by inicio desc";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("invProyId"=>$rs["invProyId"],
							"titulo"=>$rs["titulo"],
							"funcionId"=>$rs["funcionId"],
							"concluido"=>$rs["concluido"],
							"area"=>$rs["area"],
							"inicio"=>$rs["inicio"],
							"fin"=>$rs["fin"] 
							 );
		}
		/*$arr[] = array("invProyId"=>1,
							"titulo"=>"Inv 1",
							"funcionId"=>"Jefe",
							"concluido"=>"No",
							"inicio"=>"2008-08-08",
							"fin"=>"" 
							 );*/
		return $arr;
	}
	
	public static function ObtenProyectoDeInvestigacion($invProyId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select invProyId,titulo,clave,financiamientoInicio,financiamientoFin,
				financiamientoOtro,departamentoId, areaId, cienciaId,tipoId,
				productoId,productoOtro,funcionId,
				concluido,inicio,fin 
				 from investigacion_proyecto
				 where invProyId = $invProyId ";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
	
	
	//los participantes del proyecto.
	public static function ObtenParticipantes($invProyId)
	{
		
		$oDb = DbFactory::ObtenDb();
		$query ="select id,funcionId,nivelId,procedencia,profesorId,particOtroNombre,particOtroApellidoP,
				particOtroApellidoM,particOtroInstitucion,particOtroNombramiento
				from invest_participantes 
				where invProyId = $invProyId order by id";
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
							"particOtroNombramiento"=>$rs["particOtroNombramiento"]
							 );
		}
		
		return $arr;
		
	} 
	
	
	
	//Regresa un objeto participantes con los nombre y su funcion en un proyecto
	//nombreowner es el nombre del prof q capturo el registro
	//y sun funcion es la q declaro tener en el proyecto. Por la definicion de requerimientos
	//no se le integro dentro de la base de participantes.
	//el valor de funcionId se refiere al tipo de funcion q desempena.Esta en la tabla invest_funcion_aux
    //cuyos primeros valores estan marcados ReadOnly pues no deben cambiar:
    //1 Resp, 2 Corresp, 3 Colaborador, 4 Estudiante
	public static function ObtenParticipantesNombres($invProyId,$nombreOwner,$funcionIdOwner)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select particOtroNombre,particOtroApellidoP,particOtroApellidoM,profesor.nombre as nombre,profesor.apaterno as apaterno, profesor.amaterno as amaterno,invest_funcion_aux.id as funcionId from invest_participantes left join profesor on invest_participantes.profesorId = profesor.profesorId join invest_funcion_aux on invest_participantes.funcionId = invest_funcion_aux.id where invest_participantes.invProyId=$invProyId";
		$oDb->query($query);
		//echo $query;
		$participantes = new Participantes();
		$participantes->Agrega($funcionIdOwner,$nombreOwner);
		
		while ($rs = $oDb->getRecord("C"))
		{
			if ($rs["nombre"] == NULL)
				$nombre = $rs["particOtroApellidoP"]. " " . $rs["particOtroApellidoM"]." ".$rs["particOtroNombre"];
			else
				$nombre = $rs["apaterno"]. " " . $rs["amaterno"]." ".$rs["nombre"];
			$participantes->Agrega($rs["funcionId"],$nombre);
		}
		//$participantes->Agrega(1,"part1");
		return $participantes;
		
	}
	
	public static function ObtenProfesorNombre($id)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select nombre,apaterno,amaterno from profesor where profesorId = '".$id."'";
		$oDb->query($query);
		$rs = $oDb->getRecord();
		return $rs[0]." ".$rs[1]." ".$rs[2];
	}
	
	//regresa un arr con los id de las fuentes seleccionadas para el proyecto
	public static function ObtenFuentesDeFinanciamiento($invProyId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select fuenteAuxId from invest_proy_fuente where invProyId = $invProyId order by fuenteAuxId";  
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = $rs["fuenteAuxId"];
		}
		return $arr;
	}
	
	//regresa una lista con los nombres de las fuentes de financimiento del proyecto
	public static function ObtenFuentesDeFinanciamientoNombres($invProyId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select fuentes_financ_aux.nombre from invest_proy_fuente
		left join fuentes_financ_aux on invest_proy_fuente.fuenteAuxId = fuentes_financ_aux.id
		where invProyId = $invProyId order by fuenteAuxId";  
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = $rs["nombre"];
		}
		return $arr;
	}
	
	

	//regresa un arr con los id de los productos seleccionadas para el proyecto
	public static function ObtenProductos($invProyId)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select productoAuxId from invest_proy_prods where invProyId = $invProyId order by productoAuxId";  
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = $rs["productoAuxId"];
		}
		return $arr;
	}
	
	
	
	
}


//Para guardar y obtener los participantes de acuerso a su funcion
class Participantes
{
	private $responsables,$corresponsables,$colaboradores;
	//private $
	
	public function __construct()
	{
		$this->responsables = array();
		$this->corresponsables = array();
		$this->colaboradores = array();
		$this->estudiantes = array();
	}
	
	//solo registra los valores para 1,2 y 3, responsable, corresp y colaborador
	public function Agrega($funcionId,$nombre)
	{
		switch($funcionId)
		{
			case 1:
				$this->ResponsableSet($nombre);
				break;
			case 2:
				$this->CorresponsableSet($nombre);
				break;
			case 3:
				$this->ColaboradorSet($nombre);
				break;
			case 4:
				$this->EstudianteSet($nombre);
				break;
		}
	}
	
	public function ResponsableSet($persona)
	{
		$this->responsables[] = $persona;
	}
	
	public function ResponsablesGet()
	{
		return $this->responsables;
	}
	
	public function ColaboradorSet($persona)
	{
		$this->colaboradores[] = $persona;
	}
	
	
	
	public function ColaboradoresGet()
	{
		return $this->colaboradores;
	}
	
	public function CorresponsableSet($persona)
	{
		$this->corresponsables[] = $persona;
	}
	
	public function CorresponsablesGet()
	{
		return $this->corresponsables;
	}
	
	public function EstudianteSet($persona)
	{
		$this->estudiantes[] = $persona;
	}
	
	public function EstudiantesGet()
	{
		return $this->estudiantes;
	}

	
	
}

?>