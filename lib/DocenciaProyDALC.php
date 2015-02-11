<?php
//Para proyectos financiados de docencia

//Javier Alpizar, 17 Mar 10

include_once("phplib/DbFactory.inc.php");
include_once("fecha_rango.php");

class DocenciaProyDALC
{ 
	//Obtiene las asesorias a profesor
	public static function ObtenRegistros($profesorId,$inicio=NULL,$fin=NULL)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select docencia_proyecto.id,
				docencia_proyecto.nombre,areaOtro,monto,periodoIni,periodoFin,inicio,fin,finEstimado,trabajoOtro
				,participantes,concluido,a.nombre as area,docencia_proyecto.funcionId,
				d.nombre as depto,f.nombre as funcion,t.nombre as trabajo
				from docencia_proyecto
				left join docencia_proyecto_area a on docencia_proyecto.areaId = a.id
				left join docencia_proyecto_depto d on docencia_proyecto.deptoId = d.id
				left join docencia_proyecto_funcion f on docencia_proyecto.funcionId = f.id
				left join docencia_proyecto_trabajo t on docencia_proyecto.trabajoId = t.id
				where profesorId = $profesorId ";
		if ($inicio != NULL or $fin != NULL)
			{
				$fechas = Fecha_Rango::ObtenRango($inicio,$fin);
				$query .= "and ".$fechas;
			}
		$query.= " order by inicio desc";
		//echo $query;
		$oDb->query($query);
		$arr = array();
		while ($rs = $oDb->getRecord("C"))
		{
			$arr[] = $rs;
		}
		return $arr;
	}
	
	function ObtenRegistro($id)
	{
		$oDb = DbFactory::ObtenDb();
		$query = "select docencia_proyecto.id,
				docencia_proyecto.nombre,areaOtro,monto,periodoIni,periodoFin,inicio,fin,finEstimado,trabajoOtro
				,participantes,concluido,areaId,productoOtro,
				deptoId,funcionId,trabajoId,productoId
				from docencia_proyecto
				where id = $id ";
		$oDb->query($query);
		$rs = $oDb->getRecord("C");
		return $rs;
	}
	
	function ObtenParticipantes($id)
	{
		$oDb = DbFactory::ObtenDb();
		$query ="select id,funcionId,nivelId,procedencia,profesorId,particOtroNombre,particOtroApellidoP,
				particOtroApellidoM,particOtroInstitucion,estudNombre,estudApellidoP,estudApellidoM 
				from docencia_proyecto_participantes 
				where proyectoId = $id order by id";
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
							"estudNombre"=>$rs["estudNombre"],
							"estudApellidoP"=>$rs["estudApellidoP"],
							"estudApellidoM"=>$rs["estudApellidoM"],
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
		$query ="select particOtroNombre,particOtroApellidoP,particOtroApellidoM,profesor.nombre as nombre,
				profesor.apaterno as apaterno, profesor.amaterno as amaterno,
				invest_funcion_aux.id as funcionId,estudNombre,estudApellidoP,estudApellidoM 
				from docencia_proyecto_participantes 
				left join profesor on docencia_proyecto_participantes.profesorId = profesor.profesorId 
				join invest_funcion_aux on docencia_proyecto_participantes.funcionId = invest_funcion_aux.id 
				where docencia_proyecto_participantes.proyectoId=$invProyId";
		$oDb->query($query);
		//echo $query;
		$participantes = new Participantesp();
		$participantes->Agrega($funcionIdOwner,$nombreOwner);
		
		while ($rs = $oDb->getRecord("C"))
		{
			if ($rs["nombre"] == NULL)
			{
				if ($rs["funcionId"] == 4) 
					$nombre = $rs["estudApellidoP"]. " " . $rs["estudApellidoM"]." ".$rs["estudNombre"];
				else
					$nombre = $rs["particOtroApellidoP"]. " " . $rs["particOtroApellidoM"]." ".$rs["particOtroNombre"];
			}
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
	
}

//Para guardar y obtener los participantes de acuerso a su funcion
class ParticipantesP
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