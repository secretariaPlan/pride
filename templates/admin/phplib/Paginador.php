<?php
//Para implementar un paginador
//Javier Alpizar, 17 Feb 08

class Paginador
{
	private $paginaActual,$registrosTotal,$destino,$registrosPorPag;
	public $registroActual; //es publico porq se necesita en el query q usa esta clase
	private $paginasTotal;
	
	//$paginaActual: la pagina en la q se encuentra
	//$registroActual: El reg en q se encuentra
	//$registrosTotal el numero de registros q hay en el query
	//$destino, el programa PHP a donde se debe dirigir cuando se clickee alguna pagina del navegador
	//$registrosPorPag, el numero de registros a desplegar, 10 por default
	public function __construct($paginaActual,$registrosTotal,$destino,$registrosPorPag=10)
	{
		$this->paginaActual=$paginaActual;
		$this->registrosTotal=$registrosTotal;
		$this->destino=$destino;
		$this->registrosPorPag=$registrosPorPag;
		$this->registroActual = $registrosPorPag *  ($paginaActual-1);
		$this->paginasTotal = ceil($this->registrosTotal / $this->registrosPorPag);
	}
	
	public function NumeroDePaginas()
	{
		return $this->paginasTotal;
	}
	
	//Para mostrar las paginas
	public function ImprimeNavegador($parametros ="")
	{
		if ($parametros != "")
			$parametros = "&".$parametros;
			
		$paginasTotal = ceil($this->registrosTotal / $this->registrosPorPag);
		if ($paginasTotal <= 1)
			return "";
		
		//primera pagina
		$primera = "";
		if ($this->paginaActual > 1)
			$primera = "<a href='".$this->destino."?paginador=1&paginaActual=1&registrosTotal=".($this->registrosTotal)."&registrosPorPag=".($this->registrosPorPag).$parametros."' > << </a> ";

		$html= $primera;
				
		$pagini = 1; $pagfin=$paginasTotal; //10;
		$pagfin = min($this->paginaActual + 5,$paginasTotal);
		if ($this->paginaActual > 5)
		{
			$pagini = $this->paginaActual - 4;
			//$pagfin = min($this->pagina + 5,$this->numPaginas);
		}
		
		//pag anterior
		$anterior="  ";
		if ($this->paginaActual > 1)
			$anterior = "<a href='".$this->destino."?paginador=1&paginaActual=".($this->paginaActual-1)."&registrosTotal=".($this->registrosTotal)."&registrosPorPag=".($this->registrosPorPag).$parametros."'>  Anterior  </a> ";
		$html.= $anterior;
		
		//Las paginas 
		for($i=$pagini; $i <= $pagfin; $i++)
		{
			$pag = "<b>$i</b>";
			if ($i != $this->paginaActual)
				$pag = "<a href='".$this->destino."?paginador=1&paginaActual=".$i."&registrosTotal=".($this->registrosTotal)."&registrosPorPag=".($this->registrosPorPag).$parametros."'> $i </a> ";
			$html.= $pag;
		}
			
		//pag. siguiente
		$sig="  ";
		if ($this->paginaActual < $paginasTotal)
			$sig = "<a href='".$this->destino."?paginador=1&paginaActual=".($this->paginaActual+1)."&registrosTotal=".($this->registrosTotal)."&registrosPorPag=".($this->registrosPorPag).$parametros."'>  Siguiente  </a> ";
		$html.= $sig;
		
		//ultima pagina
		$ultima = "";
		if ($this->paginaActual != $paginasTotal)
			$ultima = "<a href='".$this->destino."?paginador=1&paginaActual=".$paginasTotal."&registrosTotal=".($this->registrosTotal)."&registrosPorPag=".($this->registrosPorPag).$parametros."'>>></a> ";
		$html.= $ultima;
		return $html;
	}
}

?>