<?php
//define metodos comunes que permitan generar un reporte independiente de la salida necesaria (pdf, html, etc)
//Javier Alpizar, 8 Jun 08

require('phplib/fpdf.php');

interface IReporte
{
	public function EncabezadoAzul($texto);
	public function EncabezadoAmarillo($texto);
	public function EncabezadoGris($texto);
	
	public function EncabezadoAmarilloPeque($texto);
	//para saltar un renglon
	public function Salto();
	
	//una tabla con dos columnas, [Texto:,Valor]
	//$els es un arreglo de arreglos [texto,valor]
	public function TablaSencilla($els);
	public function TablaSimple($els);
	
	//Una tabla con multiples columnas
	//Dimensiones contiene un arreglo con el % que cada columna debe ocupar
	//elsEncabezado tiene los nombres q se deben imprimir  como encabezados
	//els trae los elementos a imprimir
	public function TablaCompuesta($dimensiones,$elsEncabezado,$els);
	
	
	public function Fin();
	
	//Para imprimir etiquetas que son utiles para html pero q no se deben desplegar en pdf
	//como campos hidden por ejm.
	public function EtiquetaOculta($texto);
	
	//Imprime el texto en la posicion actual
	public function Tabla1Col($texto);
}

//Para que funcione, la primer funcion q se debe llamar es Inicio y la Ultima es Fin
//este es el tamano aprox de una pag.205x295
//expresado em mm
class ReportePdf extends FPDF implements IReporte 
{
	
	public function Inicio()
	{
		$this->AddPage();
		$this->SetFont('Arial','B',20);
		$this->SetAutoPageBreak(true);
	}
	/*
	function AcceptPageBreak()
	{
		$this->SetY(10);
		return true;
	}
   */
	//Imprime los logos de fq y unam y opcionalmente un titulo entre ellos
	public function Titulo($texto)
	{
		$this->Image("imagenes/unam2.jpg",10,10,15,17);
		$this->Image("imagenes/fquim2.jpg",145,10,50,13);
		//$this->Cell(30);
		$this->SetXY(50,20);
		$this->Cell(0,0,$texto);
		$this->Ln(10);
		$this->SetFont('Arial','B',15);
	}
	
	public function EncabezadoAzul($texto)
	{
		if ($this->GetY() >= 260)
				$this->AddPage();
				
		$this->SetLineWidth(0.5);
		
		$this->SetDrawColor(223,229,238);
    	$this->SetFillColor(223,229,238);
        //Título
        $this->SetFont('Arial','B',15);
        $this->SetTextColor(0,0,108);
	    $this->Cell(0,10,$texto,1,0,'L',1);
	    //Salto de línea
    	$this->Ln(10);
		
	}
	
	public function EncabezadoAmarillo($texto)
	{
		if ($this->GetY() >= 260)
				$this->AddPage();
				
		$this->SetLineWidth(0.5);
		
		$this->SetDrawColor(255,255,17); //$this->SetDrawColor(255,255,204);
    	$this->SetFillColor(255,255,17); //$this->SetFillColor(255,255,204);
        //Título
		$this->SetTextColor(103,63,18);        //$this->SetTextColor(204,102,0);
        $this->SetFont('Arial','B',12);
	    $this->Cell(0,10,$texto,1,0,'L',1);
	    //Salto de línea
    	$this->Ln(12);
	}
	
	public function EncabezadoGris($texto)
	{
		if ($this->GetY() >= 260)
				$this->AddPage();
				
		$this->SetLineWidth(0.5);
		
		$this->SetDrawColor(255,255,204);
    	$this->SetFillColor(207,207,207);
        //Título
        $this->SetTextColor(204,102,0);
        $this->SetFont('Arial','B',12);
	    $this->Cell(0,10,$texto,1,0,'L',1);
	    //Salto de línea
    	$this->Ln(12);
	}
	
	public function EncabezadoNaranja($texto)
	{
		if ($this->GetY() >= 260)
				$this->AddPage();
				
		$this->SetLineWidth(0.5);
		
		$this->SetDrawColor(103,63,18); //$this->SetDrawColor(139,96,3);
    	$this->SetFillColor(103,63,18); //$this->SetFillColor(139,96,3);
        //Título
        $this->SetTextColor(255,255,17); //$this->SetTextColor(255,249,191);
        $this->SetFont('Arial','B',12);
	    $this->Cell(0,10,$texto,1,0,'L',1);
	    //Salto de línea
    	$this->Ln(12);
	}
	
	
	public function EncabezadoAmarilloPeque($texto)
	{
		if ($this->GetY() >= 260)
				$this->AddPage();
				
		$this->SetLineWidth(0.5);
		
		//$this->SetDrawColor(255,249,191);
    	//$this->SetFillColor(255,249,191);
    	$this->SetDrawColor(255,255,17); //$this->SetDrawColor(255,255,204);
    	$this->SetFillColor(255,255,17); //$this->SetFillColor(255,255,204);
        //Título
        //$this->SetTextColor(204,102,0);
        $this->SetTextColor(103,63,18);        //$this->SetTextColor(204,102,0);
        $this->SetFont('Arial','',10);
	    $this->Cell(0,10,$texto,1,0,'L',1);
	    //Salto de línea
    	$this->Ln(12);
	}
	
	public function Salto()
	{
		$this->Ln(5);
	}
	
	public function TablaSencilla($els)
	{
		//se tienen 205 mm, 22%=>45mm, 78%=>159
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		//El Multicell arruina por alguna razon el page break, por eso se hace el chequeo manual, ojo con el largo 260 correponde a Letter q es indico al
		//instanciar la clase
		foreach($els as $el)
		{
			if ($this->GetY() >= 260)
				$this->AddPage();
			$this->SetFont('Arial','B',7);
			$yPosIni = $this->GetY();
			$this->MultiCell(50,5,$el[0].":");  //el multicell permite hacer el wrap pero hay q regressarlo a la pos original para 
			$yPosFin = $this->GetY();  //las demas cols.
			$this->SetFont('Arial','',7);
			$this->SetXY(63,$yPosIni+2);
			$this->Cell(142,0,$el[1]);
			//$this->SetY($yPosFin+2);
			$this->Ln($yPosFin - $yPosIni);
			
			
		}
		$this->Ln(5);
	}
	
	//La letra es igual en tamaño q la tabla compuesta
	public function TablaSimple($els)
	{
		//se tienen 205 mm, 22%=>45mm, 78%=>159
		$this->SetFont('Arial','B',10);
		$this->SetTextColor(0,0,0);
		//El Multicell arruina por alguna razon el page break, por eso se hace el chequeo manual, ojo con el largo 260 correponde a Letter q es indico al
		//instanciar la clase
		foreach($els as $el)
		{
			if ($this->GetY() >= 260)
				$this->AddPage();
			$this->SetFont('Arial','',7);
			$yPosIni = $this->GetY();
			$this->MultiCell(50,5,$el[0].":");  //el multicell permite hacer el wrap pero hay q regressarlo a la pos original para 
			$yPosFin = $this->GetY();  //las demas cols.
			$this->SetFont('Arial','',7);
			$this->SetXY(63,$yPosIni+2);
			$this->Cell(142,0,$el[1]);
			//$this->SetY($yPosFin+2);
			$this->Ln($yPosFin - $yPosIni);
			
			
		}
		$this->Ln(5);
	}
	
	
	
	
	
	public function TablaCompuesta($dimensiones,$elsEncabezado,$els)
	{
		if ($this->GetY() >= 260)
				$this->AddPage();
		$this->SetFont('Arial','',7);
		$this->SetTextColor(0,0,0);
		//obtiene la longitud q se le va a asignar a cada columna
		//se toma como base 196
		$longMax = 196;
		$cant = sizeof($dimensiones);
		$longCols = array();
		//22,5,3,8,10,9,10,33);
		foreach($dimensiones as $porciento)
		{
			$largo = $longMax * $porciento / 100;
			$longCols[] = $largo;
		}
		//$longCols trae en mm el largo de cada columna
		//se da este primer paso para poder calcular el alto maximo de los encabezados
		$yPosIni = $this->GetY();
		$xPosIni = $this->GetX();
		$xPos=$this->GetX();
		$alto = 0;
		$this->SetFillColor(207,207,207);
		$this->SetDrawColor(255,255,255);
		$this->SetLineWidth(0.2);
		for($i=0;$i<$cant;$i++)
		{	
			if ($this->GetY() >= 260)
			{
				$this->AddPage();
				$yPosIni = $this->GetY();
			}
				
			$this->SetXY($xPos,$yPosIni);
			$this->MultiCell($longCols[$i],5,$elsEncabezado[$i],0,"C",1);
			$xPos+=$longCols[$i];
			
			$alto = max($alto,($this->GetY()- $yPosIni));
			
		}
		//ya con el alto se vuelve a pintar para poder dibujar el relleno con un retangulo del tamanio adecuado
		$xPos = $xPosIni;
		
		for($i=0;$i<$cant;$i++)
		{	
			$this->SetXY($xPos,$yPosIni);
			$this->Rect($xPos,$yPosIni,$longCols[$i],$alto,"DF");
			$this->MultiCell($longCols[$i],5,$elsEncabezado[$i],0,"C",0);
			$xPos+=$longCols[$i];
			
			//$alto = max($alto,($this->GetY()- $yPosIni));
			
		}
		$this->SetY($yPosIni+$alto);
		//y luego pinta los elementos
		foreach($els as $el)
		{
			if ($this->GetY() >= 260)
			{
				$this->AddPage();
				
			}
			$xPos = $xPosIni;
			$yPosIni = $this->GetY();
			$alto = 0;
			for($i=0;$i<$cant;$i++)
			{
				$this->SetXY($xPos,$yPosIni);
				$this->MultiCell($longCols[$i],5,$el[$i],0,"L",0);
				$xPos+=$longCols[$i];
				$alto = max($alto,($this->GetY()- $yPosIni));
			}
			$this->SetY($yPosIni+$alto);
		}
		
	}
	
	//Es = a TablaCompuesta
	public function TablaCompuestaNormal($dimensiones,$elsEncabezado,$els)
	{
		if ($this->GetY() >= 260)
				$this->AddPage();
		$this->SetFont('Arial','',7);
		$this->SetTextColor(0,0,0);
		//obtiene la longitud q se le va a asignar a cada columna
		//se toma como base 196
		$longMax = 196;
		$cant = sizeof($dimensiones);
		$longCols = array();
		//22,5,3,8,10,9,10,33);
		foreach($dimensiones as $porciento)
		{
			$largo = $longMax * $porciento / 100;
			$longCols[] = $largo;
		}
		//$longCols trae en mm el largo de cada columna
		//se da este primer paso para poder calcular el alto maximo de los encabezados
		$yPosIni = $this->GetY();
		$xPosIni = $this->GetX();
		$xPos=$this->GetX();
		$alto = 0;
		$this->SetFillColor(207,207,207);
		$this->SetDrawColor(255,255,255);
		$this->SetLineWidth(0.2);
		for($i=0;$i<$cant;$i++)
		{	
			if ($this->GetY() >= 260)
			{
				$this->AddPage();
				$yPosIni = $this->GetY();
			}
				
			$this->SetXY($xPos,$yPosIni);
			$this->MultiCell($longCols[$i],5,$elsEncabezado[$i],0,"C",1);
			$xPos+=$longCols[$i];
			
			$alto = max($alto,($this->GetY()- $yPosIni));
			
		}
		//ya con el alto se vuelve a pintar para poder dibujar el relleno con un retangulo del tamanio adecuado
		$xPos = $xPosIni;
		
		for($i=0;$i<$cant;$i++)
		{	
			$this->SetXY($xPos,$yPosIni);
			$this->Rect($xPos,$yPosIni,$longCols[$i],$alto,"DF");
			$this->MultiCell($longCols[$i],5,$elsEncabezado[$i],0,"C",0);
			$xPos+=$longCols[$i];
			
			//$alto = max($alto,($this->GetY()- $yPosIni));
			
		}
		$this->SetY($yPosIni+$alto);
		//y luego pinta los elementos
		foreach($els as $el)
		{
			if ($this->GetY() >= 260)
			{
				$this->AddPage();
				
			}
			$xPos = $xPosIni;
			$yPosIni = $this->GetY();
			$alto = 0;
			for($i=0;$i<$cant;$i++)
			{
				$this->SetXY($xPos,$yPosIni);
				$this->MultiCell($longCols[$i],5,$el[$i],0,"L",0);
				$xPos+=$longCols[$i];
				$alto = max($alto,($this->GetY()- $yPosIni));
			}
			$this->SetY($yPosIni+$alto);
		}
		
	}
	
	public function EtiquetaOculta($texto)
	{}
	
	public function Tabla1Col($texto)
	{
		$this->SetFont('Arial','',10);
		$this->SetTextColor(0,0,0);
		$this->MultiCell(0,5,$texto);
	}
	
	public function Fin()
	{
		$this->Output();
		
		
	}
	
	
}

class ReporteHtml implements IReporte
{
	public function EncabezadoAzul($texto)
	{
		echo '
		<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr bgcolor="#FFFFFF"> 
          <td class="renglonazul"><strong>'.$texto.'</strong></td>
        </tr>
      </table>';
	}
	
	public function Titulo($texto)
	{
		echo '<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr bgcolor="#FFFFFF"> 
          <td width="20%" class="tituloazul24"><img src="imagenes/unam2.gif" width="64" height="70" hspace="10" align="absmiddle"></td>
          <td width="60%" align="center"  class="tituloazul24">'.$texto.'</td>
          <td width="20%"><img src="imagenes/fquim2.gif" width="214" height="54"></td>
        </tr>
      </table>';
 
	}
	
	public function EncabezadoAmarillo($texto)
	{
		echo '
		<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr bgcolor="#FFFFFF"> 
          <td class="rengloamarillo"><strong>'.$texto.'</strong></td>
        </tr>
     	</table>';
	}
	
	public function EncabezadoGris($texto)
	{
		echo '
		<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr bgcolor="#FFFFFF"> 
          <td class="renglogris1"><strong>'.$texto.'</strong></td>
        </tr>
     	</table>';
	}
	
	
	
	
	public function EncabezadoNaranja($texto)
	{
		echo '
		<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr bgcolor="#FFFFFF"> 
          <td class="renglonaranja"><strong>'.$texto.'</strong></td>
        </tr>
     	</table>';
	}
	
	public function EncabezadoAmarilloPeque($texto)
	{
		echo '
		<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr bgcolor="#ffffd9"> 
          <td height="10">'.$texto.'</td>
        </tr>
     	</table>';
	}
	
	public function Salto()
	{
		echo "<br>";
	}
	
	public function TablaSencilla($els)
	{
		echo '<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">';
		foreach($els as $el)
		{
			echo '<tr>
			 		<td width="22%" class="txtgris11"><strong>'.$el[0].'</strong></td>
                  	<td width="78%">'.$el[1].'</td>
                  <tr>';
			
		}
		echo '</table>';
	}
	
	//Sin bod y mas pequeña la letra, igual q tabla compuesta
	public function TablaSimple($els,$enfatizado="")
	{
		echo '<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">';
		foreach($els as $el)
		{
			echo '<tr>
			 		<td width="22%" class="txtgris10">'.$el[0].'</td>
                  	<td width="78%" class="txtgris10">'.$el[1].'</td>
                  <tr>';
			
		}
		echo '</table>';
	}
	
	
	public function TablaCompuesta($dimensiones,$elsEncabezado,$els)
	{
		echo '	
			<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
              <tr valign="top">';
		$cant = sizeof($dimensiones);
		//Imprime los encabezados
		for($i=0;$i<$cant;$i++)
		{
			echo '<td width="'.$dimensiones[$i].'%" class="renglogris1"><strong>'.$elsEncabezado[$i].'</strong></td>';
		}
        echo '</tr>';
        //Imprime el contenido de la tabla
        foreach($els as $el)
        { 
        	echo '<tr valign="top">';
        	//el primer el. se pinta un poco diferente
        	//echo '<td class="ligagrisch"><strong>'.$el[0].'</strong></td>'; 
        	echo '<td class="txtgris10">'.$el[0].'</td>';
        	for($j=1;$j<$cant;$j++)
        	{
        		echo '<td class="txtgris10">'.$el[$j].'</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
        //y una linea al final
        echo '<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
          	 <tr valign="top"> 
                <td class="txtgris10"><img src="imagenes/lineagrisv.gif" width="100%" height="1" vspace="5"></td>
              </tr>
            </table>';
	}
	
	//La unica diferencia q TablaCompuesta es q no pinta en bold el primer elemento
	public function TablaCompuestaNormal($dimensiones,$elsEncabezado,$els)
	{
		echo '	
			<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
              <tr valign="top">';
		$cant = sizeof($dimensiones);
		//Imprime los encabezados
		for($i=0;$i<$cant;$i++)
		{
			echo '<td width="'.$dimensiones[$i].'%" class="renglogris1">'.$elsEncabezado[$i].'</td>';
		}
        echo '</tr>';
        //Imprime el contenido de la tabla
        foreach($els as $el)
        { 
        	echo '<tr valign="top">';
        	//el primer el. se pinta un poco diferente
        	echo '<td class="txtgris10">'.$el[0].'</td>'; 
        	for($j=1;$j<$cant;$j++)
        	{
        		echo '<td class="txtgris10">'.$el[$j].'</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
        //y una linea al final
        echo '<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
          	 <tr valign="top"> 
                <td class="txtgris10"><img src="imagenes/lineagrisv.gif" width="100%" height="1" vspace="5"></td>
              </tr>
            </table>';
	}
	
	public function Inicio()
	{}
	
	public function EtiquetaOculta($texto)
	{
		echo $texto;
	}
	
	public function Tabla1Col($texto)
	{
		echo '
		<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr> 
          <td  class="backgris"><div>'.nl2br($texto).'</div>
          </td>
        </tr>
        
      </table>';
	}

	public function Fin()
	{}
}

class ReporteWord extends ReporteHtml implements IReporte
{
	private $salto =  "<br>";
	
	public function Titulo($texto)
	{
		/*
		echo '<table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr bgcolor="#FFFFFF"> 
          <td width="60%" class="tituloazul24">'.$texto.' 
            </td>
          <td width="40%"></td>
        </tr>
      </table>';
 	*/
		
		echo $texto.$this->salto;
	}
	
	public function EncabezadoAzul($texto)
	{
		echo "<b>".$texto."</b>".$this->salto;
	}
	
	
	
	public function TablaSencilla($els)
	{
		
		foreach($els as $el)
		{
			echo $el[0].":".$el[1].$this->salto;
			
		}
		
	}
	
	public function TablaSimple($els)
	{
		
		foreach($els as $el)
		{
			echo $el[0].":".$el[1].$this->salto;
			
		}
		
	}
	
	
	public function TablaCompuesta($dimensiones,$elsEncabezado,$els)
	{
		
		$cant = sizeof($dimensiones);
		foreach($els as $el)
        { 
        	
        	//echo $el[0]; 
        	for($j=0;$j<$cant;$j++)
        	{
        		echo $elsEncabezado[$j].":".$el[$j].$this->salto;
            }
            
        }
        
	}
	
	//La unica diferencia q TablaCompuesta es q no pinta en bold el primer elemento
	public function TablaCompuestaNormal($dimensiones,$elsEncabezado,$els)
	{
		$cant = sizeof($dimensiones);
		foreach($els as $el)
        { 
        	
        	//echo $el[0]; 
        	for($j=0;$j<$cant;$j++)
        	{
        		echo $elsEncabezado[$j].":".$el[$j].$this->salto;
            }
            
        }
	}
	
	public function EncabezadoAmarillo($texto)
	{
		echo "<b>".$texto."</b>".$this->salto;
	}
	
	public function EncabezadoGris($texto)
	{
		echo "<b>".$texto."</b>".$this->salto;
	}
	
	public function EncabezadoAmarilloPeque($texto)
	{
		echo "<b>".$texto."</b>".$this->salto;
	}
	
	public function Tabla1Col($texto)
	{
		echo nl2br($texto).$this->salto;
	}
	
	
	
	
	
}

class ReporteCsv implements IReporte
{
	private $salto =  "\n";
	
	public function EncabezadoAzul($texto)
	{
		echo '"'.$texto.'"'.$this->salto;
	}
	
	public function Titulo($texto)
	{
		echo '"'.$texto.'"'.$this->salto;;
 
	}
	
	public function EncabezadoAmarillo($texto)
	{
		echo '"'.$texto.'"'.$this->salto;;
	}
	
	public function EncabezadoGris($texto)
	{
		echo '"'.$texto.'"'.$this->salto;;
	}
	
	public function EncabezadoNarranja($texto)
	{
		echo '"'.$texto.'"'.$this->salto;;
	}
	
	public function EncabezadoAmarilloPeque($texto)
	{
		echo '"'.$texto.'"'.$this->salto;;
	}
	
	public function Salto()
	{
		echo $this->salto;
	}
	
	public function TablaSencilla($els)
	{
		foreach($els as $el)
		{
			echo '"'.$el[0].'","'.$el[1].'"'.$this->salto;
		}
	}
	
	public function TablaSimple($els)
	{
		foreach($els as $el)
		{
			echo '"'.$el[0].'","'.$el[1].'"'.$this->salto;
		}
	}
	
	public function TablaCompuesta($dimensiones,$elsEncabezado,$els)
	{
		
		$cant = sizeof($dimensiones);
		//Imprime los encabezados
		$coma = "";
		for($i=0;$i<$cant;$i++)
		{
			echo $coma.'"'.$elsEncabezado[$i].'"';
			$coma = ",";
		}
		
        echo $this->salto;
        //Imprime el contenido de la tabla
        foreach($els as $el)
        { 
        	
        	echo '"'.$el[0].'",';
        	 
        	for($j=1;$j<$cant;$j++)
        	{
        		echo '"'.$el[$j].'",';
            }
            echo $this->salto;
        }
        echo $this->salto;
        //y una linea al final
        echo $this->salto;
	}
	
	//Es = a TablaCompuesta
	public function TablaCompuestaNormal($dimensiones,$elsEncabezado,$els)
	{
		
		$cant = sizeof($dimensiones);
		//Imprime los encabezados
		$coma = "";
		for($i=0;$i<$cant;$i++)
		{
			echo $coma.'"'.$elsEncabezado[$i].'"';
			$coma = ",";
		}
		
        echo $this->salto;
        //Imprime el contenido de la tabla
        foreach($els as $el)
        { 
        	
        	echo '"'.$el[0].'",';
        	 
        	for($j=1;$j<$cant;$j++)
        	{
        		echo '"'.$el[$j].'",';
            }
            echo $this->salto;
        }
        echo $this->salto;
        //y una linea al final
        echo $this->salto;
	}
	
	public function Inicio()
	{}
	
	public function EtiquetaOculta($texto)
	{
		//echo $texto;
	}
	
	public function Tabla1Col($texto)
	{
		echo nl2br($texto).$this->salto;
	}

	public function Fin()
	{}
}
?>