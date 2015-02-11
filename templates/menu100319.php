<?
//la var menu debe traer el numero de menu que correponde desplegar, si no viene asume 0 que el script interpreta
//q no debe desplegar ninguno
if (!isset($menuId))
	$menuId = 0;

?>
<link href="../style.css" rel="stylesheet" type="text/css"> <table border="0" cellpadding="0" cellspacing="0" background="imagenes/backgris.gif">  <tr>     <td width="196" colspan="2"><a href="welcome.php"><img src="imagenes/logo.gif" width="189" height="96" border="0"></a></td>  </tr>  <tr>     <td colspan="2">
    	<form name="buscar" method="post" action="buscar.php">
         <div align="center"> 
           <input name="texto" type="text" size="12">
           <input type="submit" name="Submit" value="Buscar">
         </div>
        </form>
    </td>  </tr>  <tr>     <td colspan="2"><div align="center"><img src="imagenes/lineagrisv.gif" width="90%" height="1" vspace="5"></div></td>  </tr>
  <tr>     <td colspan="2" class="ligamenuleft1"><strong><img src="imagenes/iconos/perfil.gif" width="13" height="14">       <a href="#" onclick="MuestraMenus(1)">Perfil Acad&eacute;mico</a></strong>
    <div id="menu1">
    <table border="0" cellpadding="0" cellspacing="0" >
  	<tr> 
  		<td>&nbsp;</td>
    	<td class="ligamenuleft">&#8226; <a href="datos_personales.php">Datos personales</a></td>
  	</tr>
  	<tr> 
    	<td>&nbsp;</td>
    	<td class="ligamenuleft">&#8226; <a href="resumen.php">Resumen profesional</a></td>
  	</tr>
  	<tr> 
    	<td>&nbsp;</td>
    	<td class="ligamenuleft">&#8226; <a href="datos_contractuales.php">Datos contractuales</a></td>
  	</tr>
  	<tr> 
    	<td>&nbsp;</td>
    	<td class="ligamenuleft"> &#8226; <a href="formacion_academica.php">Formaci&oacute;n 
      	y superaci&oacute;n acad&eacute;mica</a></td>
  	</tr>
  	<tr> 
    	<td>&nbsp;</td>
    	<td class="ligamenuleft"> &#8226; <a href="premios.php">Premios y distinciones</a></td>
  	</tr>
  	<tr> 
    	<td>&nbsp;</td>
    	<td class="ligamenuleft">&#8226; <a href="programas_estimulos.php">Programas 
      	de apoyo</a></td>
  	</tr>
  	<tr> 
    	<td>&nbsp;</td>
    	<td class="ligamenuleft">&#8226; <a href="asociaciones.php">Asociaciones 
      	acad&eacute;micas y profesionales</a></td>
  	</tr>
  	</table>
  	</div>
    
    </td>  </tr>
    <tr>     <td colspan="2" class="ligamenuleft1"><strong><img src="imagenes/iconos/participa.gif" width="13" height="14">       <a href="#" onclick="MuestraMenus(2)">Participaci&oacute;n Institucional</a></strong>
      <div id="menu2">
    	<table border="0" cellpadding="0" cellspacing="0" >
    	<tr> 
    		<td >&nbsp;</td>
    		<td  class="ligamenuleft">&#8226; <a href="organos_colegiados.php">&Oacute;rganos 
      		colegiados</a></td>
  		</tr>
  		<tr> 
    		<td>&nbsp;</td>
    		<td class="ligamenuleft">&#8226; <a href="cargos_academicos.php">Cargos acad&eacute;mico 
      		administrativos</a></td>
  		</tr>
  		<tr> 
    		<td>&nbsp;</td>
    		<td class="ligamenuleft">&#8226; <a href="organos_asesores.php">&Oacute;rganos 
      		asesores</a></td>
  		</tr>
  		<tr> 
    		<td>&nbsp;</td>
    		<td class="ligamenuleft">&#8226; <a href="comisiones_evalua.php">Comisiones 
      		evaluadoras</a> </td>
  		</tr>
  		<tr> 
    		<td>&nbsp;</td>
    		<td class="ligamenuleft">&#8226; <a href="tutorias.php">Programas de tutor&iacute;as</a></td>
  		</tr>
  		<tr> 
    		<td>&nbsp;</td>
    		<td class="ligamenuleft">&#8226; <a href="arbitrajes.php">Arbitrajes</a></td>
  		</tr>
  		<tr> 
    		<td>&nbsp;</td>
    		<td class="ligamenuleft">&#8226; <a href="comisiones_especiales.php">Comisiones 
      		especiales</a> </td>
  		</tr>
  		<tr> 
    		<td>&nbsp;</td>
    		<td class="ligamenuleft">&#8226; <a href="apoyo_academico.php">Apoyo acad&eacute;mico</a></td>
  		</tr>
    	</table>
      </div>
    </td>	  </tr>  <tr>    <td colspan="2" class="ligamenuleft1"><strong><img src="imagenes/iconos/docencia.gif" width="13" height="15">       <a href="#" onclick="MuestraMenus(3)">Docencia</a></strong>
      <div id="menu3">
    	<table border="0" cellpadding="0" cellspacing="0" >
    	<tr> 
    		<td>&nbsp;</td>
    		<td width="178" class="ligamenuleft">&#8226; <a href="cursos.php">Cursos</a></td>
  		</tr>
  		<tr> 
    		<td>&nbsp;</td>
    		<td class="ligamenuleft"> &#8226; <a href="apoyo_titulacion.php">Apoyo a la 
      		titulaci&oacute;n</a></td>
  		</tr>
  		<tr> 
    	<td>&nbsp;</td>
    		<td class="ligamenuleft">&#8226; <a href="asesorias.php">Asesor&iacute;as</a></td>
  		</tr>
  		<tr> 
    		<td>&nbsp;</td>
    		<td class="ligamenuleft"> &#8226; <a href="material_apoyo.php">Dise&ntilde;o 
      		de material didáctico</a></td>
  		</tr>
    	</table>
      </div>
    </td>  </tr>  <tr>     <td colspan="2" class="ligamenuleft1"><strong><img src="imagenes/iconos/investiga.gif" width="13" height="14">       <a href="#" onclick="MuestraMenus(4)">Investigaci&oacute;n</a></strong>
      <div id="menu4">
    	<table border="0" cellpadding="0" cellspacing="0" >
    	<tr> 
    		<td >&nbsp;</td>
    		<td class="ligamenuleft">&#8226; <a href="proyectos_investiga.php">Proyectos 
      		de investigaci&oacute;n</a></td>
  		</tr>
  		<tr> 
    		<td>&nbsp;</td>
    		<td class="ligamenuleft"> &#8226; <a href="proyectos_contrato.php">Proyectos 
      		contratados </a></td>
  		</tr>
  		<tr> 
    		<td>&nbsp;</td>
    		<td class="ligamenuleft">&#8226; <a href="productos_investiga.php">Productos 
      		de la investigaci&oacute;n</a></td>
  		</tr>
  		<tr> 
    		<td>&nbsp;</td>
    		<td class="ligamenuleft"> &#8226; <a href="tecnicas_experimenta.php">T&eacute;cnicas 
      		experimentales </a></td>
  		</tr>
  		<tr> 
    		<td>&nbsp;</td>
    		<td class="ligamenuleft"> &#8226; <a href="formacion_investiga.php">Formaci&oacute;n 
      		en la Investigaci&oacute;n</a></td>
  		</tr>
  		<tr> 
    		<td colspan="2">&nbsp;</td>
  		</tr>
	   	</table>
      </div>  
    </td>  </tr>  <tr>     <td colspan="2" class="ligamenuleft1"><strong><img src="imagenes/iconos/difusion.gif" width="14" height="15">       <a href="#" onclick="MuestraMenus(5)">Divulgaci&oacute;n</a></strong>
      <div id="menu5">
    	<table border="0" cellpadding="0" cellspacing="0" >
    	<tr> 
    		<td >&nbsp;</td>
    		<td  class="ligamenuleft"> &#8226; <a href="conferencias.php">Conferencias aisladas</a></td>
  		</tr>
  		<tr> 
    		<td >&nbsp;</td>
    		<td  class="ligamenuleft"> &#8226; <a href="feria.php">Ferias de la Ciencia</a></td>
  		</tr>
  		<tr> 
    		<td>&nbsp;</td>
    		<td class="ligamenuleft"> &#8226; <a href="organiza_actividades.php">Organizaci&oacute;n 
      		de actividades</a></td>
  		</tr>
  		<tr> 
    		<td >&nbsp;</td>
    		<td  class="ligamenuleft"> &#8226; <a href="multimedia.php">Presentaciones multimedia</a></td>
  		</tr>
  		
  		<tr> 
    		<td >&nbsp;</td>
    		<td  class="ligamenuleft"> &#8226; <a href="radiotv.php">Programas de radio y televisión</a></td>
  		</tr>
  		<tr> 
    		<td>&nbsp;</td>
    		<td class="ligamenuleft">&#8226; <a href="publicaciones.php">Publicaciones</a></td>
  		</tr>
  		<tr> 
    		<td>&nbsp;</td>
    		<td class="ligamenuleft"> &#8226; <a href="trabajos_academicos.php">Reuniones académicas colectivas</a></td>
  		</tr>
  		
  		    	</table>
      </div>  
    </td>  </tr>  <tr>     <td colspan="2" class="ligamenuleft1"><strong><img src="imagenes/iconos/apoyos.gif" width="13" height="14">       <a href="servicios.php">Apoyo a Servicios</a></strong></td>  </tr>  <tr>     <td colspan="2" class="ligamenuleft1"><strong><img src="imagenes/iconos/otras.gif" width="15" height="16">       <a href="otras.php">Otras Actividades</a></strong></td>  </tr>  <tr>     <td colspan="2"><strong><img src="imagenes/botgris.gif" width="189" height="4"></strong></td>  </tr>  <tr>     <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>  </tr>  <tr>     <td colspan="2"><strong><img src="imagenes/topgris.gif" width="189" height="4"></strong></td>  </tr>  <tr>     <td colspan="2" class="ligamenuleft1"><strong><img src="imagenes/iconos/correo.gif" width="13" height="9">       <a href="http://www.enlaceestudiantil.unam.mx/correoalumnos/correoalumnos.htm" target="_blank">Consulte       su correo</a></strong></td>  </tr>  <tr>     <td colspan="2"><strong><img src="imagenes/botgris.gif" width="189" height="4"></strong></td>  </tr></table><script type="text/javascript">
 OcultaMenus();
 MuestraMenus(<? echo $menuId; ?>);
 
 function OcultaMenus()
 {
 	for(i=1;i<6;i++)
 	{
 		menu = "menu"+i;
 		obj = document.getElementById(menu);
 		obj.style.display = "none";
 	}
 }
 		
 function MuestraMenus(menuNumero)
 {
	OcultaMenus(); 
	if (menuNumero > 0 && menuNumero < 6)
	{
 		menu = "menu"+menuNumero;
 		obj = document.getElementById(menu);
 		obj.style.display = "block";
 	}
 }
</script>