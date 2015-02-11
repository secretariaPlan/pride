<?php
include_once("niveles.php");
?>
<link href="../style.css" rel="stylesheet" type="text/css"> 
<table border="0" cellpadding="0" cellspacing="0" background="imagenes/backgris.gif">
  <tr> 
    <td width="196" colspan="2"><a href="welcome.php"><img src="imagenes/logo.gif" width="189" height="96" border="0"></a></td>
  </tr>
  <tr> 
    <td colspan="2"><div align="center"><img src="imagenes/lineagrisv.gif" width="90%" height="1" vspace="5"></div></td>
  </tr>
  <?  
  if ($_SESSION["usuarioNivel"] <= NIVEL_ADMIN)
  {
  ?>
  <tr> 
    <td colspan="2" class="ligamenuleft1"><strong><img src="imagenes/iconos/usuarios.gif" width="13" height="15"> 
      <a href="UsuarioGUI.php">Administrador de Usuarios</a></strong></td>
  </tr>
  
  <tr> 
    <td colspan="2" class="ligamenuleft1"><strong><img src="imagenes/iconos/importar.gif" width="13" height="15"> 
      <a href="ImportacionCaeGUI.php">Importaci&oacute;n de datos</a></strong></td>
  </tr>
  <tr> 
    
    <td class="ligamenuleft">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8226; <a href="ImportacionSipGUI.php">SIP</a></td>
  </tr>
  <tr> 
    
    <td class="ligamenuleft">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8226; <a href="ImportacionCaeGUI.php">CAE - Cursos</a></td>
  </tr>
  <tr> 
    
    <td class="ligamenuleft">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8226; <a href="ImportacionCaeTitulacionGUI.php">CAE - Titulaci&oacute;n y Examenes</a></td>
  </tr>
  
 
  <tr> 
    
    <td class="ligamenuleft">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8226; <a href="ImportacionDgapaGUI.php">DGAPA</a></td>
  </tr>
   <tr> 
    
    <td class="ligamenuleft">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8226; <a href="ImportacionCaeAsignaturas.php">Asignaturas</a></td>
  </tr>
  <tr> 
    
    <td class="ligamenuleft">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8226; <a href="ImportacionCaeAlumnos.php">Alumnos</a></td>
  </tr>
   <tr> 
    
    <td class="ligamenuleft">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#8226; <a href="ImportacionProgFqGUI.php">Programas de la facultad</a></td>
  </tr>
  <tr> 
      <td colspan="2" class="ligamenuleft1"><strong><img src="imagenes/iconos/catalogos.gif" width="13" height="15"> 
      <a href="CatalogoGUI.php">Cat&aacute;logos</a></strong></td>
  </tr>
  <tr> 
    <td colspan="2" class="ligamenuleft1"><strong><img src="imagenes/iconos/avisos.gif" width="13" height="15"> 
      <a href="AvisoGUI.php">Avisos</a></strong></td>
  </tr>
  <tr> 
    <td colspan="2" class="ligamenuleft1"><strong><img src="imagenes/iconos/faq.gif" width="13" height="15"> 
      <a href="FaqGUI.php">Preguntas frecuentes</a></strong></td>
  </tr>
  <tr>
    <td  class="ligamenuleft1"><strong><img src="imagenes/iconos/soporte.gif" width="13" height="15"> <a href="ProfesorGUI.php">Profesores</a></strong></td> 
  </tr>
  <tr>
    <td  class="ligamenuleft1"><strong><img src="imagenes/iconos/contacto.gif" width="13" height="14"> <a href="ContactoGUI.php">Contacto</a></strong></td>
  </tr>
  <tr> 
    <td colspan="2" class="ligamenuleft1"><strong><img src="imagenes/iconos/estadisticas.gif" width="13" height="15"> 
      <a href="estadisticas.php">Estad&iacute;sticas</a></strong></td>
  </tr>
  <?
  } 
  ?>
  <tr> 
    <td colspan="2" class="ligamenuleft1"><strong><img src="imagenes/iconos/reportes.gif" width="13" height="15"> 
      <a href="reportes.php">Reportes</a></strong></td>
  </tr>
  <tr> 
    <td colspan="2"><strong><img src="imagenes/botgris.gif" width="189" height="4"></strong></td>
  </tr>
</table>
