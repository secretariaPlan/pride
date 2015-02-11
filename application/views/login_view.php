<?php
//Solicita los datos para accesar al sistema
//Javier Alpizar, 15 Feb 08
//Puede recibir un parametro error :0 datos equivocados
//									1 falta iniciar sesion

header("Content-Type:text/html; charset=iso-8859-1");

$errorMsg = array("Su clave o contraseña no son válidos, por favor verifique",
					 "Por favor inicie su sesión ingresando usuario y contraseña");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<?php $this->load->view("includes/head");?>
<script type="text/javascript" src="<?= base_url();?>templates/sha1.js"></script>
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
<link href="<?php echo base_url();?>style.css" rel="stylesheet" type="text/css">
<body>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="15%" rowspan="2" valign="top"><img src="<?= base_url();?>imagenes/logo.gif" width="189" height="96"> 
    </td>
    <td height="60" valign="top"> 
      <?php $this->load->view("includes/top1");?>
    </td>
  </tr>
  <tr> 
    <td width="90%" valign="top" class="cuadrogris"> 
      <table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr> 
          <td width="64%" class="tituloama30"><div align="center"> 
              <p class="tituloazul24">Sistema de Primas al Desempeño 
                <br>
                del Personal Acad&eacute;mico de Tiempo Completo</p>
            </div></td>
        </tr>
        <tr> 
          <td class="renglonazul"><div align="center">Ingrese su usuario y contrase&ntilde;a 
              para entrar al PRIDE</div>
              
              <div align="center"  style="background-color:#FF0000;"><?php if(isset($mensaje)): ?>
	<h2><?php echo  $mensaje;?></h2>
	<?php endif;?></div>
              </td>
        </tr>
        <tr> 
          <td class="backgris">
          	<? if(isset($_REQUEST["error"])) 
          	{ 
          		$errorNum = $_REQUEST["error"];
          		if(!ctype_digit($errorNum))
          			$errorNum=0;
          		else
          		{
          			if ($errorNum < 0 or $errorNum >= count($errorMsg))
          				$errorNum=0;
          		}
          	?>
          		<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
              	<tr>
                	<td width="2%" class="renglorojo"><img src="<?php echo base_url();?>imagenes/error.gif" width="30" height="30" align="absmiddle"></td>
                	<td width="98%" class="renglorojo" align="center"> <? echo $errorMsg[$errorNum]; ?> </td>
              	</tr>
            	</table>
            	<br>
            <? } ?>
            <form name="form1" action="<?= base_url().'login/very_sesion'?>" method="post">
              <table width="90%" border="0" align="center" cellpadding="3" cellspacing="2">
                <tr> 
                  <td width="20%"><strong>Tipo:</strong></td>
                  <td width="30%" > 
                  <!--
                  <select name="tipo">
<?php
/*foreach ($arrTipo as $i => $tipo)
   echo '<option values="',$tipo,'">',$tipo,'</option>';*/
?>
</select>-->
</td>
                  <td width="50%" class="ligarojo11">Ej. Evaluado / Profesor</td>
                </tr>
                <tr> 
                  <td width="20%"><strong>Usuario:</strong></td>
                  <td width="30%" > <input type="text" name="rfc" value="<?= @set_value('rfc')?>"></input></td>
                  <td width="50%" class="ligarojo11">Ej. RFC. CADM7611125D8</td>
                </tr>
                <tr> 
                  <td><strong>Contrase&ntilde;a:</strong></td>
                  <td><input type="password" name="password" value="<?= @set_value('password')?>"></td>
                  <td class="ligarojo11"> <a href="#">Olvid&eacute; mi 
                    contrase&ntilde;a &raquo;</a>&nbsp;&nbsp;&nbsp; <a href="#">Cambiar contraseña &raquo;</a> <br><a href="contacto_off.php">Contacto &raquo;</a></td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td><div align="center"> 
                      <input type="submit" value="Entrar" name="submit">
                    </div></td>
                  <td>&nbsp;</td>
                </tr>
              </table>
            </form> </td>
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
<?php $this->load->view("includes/footer");?>
</body>
</html>








