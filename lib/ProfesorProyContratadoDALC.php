<?php
//El DALC de Proyectos Contratados
//Javier Alpizar, 28 feb 08
//No se usa

include_once("phplib/DbFactory.inc.php");
include_once("ProfesorProyInv.php");
include_once("Colaborador.php");



class ProfesorProyContratadoDALC
{
	//regrsa un arreglo de objecto ProyectoDeInvestigacion
	public static function ObtenProyectosContratados($profesorId)
	{
		$arr = array();
		
		$colaboradores = array();
		
		
		$proyecto = new ProyectoContratado();
		$proyecto->Empresa = "Pfizer";
		$proyecto->Titulo = "Proyecto1";
		$proyecto->Responsable = "Jorge Arias";
		$proyecto->CoResponsable = "Raul X";
		$proyecto->Inicio = date("Y-m-d");
		$proyecto->Fin = date("Y-m-d");
		
		$colaborador = new Colaborador();
		$colaborador->Nombre = "Toribio rojas";
		$colaboradores[] = $colaborador;
		
		$colaborador = new Colaborador();
		$colaborador->Nombre = "Torcuato Meza";
		$colaboradores[] = $colaborador;
		
		$proyecto->Colaboradores = $colaboradores;
		
		$arr[] = $proyecto;
		return $arr;
	}
}

?>