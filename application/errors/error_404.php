<?php
//Solicita los datos para accesar al sistema
//Depto de Ingenieria
//Puede recibir un parametro error :0 datos equivocados
//									1 falta iniciar sesion

header("Content-Type:text/html; charset=iso-8859-1");

$errorMsg = array("Su clave o contraseña no son válidos, por favor verifique",
					 "Por favor inicie su sesión ingresando usuario y contraseña");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>PRIDE Sistema de Primas al Desempeño del Personal Acad&eacute;mico de Tiempo Completo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="templates/sha1.js"></script>
<script language="JavaScript">
<!--
function getlog()
		{

    	   	var usuario = document.form1.usuarioText.value;
	    	var pwd = document.form1.pwdText.value;
			
			pwd = pwd.toLowerCase();
			
			
			ipwd = hex_sha1(pwd);
			window.location = "LoginCtrl.php?usuario="+usuario+"&pwd="+ipwd+"&tipo=n";
			
		}

//-->
</script>
</head>
<link href="style.css" rel="stylesheet" type="text/css">
<body>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="15%" rowspan="2" valign="top"><img src="imagenes/logo.gif" width="189" height="96"> 
    </td>
    <td height="60" valign="top"> 
      <?php include 'templates/top1.php'; ?>
    </td>
  </tr>
  <tr> 
    <td width="90%" valign="top" class="cuadrogris"> 
      <table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr> 
          <td width="64%" class="tituloama30"><div align="center"> 
              <p class="tituloazul24">ERROR 404</p>
            </div></td>
        </tr>
        <tr> 
          <td class="renglonazul"><div align="center">Sitio no Encontrado</div></td>
        </tr>
   
      </table> 
      <br></td>
  </tr>
</table>
<script type="text/javascript">
//Para revisar q los datos obligatorios este capturados
function RevisaDatos()
{
	//alert("hola");
	if (document.form1.usuarioText.value.length < 13)
	{
		alert("La clave de usuario esta incompleta");
		return false;
	}
	if (document.form1.pwdText.value.length < 1)
	{
		alert("La contraseña esta incompleta");
		return false;
	}
	return true;
}
	
    		
</script>

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td><div align="right">
        <p class="txtgris10">Hecho en M&eacute;xico &copy;Todos los derechos reservados 
          UNAM 2015<br>
          Sistema de Primas al Desempe&ntilde;o del Personal Acad&eacute;mico de Tiempo Completo</p>
      </div></td>
  </tr>
</table>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-305606-32");
pageTracker._trackPageview();
</script>
</body>
</html>