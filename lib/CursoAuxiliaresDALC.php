<?php
//Para manejar los catalogos auxiliares de cursos seccion docencia ()
//javier Alpizar, 09 Mar 08

include_once("phplib/DbFactory.inc.php");
include_once("lib/CursoAuxiliares.php");

//Como los catalogo suelen usarse varios dentro del mismo programa y para no generar conexiones en cada uno
//los metodos no se hacen estaticos y asi comparten la conexion.
class CursoAuxiliaresDALC
{
	private $oDb;

	public function __construct()
	{	
		$this->oDb = DbFactory::ObtenDb();
	}
	
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
	
	//Regresa un arreglo de objetos semestre con los disponibles
	//tambien esta disponible en Auxiliares
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
	
	//Ojo por simplicidad y necesidad, esta clase de definio tambien en AuxiliaresDALC
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
	
	//Ojo por simplicidad y necesidad, esta clase de definio tambien en AuxiliaresDALC
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
	
	
	public function AudienciaObtener()
	{
		$query = "select id, nombre from audiencia_aux order by nombre";
		$this->oDb->query($query);
		$arr = array();
		while($rs = $this->oDb->getRecord("C"))
		{
			$arr[] = new Audiencia($rs["id"],$rs["nombre"]);
		}
		return $arr;
	}
	
}
