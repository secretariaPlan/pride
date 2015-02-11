<?php 
class Error_404 extends CI_Controller{
	
	public function  index(){
		echo "Este es el index de la funcion";
	}
	

	public function error($parametro){
		echo "El parametro obtenido fue $parametro";
	}
	
	
}

?>