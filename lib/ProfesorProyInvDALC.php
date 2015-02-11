<?php
//El DALC de Proyectos de Investigacion
//Javier Alpizar, 28 feb 08
//NO SE USA, en su lugar es InvestigacionDALC

include_once("phplib/DbFactory.inc.php");
include_once("ProfesorProyInv.php");
include_once("Colaborador.php");



class ProfesorProyInvDALC
{
	//regrsa un arreglo de objecto ProyectoDeInvestigacion
	public static function ObtenProyectosDeInvestigacion($profesorId)
	{
		$arr = array();
		
		$colaboradores = array();
		
		
		$proyecto = new ProyectoDeInvestigacion();
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