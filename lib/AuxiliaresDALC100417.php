<?php
//Para manejar los catalogos auxiliares (ejm titulos, nacionalidades, edo civil, etc)
//javier Alpizar, 18 Feb 08

include_once("phplib/DbFactory.inc.php");
include_once("lib/Auxiliares.php");

//Como los catalogo suelen usarse varios dentro del mismo programa y para no generar conexiones en cada uno
//los metodos no se hacen estaticos y asi comparten la conexion.
class AuxiliaresDALC
{
	private $oDb;

	public function __construct()
	{	
		$this->oDb = DbFactory::ObtenDb();
	}
	
	//permite construir un auxiliar en forma generica
	//Usado por las tablas:
	//ubicacion_planta_aux
	public function AuxiliarObtener($tabla,$id,$nombre)
	{
		$query = "select $id, $nombre from $tabla order by $nombre";
		//echo $query;
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Auxiliar($rs[$id],$rs[$nombre]);
		}
		
		return $arr;
	}
	
	public function TitulosObtener()
	{
		$query = "select tituloId, nombre from titulo order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Titulo($rs["tituloId"],$rs["nombre"]);
		}
		$arr[] = new Titulo(0,"Otro");
		return $arr;
	}
	
	public function PlantasObtener($edificioId)
	{
		$query = "select ubicacion_planta_aux.id as id,ubicacion_planta_aux.nombre as nombre from ubicacion_planta_aux 
				join ubicacion_edificio_planta on ubicacion_planta_aux.id = ubicacion_edificio_planta.plantaId
				where ubicacion_edificio_planta.edificioId = $edificioId ";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = array($rs["id"],$rs["nombre"]);
		}
		
		return $arr;
	}
	
	public function NacionalidadesObtener()
	{
		$query = "select nacionalidadId, nombre from nacionalidad order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Nacionalidad($rs["nacionalidadId"],$rs["nombre"]);
		}
		$arr[] = new Nacionalidad(0,"Otra");
		return $arr;
	}
	
	public function EstadosCivilesObtener()
	{
		$query = "select edoCivilId, nombre from edocivil order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new EstadoCivil($rs["edoCivilId"],$rs["nombre"]);
		}
		$arr[] = new EstadoCivil(0,"Otro");
		return $arr;
	}
	
	public function PaisesObtener_()
	{
		$query = "select paisId, nombre from pais_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Pais($rs["paisId"],$rs["nombre"]);
		}
		$arr[] = new Pais(0,"Otro");
		return $arr;
	}
	
	
	
	public function EntidadesObtener()
	{
		$query = "select entidadId, nombre from entidad order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Entidad($rs["entidadId"],$rs["nombre"]);
		}
		$arr[] = new Entidad(0,"Otro");
		return $arr;
	}
	
	//Los edificios conq cuenta la facultad
	public function EdificiosObtener()
	{
		$query = "select id, nombre from ubicacion_edificio_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Auxiliar($rs["id"],$rs["nombre"]);
		}
		return $arr;
	}
	
	
	public function InstitucionesObtener()
	{
		$query = "select institucionId,nombre from institucion_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Institucion($rs["institucionId"],$rs["nombre"]);
		}
		return $arr;
	}
	
	//todo el catalogo de carreras, ver las tres funciones de abajo para separar por nivel
	public function CarrerasObtener()
	{
		$query = "select carreraId,nombre from carrera_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Carrera($rs["carreraId"],$rs["nombre"]);
		}
		return $arr;
	}
	
	public function CarrerasDoctoradoObtener()
	{
		$query = "select carrera_aux.carreraId,nombre from carrera_aux 
					join carrera_doctorado on carrera_aux.carreraid = carrera_doctorado.carreraId
					order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Carrera($rs["carreraId"],$rs["nombre"]);
		}
		return $arr;
	}
	
	public function CarrerasLicObtener()
	{
		$query = "select carrera_aux.carreraId,nombre from carrera_aux 
					join carrera_lic on carrera_aux.carreraid = carrera_lic.carreraId
					order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Carrera($rs["carreraId"],$rs["nombre"]);
		}
		return $arr;
	}
	
	public function CarrerasEspecializObtener()
	{
		$query = "select carrera_aux.carreraId,nombre from carrera_aux 
					join carrera_especializ on carrera_aux.carreraid = carrera_especializ.carreraId
					order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Carrera($rs["carreraId"],$rs["nombre"]);
		}
		return $arr;
	}
	
	public function CarrerasMaestriaObtener()
	{
		$query = "select carrera_aux.carreraId,nombre from carrera_aux 
					join carrera_maestria on carrera_aux.carreraid = carrera_maestria.carreraId
					order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Carrera($rs["carreraId"],$rs["nombre"]);
		}
		return $arr;
	}
	
	function PosgradoTitOpcion($campo)
	{
		$query = "select id,nombre from tit_pos_opciones where ".$campo ." = 1";
		$this->oDb->query($query);
		//echo $query;
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Auxiliar($rs["id"],$rs["nombre"]);
		}
		
		return $arr;
		
	}
	
	public function NivelesObtener($campo = "")
	{
		$query = "select nivelAuxId,nombre from nivel_aux ";
		
		if ($campo != "")
			$query.="where ".$campo." = 1 ";
		$query.=" order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Nivel($rs["nivelAuxId"],htmlentities($rs["nombre"]));
		}
		return $arr;
	}
	
	//niveles para examenes de posgrado
	public function ExPosNivelesObtener()
	{
		$query = "select nivelAuxId,nombre from nivel_aux_exposgrado ";
		
		
		$query.=" order by nivelAuxId";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Nivel($rs["nivelAuxId"],htmlentities($rs["nombre"]));
		}
		return $arr;
	}
	
	//Para investigacion no quieren todos los niveles, solo los definidos en la tabla _inv
	public function InvNivelesObtener()
	{
		$query = "select nivel_aux_inv.nivelAuxId,nivel_aux.nombre from nivel_aux_inv 
				 join nivel_aux on nivel_aux_inv.nivelAuxId = nivel_aux.nivelAuxId";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Nivel($rs["nivelAuxId"],htmlentities($rs["nombre"]));
		}
		return $arr;
	}
	
	
	public function AsignaturasObtener()
	{
		$query = "select asignaturaId,nombre,clave from asignatura order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Asignatura($rs["asignaturaId"],$rs["clave"] . " - " .$rs["nombre"]);
		}
		return $arr;
	}
	
	
	public function SubprogramasProfesorObtener()
	{
		$query = "select id,nombre from subprograma_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new SubprogramaProfesor($rs["id"],$rs["nombre"]);
		}
		return $arr;
	}
	
	//regresa una arr profs. [nombre,apellidop y m] cordenados por el apellido 
	public function ProfesoresObtener()
	{
		$query = "select profesorId,nombre,apaterno,amaterno from profesor order by apaterno,amaterno,nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new ProfesorNombre($rs["profesorId"],$rs["nombre"],$rs["apaterno"],$rs["amaterno"]);
		}
		return $arr;
	}
	
	public function FuentesDeFinanciamientoObtener()
	{
		$query = "select id,nombre from fuentes_financ_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new FuenteDeFinanciamiento($rs["id"],$rs["nombre"]);
		}
		return $arr;
	}
	
	public function ProgramasAlumnoObtener()
	{
		$query = "select id,nombre from programa_alumno_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new ProgramaAlumno($rs["id"],$rs["nombre"]);
		}
		return $arr;
	}
	
	public function FacultadesObtener($nivel=3)  
	{
		
		$query = "select facultadId,nombre from facultad_aux where nivelAuxId=".intval($nivel)." order by nombre";
		if ($nivel == 99)  //todos
			$query = "select facultadId,nombre from facultad_aux  order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Facultad($rs["facultadId"],$rs["nombre"]);
		}
		return $arr;
	}
	
	/////////////////////////////////////
	//Los tipos de cursos que hay en posgrado
	public function PosgradoCursoTipoObtener()
	{
		$query = "select id, nombre from curso_posgrado_tipo order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new PosgradoCursoTipo($rs["id"],$rs["nombre"]);
		}
		return $arr;
	}
	

	
	public function ExtracurrCursoTipoObtener()
	{
		$query = "select id, nombre from curso_extracurr_tipo order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new ExtracurrCursoTipo($rs["id"],$rs["nombre"]);
		}
		return $arr;
	}
	
	public function FueraCursoTipoObtener()
	{
		$query = "select id, nombre from curso_fuera_tipo order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new FueraCursoTipo($rs["id"],$rs["nombre"]);
		}
		return $arr;
	}
	////////////////////////////
	
	
	
	//Ojo por simplicidad y necesidad, esta clase de definio tambien en CursoAuxiliaresDALC
	public function CiudadesObtener()
	{
		$query = "select ciudadId,nombre from ciudad_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Ciudad($rs["ciudadId"],$rs["nombre"]);
		}
		return $arr;
	}
	
	//Ojo por simplicidad y necesidad, esta clase de definio tambien en CursoAuxiliaresDALC
	public function PaisesObtener()
	{
		$query = "select paisId, nombre from pais_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Pais($rs["paisId"],$rs["nombre"]);
		}
		return $arr;
	}
	
	public function ReunionTiposObtener()
	{
		$query = "select id, nombre from reunion_tipo_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new ReunionTipo($rs["id"],$rs["nombre"]);
		}
		return $arr;
	}
	
	
	public function ReunionTrabajoTiposObtener()
	{
		$query = "select id, nombre from trabajo_tipo_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new ReuniontrabajoTipo($rs["id"],$rs["nombre"]);
		}
		return $arr;
	}
	
	//tipo=[A|D] academica /difusion
	public function ActividadTiposObtener($tipo="")
	{
		$arr = array("A"=>"academica","D"=>"difusion");
		$query = "select id, nombre from actividad_tipo_aux ";
		if ($tipo != "")
			$query .= " where ".$arr[$tipo]. "=1";
		$query.= " order by nombre";
		//echo $query;
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new ActividadTipo($rs["id"],$rs["nombre"]);
		}
		return $arr;
	}
	
	public function ActividadesSupAcadObtener()
	{
		$query = "select actividadId, nombre from sup_acad_acts order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new ActividadSupAcad($rs["actividadId"],$rs["nombre"]);
		}
		return $arr;
	}
	
	public function MaterialDocenteActsObtener()
	{
		$query = "select id, nombre from mat_doc_actividad_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new MaterialDocenteActividad($rs["id"],$rs["nombre"]);
		}
		return $arr;
	}
	
	public function ProgramasObtener()
	{
		$query = "select programaId, nombre from programa_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Programa($rs["programaId"],$rs["nombre"]);
		}
		return $arr;
	
	}

	public function IdiomasObtener()
	{
		$query = "select idiomaId, nombre from idioma_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Idioma($rs["idiomaId"],$rs["nombre"]);
		}
		return $arr;
	
	}
	
	//Los departamentos existentes en la facultad
	public function DepartamentosObtener($conarea=1)
	{
		$query = "select deptoAuxId,nombre from depto_aux where conarea=1 order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Departamento($rs["deptoAuxId"],$rs["nombre"]);
		}
		return $arr;
	}
	
	//Cada departamento tiene definidas sus areas o lineas de investigacion
	public function AreasDeInvestigacionObtener($deptoId)
	{
		$query = "select investigacion_linea.invLineaId,nombre 
				from investigacion_linea,depto_investigacion_linea
				where depto_investigacion_linea.departamentoId = $deptoId and
				depto_investigacion_linea.invLineaId = investigacion_linea.invLineaid";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = array("id"=>$rs["invLineaId"],"nombre"=>$rs["nombre"]);
		}
		return $arr;
				
	}
	
	
	//Los campos de la ciencia
	public function CienciasObtener()
	{
		$query = "select id,nombre from ciencia_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Ciencia($rs["id"],$rs["nombre"]);
		}
		return $arr;
	}
	
	//Los tipos de investigacion
	public function InvestigacionTipoObtener()
	{
		$query = "select id,nombre from invest_tipo_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new InvestigacionTipo($rs["id"],$rs["nombre"]);
		}
		return $arr;
	}
	
	//	Los productos de la investigacion
	public function InvestigacionProductosObtener()
	{
		$query = "select id,nombre from invest_prods_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new InvestigacionProducto($rs["id"],$rs["nombre"]);
		}
		return $arr;
	}
	
	
	//	Los funciones en la investigacion [responsable, corresp...]
	public function InvestigacionFuncionesObtener()
	{
		$query = "select id,nombre from invest_funcion_aux ";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new InvestigacionFuncion($rs["id"],$rs["nombre"]);
		}
		return $arr;
	}
	
	public function ExamenPosgradoOpcion()
	{
		$query = "select funcionId, nombre from funcion_aux where exposgrado = 1 order by nombre";
		//echo $query;
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Auxiliar($rs["funcionId"],$rs["nombre"]);
		}
		
		return $arr;
	}
	
	//Los funciones en la investigacion [responsable, corresp...]
	public function CursoPosFuncionesObtener()
	{
		$query = "select id,nombre from curso_pos_funcion_aux ";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new InvestigacionFuncion($rs["id"],$rs["nombre"]);
		}
		$arr[] = new InvestigacionFuncion(0,"Otro");
		return $arr;
	}
	
	//tambien esta disponible en cursosauxiliares, regresa un arreglo de objetos semestre con los disponibles
	public function SemestresObtener()
	{
		$query = "select semestreId, clave from semestre order by semestreId desc";
		//echo $query;
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Semestre($rs["semestreId"],$rs["clave"]);
		}
		return $arr;
	}
	
	public function PremiosTipoObtener()
	{
		$query = "select premioTipoId, nombre from premio_tipo order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new PremioTipo($rs["premioTipoId"],$rs["nombre"]);
		}
		return $arr;
	
	}
	 
	public function AsociacionesObtener()
	{
		$query = "select asociacionAuxId, nombre from asociacion_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new PremioTipo($rs["asociacionAuxId"],$rs["nombre"]);
		}
		return $arr;
	
	}
	 
	public function FuncionesObtener()
	{
		$query = "select funcionId, nombre from funcion_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new PremioTipo($rs["funcionId"],$rs["nombre"]);
		}
		return $arr;
	
	}
	
	
	public function OrganosColegiadosObtener()
	{
		$query = "select organoAuxId, nombre from organocolegiado_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new PremioTipo($rs["organoAuxId"],$rs["nombre"]);
		}
		return $arr;
	
	}
	
	public function OrganosAsesoresObtener()
	{
		$query = "select organoAuxId, nombre from organoasesor_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new PremioTipo($rs["organoAuxId"],$rs["nombre"]);
		}
		return $arr;
	
	}
	
	public function ComisionesEvaluadorasObtener()
	{
		$query = "select comisionEvalAuxId, nombre from comision_eval_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new ComisionEvaluadora($rs["comisionEvalAuxId"],$rs["nombre"]);
		}
		return $arr;
	
	}
	
	public function CargosAcademicosObtener()
	{
		$query = "select cargoAuxId, nombre from cargo_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new CargoAcademico($rs["cargoAuxId"],$rs["nombre"]);
		}
		return $arr;
	
	}
	
	public function ApoyosAcademicosObtener()
	{
		$query = "select apoyoAcadAuxId, nombre from apoyo_acad_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new CargoAcademico($rs["apoyoAcadAuxId"],$rs["nombre"]);
		}
		return $arr;
	
	}
	
	public function ProgramasExternosObtener()
	{
		$query = "select id, nombre from prog_externo_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new ProgramaExterno($rs["id"],$rs["nombre"]);
		}
		return $arr;
	
	}
	
	public function ProgramasExternosNivelesObtener()
	{
		$query = "select id, nombre from prog_externo_nivel_aux order by id";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new ProgramaExternoNivel($rs["id"],$rs["nombre"]);
		}
		return $arr;
	
	}
	
	public function MesesObtener()
	{
		$meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$arr = array();
		$iCont=1;
		foreach($meses as $mes)
		{
			$arr[] = new Mes($iCont++,$mes);
		}
		return $arr;
	}
		
	public function AniosObtener()
	{
		
		$arr = array();
		$iCont=0;
		$yearHoy = date("Y");
		$inicio = $yearHoy - 70;
		$fin = $yearHoy + 10; 
		for($i=$inicio; $i<$fin;$i++)
		{
			$arr[] = new Anio($i,$i);
		}
		return $arr;
	}
	
	
}


?>