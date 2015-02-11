<?php
//Pantalla de inicio
//Javier Alpizar, 16 Feb 07
//x=1
include_once("SessionOk.php");
include_once("lib/AvisosDALC.php");
include_once("phplib/Fechas.inc.php");

$avisos = AvisosDALC::ObtenAvisos($_SESSION["profesorId"],0,4);
//$avisosGenerales = AvisosDALC::Generales(2);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head><?php include 'templates/head.php'; ?>
</head><link href="style.css" rel="stylesheet" type="text/css"><body><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">  <tr>     <td width="15%" rowspan="2" valign="top">       <?php include 'templates/menu.php'; ?>    </td>    <td height="60" valign="top">       <?php include 'templates/top.php'; ?>    </td>  </tr>  <tr>     <td width="90%" valign="top" class="cuadrogris">      <?php include 'templates/usuario.php'; ?>      <table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">        <tr>           <td class="tituloama30">Avisos</td>          <td>&nbsp;</td>        </tr>
      </table>
      <table width="95%" border="0" align="center" >          <tr> 
        	<td width="64%" valign="top">
        		<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
        			<?
        			//imprime los avisos personales
        			$lineaGris = "";
        			foreach($avisos as $aviso)
        			{
        				$resumen = $aviso->Contenido; //ObtenResumen($aviso->Contenido);
        				echo $lineaGris;
        				echo "<tr>
        						<td valign='top' class='backgris'><span class='txtrojo11'>Aviso</span>
        							<span class='txtcafe11'>- ".Fechas::FechaEspLarga($aviso->Fecha)."</span><br> 
        							<span class='ligaazul14'><a href='AvisoGUIProfesor.php?id=".$aviso->Id."'>".$aviso->Titulo."</a></span><br>".
        							$resumen.
        						"</td>
        					  </tr>";
        				$lineaGris = '<tr> 
          								<td valign="top" class="lineagrish"><img src="imagenes/lineagrisv.gif" width="100%" height="1" vspace="5"></td>
        						  </tr>';
        				
        			}
        			
        			 ?>
        			
            	</table>
            </td>	          	<td width="36%" valign="top"> 
          		<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">              <tr>                 <td class="renglonazul">Reportes</td>              </tr>              <tr>                 <td class="backgris"><a href="reportes.php"><img src="imagenes/reportes.gif" width="43" height="50" hspace="5" border="0" align="left"></a><span class="ligamama14"><a href="reportes.php">Generaci&oacute;n                   de reportes</a></span><br>                  Seleccione el reporte que desea obtener de la lista.</td>              </tr>              <tr>                 <td>&nbsp;</td>              </tr>              <tr>                 <td class="renglonazul">Directorio</td>              </tr>              <tr>                 <td class="backgris"><a href="directorio.php"><img src="imagenes/directorio.gif" width="41" height="40" hspace="5" border="0" align="left"></a><span class="ligamama14"><a href="directorio.php">Directorio                   de Profesores</a></span><br>                  Consulte el directorio de la<br>                  Facultad.</td>              </tr>              <tr>                 <td>&nbsp;</td>              </tr>              <tr>                 <td class="renglonazul">Contacto</td>              </tr>              <tr>                 <td class="backgris"><a href="contacto.php"><img src="imagenes/contacto.gif" width="38" height="39" hspace="5" border="0" align="left"></a><span class="ligamama14"><a href="contacto.php">Cont&aacute;ctenos</a></span><br>                  Env&iacute;e sus dudas, comentarios<br>                  o sugerencias.</td>              </tr>              <tr>                 <td>&nbsp;</td>              </tr>
              <!--                <tr>                 <td class="renglonazul">Soporte t&eacute;cnico</td>              </tr>              <tr>                 <td class="backgris"><a href="soporte.php"><img src="imagenes/soporte.gif" width="44" height="44" hspace="5" border="0" align="left"></a><span class="ligamama14"><a href="soporte.php">Soporte                   de ayuda </a></span><br>                  Resuelva sus dudas acerca<br>                  del sistema &oacute; reporte errores</td>              </tr>
              -->            </table></td>        </tr>                      </table>       <br></td>  </tr></table><?php include 'templates/footer.php'; 

//Para obtener 50 palabras o las disponibles menores
function obtenResumen($resumen)
{
	$arr = explode(" ",$resumen);
	$palabras = min(50,count($arr));
	$resNuevo = array_slice($arr,0,$palabras);
	$resumen = implode($resNuevo," ");
	return $resumen;
}
?></body></html>