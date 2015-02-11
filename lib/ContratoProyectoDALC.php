<?php
//El DALC proyectos contratados
//Javier Alpizar, 17 Mar 08

include_once("phplib/DbFactory.inc.php");
include_once("lib/ParticipantesC.php");
include_once("fecha_rango.php");

class ContratoProyectoDALC
{ 
	//Obtiene los proyectos de inv 
	public static function ObtenProyectosContratados($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select contrProyId,
				 titulo,empresa,inicio,fin,concluido,finEstimado,funcionId
				 from contrato_proyecto
				 where profesorId = $profesorId ";
		if ($inicio != NULL or $fin != NULL)
		{
			$fechas = " and ".Fecha_Rango::ObtenRango($inicio,$fin);
			//el primero es para fechas q empezaron antes y terminan despues del rango
			//el segundo es para fechas q iniciaron antes del rango y terminan en el  rango
			//el tercero es para fechas q incian en el rango y terminan despues
			//el cuarto es para fechas dentro del rango
			//el quinto es para eventos que tiene fecha de inicio dentro del rango y no han acabado
			$query .= $fechas;
		}
		$query.= " order by  inicio desc";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = array("contrProyId"=>$rs["contrProyId"],
							"titulo"=>$rs["titulo"],
							"empresa"=>$rs["empresa"],
							"funcionId"=>$rs["funcionId"],
							"concluido"=>$rs["concluido"],
							"inicio"=>$rs["inicio"],
							"fin"=>$rs["fin"] ,
							"finEstimado"=>$rs["finEstimado"] 
							 );
		}
		/*$arr[] = array("contrProyId"=>1,
							"titulo"=>"proyecto x",
							"empresa"=>"empresa sa",
							"funcionId"=>1,
							"concluido"=>"2002-02-02",
							"inicio"=>"2001-01-01",
							"fin"=>"2002-01-01",
							"finEstimado"=>"" 
							 );*/
		return $arr;
	}
	
	public static function ObtenProyectoContratado($contrProyId)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select contrProyId,titulo,empresa,descripcion,funcionId,
				 concluido,inicio,fin,finEstimado 
				 from contrato_proyecto
				 where contrProyId = $contrProyId ";
		//echo $query;
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
	
	
	//los participantes del proyecto.
	public static function ObtenParticipantes($contrProyId)
	{
		
		$oDb = DbFactory::ObtenDb();
		$query ="select id,funcionId,nivelId,procedencia,profesorId,particOtroNombre,particOtroApellidoP,
				particOtroApellidoM,particOtroInstitucion,particOtroNombramiento 
				from contr_proy_participantes 
				where contrProyId = $contrProyId order by id";
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
		/*$arr[] = array("id"=>1,
							"funcionId"=>1,
							"nivelId"=>"prepa",
							"procedencia"=>"UNAM",
							"profesorId"=>1,
							"particOtroNombre"=>"javier",
							"particOtroApellidoP"=>"alpi",
							"particOtroApellidoM"=>"mor"
							 );*/
		return $arr;
		
	} 
	
	
	
	//Regresa un objeto participantes con los nombre y su funcion en un proyecto
	//nombreowner es el nombre del prof q capturo el registro
	//y sun funcion es la q declaro tener en el proyecto. Por la definicion de requerimientos
	//no se le integro dentro de la base de participantes.
	//el valor de funcionId se refiere al tipo de funcion q desempena.Esta en la tabla invest_funcion_aux
    //cuyos primeros valores estan marcados ReadOnly pues no deben cambiar:
    //1 Resp, 2 Corresp, 3 Colaborador, 4 Estudiante
	public static function ObtenParticipantesNombres($contrProyId,$nombreOwner,$funcionIdOwner)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select particOtroNombre,particOtroApellidoP,particOtroApellidoM,
				 profesor.nombre as nombre,profesor.apaterno as apaterno, profesor.amaterno as amaterno,
				 invest_funcion_aux.id as funcionId 
				 from contr_proy_participantes 
				 left join profesor on contr_proy_participantes.profesorId = profesor.profesorId 
				 join invest_funcion_aux on contr_proy_participantes.funcionId = invest_funcion_aux.id 
				 where contr_proy_participantes.contrProyId=$contrProyId";
		$oDb->query($query);
		//echo $query;
		$participantes = new ParticipantesC();
		$participantes->Agrega($funcionIdOwner,$nombreOwner);
		
		while ($rs = $oDb->getRecord("C"))
		{
			//var_dump($rs);
			if ($rs["nombre"] == NULL)
				$nombre = $rs["particOtroApellidoP"]. " " . $rs["particOtroApellidoM"]." ".$rs["particOtroNombre"];
			else
				$nombre = $rs["apaterno"]. " " . $rs["amaterno"]." ".$rs["nombre"];
			$participantes->Agrega($rs["funcionId"],$nombre);
		}
		return $participantes;
		
	}
	
	

	
	
	
	
}


//Para guardar y obtener los participantes de acuerso a su funcion
/*
 * ya esta es su propio archivo ParticipantesC
 
class Participantes
{
	private $responsables,$corresponsables,$colaboradores;
	//private $
	
	public function __construct()
	{
		$this->responsables = array();
		$this->corresponsables = array();
		$this->colaboradores = array();
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

	
	
}
*/
?>