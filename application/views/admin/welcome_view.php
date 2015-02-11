<?php
//Pantalla de inicio
//Javier Alpizar, 16 Feb 07
//
include_once("nivelProfesor.php");
include_once("SessionOk.php");
include_once("niveles.php");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<?php include 'templates/head.php'; ?>
<link href="style.css" rel="stylesheet" type="text/css">
<body>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="15%" rowspan="2" valign="top"> 
      <?php include 'templates/menu.php'; ?>
    </td>
    <td height="60" valign="top"> 
      <?php include 'templates/top.php'; ?>
    </td>
  </tr>
  <tr> 
    <td width="90%" valign="top" class="cuadrogris"> 
      <?php include 'templates/usuario.php'; ?>
      <br>
      <table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr> 
          <? if ($_SESSION["usuarioNivel"] <= NIVEL_ADMIN)
  			{
  		  ?>
          <td valign="top"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td class="backgris"><a href="UsuarioGUI.php"><img src="imagenes/directorio.gif" width="41" height="40" hspace="5" border="0" align="left"></a><span class="ligamama14"><a href="UsuarioGUI.php">Administrador 
                  de Usuarios</a></span><br>
                  Alta baja y modificaci&oacute;n de usuarios SICPA <br> <span class="txtgris10">(Profesores, 
                  Jefes de departamento y administradores)</span></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td class="backgris"><a href="ImportacionCaeGUI.php"><img src="imagenes/inportacion.gif" width="41" height="40" hspace="5" border="0" align="left"></a><span class="ligamama14"><a href="ImportacionCaeGUI.php"> 
                  Importaci&oacute;n de datos</a></span><br>
                  Importaci&oacute;n de datos de SIP y CAE</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td class="backgris"><a href="FaqGUI.php"><img src="imagenes/faq.gif" width="41" height="40" hspace="5" border="0" align="left"></a><span class="ligamama14"><a href="FaqGUI.php"> 
                  Preguntas frecuentes</a></span><br>
                  Alta baja y modificaci&oacute;ns de las preguntas frecuentes 
                  del uso del sistema SICPA</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td class="backgris"><a href="estadisticas.php"><img src="imagenes/stats.gif" width="41" height="40" hspace="5" border="0" align="left"></a><span class="ligamama14"><a href="estadisticas.php"> 
                  Estad&iacute;sticas</a></span><br>
                  Estad&iacute;sticas del SICPA</td>
              </tr>
            </table></td>
          <? } ?>
          <td valign="top">
           <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td class="backgris"><a href="reportes.php"><img src="imagenes/reportes.gif" width="43" height="50" hspace="5" border="0" align="left"></a><span class="ligamama14"><a href="reportes.php">Generaci&oacute;n 
                  de reportes</a></span><br>
                  Sistema de generaci&oacute;n de reportes</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <? if ($_SESSION["usuarioNivel"] <= NIVEL_ADMIN)
  			  {
  		  	  ?>
              <tr> 
                <td class="backgris"><a href="CatalogoGUI.php"><img src="imagenes/catalogos.gif" width="41" height="40" hspace="5" border="0" align="left"></a><span class="ligamama14"><a href="CatalogoGUI.php"> 
                  Cat&aacute;logos</a></span><br>
                  Modificaci&oacute;n de cat&aacute;logos</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td class="backgris"><a href="AvisoGUI.php"><img src="imagenes/contacto.gif" width="38" height="39" hspace="5" border="0" align="left"></a><span class="ligamama14"> 
                  <a href="AvisoGUI.php">Avisos</a></span><br>
                  Alta baja y modificaci&oacute;n de avisos para los usuarios 
                  del SICPA</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td class="backgris"><a href="ContactoGUI.php"><img src="imagenes/soporte.gif" width="44" height="44" hspace="5" border="0" align="left"></a><span class="ligamama14"><a href="ContactoGUI.php"> 
                  Soporte t&eacute;cnico y contacto</a></span><br>
                  Solicitudes de soporte t&eacute;cnico y contacto de usuarios 
                  del SICPA</td>
              </tr>
              <? } ?>
            </table></td>
        </tr>
      </table> 
      <p><br>
      </p>
      <p>&nbsp;</p></td>
  </tr>
</table>
<?php include 'templates/footer.php'; ?>
</body>
</html>
