<?php
//Un objeto aviso
//Javier Alpizar, 16 Feb 08

interface IAviso
{
	public function Resumen();
}

class Aviso implements IAviso
{
	public $Id;
	public $Fecha;
	public $Titulo;
	public $Contenido;
	
	public function __construct($id,$fecha,$titulo,$contenido)
	{
		$this->Id = $id;
		$this->Fecha = $fecha;
		$this->Titulo = $titulo;
		$this->Contenido = $contenido;
	}
	
	//regresa un numero determinado de palabras del cotenido para mostrarlo como resumen 
	public function Resumen()
	{
		$palabrasNumero = 50;
		$arr = explode(" ",$this->Contenido);
		$palabras = min($palabrasNumero,count($arr));
		$resNuevo = array_slice($arr,0,$palabras);
		$resumen = implode($resNuevo," ");
		return $resumen;
		
	}
	
}

//ya no usan
class AvisoProfesor extends Aviso
{

	
}

class AvisoGeneral extends Aviso
{

}


?>