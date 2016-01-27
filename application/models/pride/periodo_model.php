<?php
class Periodo_Model extends ActiveRecord\Model {
	static $table_name = "periodo";
	
		public function nuevoPeriodo($year,$numero,$inicioPeriodo,$finPeriodo,$inicioEvaluacion,$finEvaluacion,$inicioEntrega,$finEntrega) {
		
			$periodo = new Periodo_Model();
			
			$periodo->year = $year;
			$periodo->numero = $numero;
			$periodo->inicioper = $inicioPeriodo;
			$periodo->finper = $finPeriodo;
			$periodo->inicioeval = $inicioEvaluacion;
			$periodo->fineval = $finEvaluacion;
			$periodo->inicioentrega = $inicioEntrega;
			$periodo->finentrega = $finEntrega;
			
			$periodo->save();
		}

		public function periodoBusqueda(){
			$periodo = Periodo_Model::last();
			$finPerBusqueda = date("Y-m-d",strtotime("$periodo->inicioper"));
			$inicioPerBusqueda = date("Y-m-d",strtotime("$finPerBusqueda - 5 year"));
			$respuesta = array("inicioPeriodoBusqueda" => $inicioPerBusqueda,
								"finPeriodoBusqueda" => $finPerBusqueda);

			return $respuesta;
		}
		
		public function listaPeriodo(){
			$respuesta = array();
			$periodos = Periodo_Model::all();
			foreach ($periodos as $periodo) {
				$respuesta["periodos"][] = array("id" => $periodo->id,
												   "periodo"=>"$periodo->year-$periodo->numero");
			}
			echo json_encode($respuesta);
		}
				
		public function listaSinUltimoPeriodo(){
			$respuesta = array();
			$periodos = Periodo_Model::find_by_sql("SELECT * FROM periodo WHERE numero NOT IN (SELECT max(numero) FROM periodo)");
			foreach ($periodos as $periodo) {
				$respuesta["periodos"][] = array("id" => $periodo->id,
						"periodo"=>"$periodo->year-$periodo->numero",
						"inicioper"=>$periodo->inicioper->format('d-m-Y'),
						"finper"=>$periodo->finper->format('d-m-Y'),
						"inicioeval"=>$periodo->inicioeval->format('d-m-Y'),
						"fineval"=>$periodo->fineval->format('d-m-Y'),
						"inicioentrega"=>$periodo->inicioentrega->format('d-m-Y'),
						"finentrega"=>$periodo->finentrega->format('d-m-Y'));
			}
			echo json_encode($respuesta);
		}
				
		public function listaUltimoPeriodo(){
			$respuesta = array();
			$periodos = Periodo_Model::find_by_sql("SELECT * FROM periodo ORDER BY numero DESC LIMIT 1");
			foreach ($periodos as $periodo) {
				$respuesta["periodos"][] = array("id" => $periodo->id,
						"periodo"=>"$periodo->year-$periodo->numero",
						"inicioper"=>$periodo->inicioper->format('d-m-Y'),
						"finper"=>$periodo->finper->format('d-m-Y'),
						"inicioeval"=>$periodo->inicioeval->format('d-m-Y'),
						"fineval"=>$periodo->fineval->format('d-m-Y'),
						"inicioentrega"=>$periodo->inicioentrega->format('d-m-Y'),
						"finentrega"=>$periodo->finentrega->format('d-m-Y'));
			}
			echo json_encode($respuesta);
		}
		
		function desasignarPeriodo($id){
		
			$periodo = Periodo_Model::first("$id");
		
			$periodo->delete();
		
			$respuesta["mensaje"] = "Periodo Eliminado";
		
			echo json_encode($respuesta);
		}
		
}

?>