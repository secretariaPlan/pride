<?php
//Solicita los datos para accesar al sistema
//Javier Alpizar, 15 Feb 08
//Puede recibir un parametro error 

header("Content-Type:text/html; charset=iso-8859-1");  //este encabezado sirve para q las funciones de aajx q traen acentos
			//funcionen bien, auque el header de la pagina html lo traia al parecer es necesario tambien desde php

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><head>
<?php $this->load->view("admin/templates/head");?>
<script type="text/javascript" src="<?php echo base_url(); ?>templates/sha1.js"></script>
<script language="JavaScript">
<!--
function getlog()
		{

    	   	var usuario = document.form1.usuarioText.value;
	    	var pwd = document.form1.pwdText.value;
			
			pwd = pwd.toLowerCase();
			
			
			ipwd = hex_sha1(pwd);
			window.location = "LoginCtrl.php?usuario="+usuario+"&pwd="+ipwd;
			
		}

//-->
</script>
</head><?php echo link_tag('templates/admin/style.css');?><body><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">  <tr>     <td width="15%" rowspan="2" valign="top"><img src="<?php echo base_url("templates/admin");?>/imagenes/logo.gif" width="189" height="96">     </td>    <td height="60" valign="top">      <?php $this->load->view("admin/templates/top1");?>    </td>  </tr>  <tr>     <td width="90%" valign="top" class="cuadrogris">       <table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">        <tr>           <td width="64%" class="tituloama30"><div align="center">               <p class="tituloazul24">Sistema de Primas al Desempeño 
                <br>
                del Personal Académico de Tiempo Completo</p>            </div></td>        </tr>        <tr>           <td class="renglonazul"><div align="center">Ingrese su usuario y contrase&ntilde;a               para entrar a PRIDE</div></td>        </tr>        <tr>           <td class="backgris">
          
       
          
          
          	<?php if(isset($mensaje)): ?>
          	
          	<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
              	<tbody><tr>
                	<td width="2%" class="renglorojo"><img src="<?php echo base_url("templates/admin");?>/imagenes/error.gif" width="30" height="30" align="absmiddle"></td>
                	<td width="98%" class="renglorojo" align="center"><?php echo  $mensaje;?> </td>
              	</tr>
            	</tbody></table>
          	
          	
     
     <?php endif;?>
     
                 <form name="form1" method="POST" ACTION="<?php echo base_url().'admin/login/very_sesion'?>">              <table width="70%" border="0" align="center" cellpadding="3" cellspacing="2">                <tr>                   <td width="27%"><strong>Usuario:</strong></td>                  <td width="38%" > <input type="text" name="rfc" value="<?= @set_value('rfc')?>"></input></td>                  <td width="35%" class="ligarojo11"></td>                </tr>                <tr>                   <td><strong>Contrase&ntilde;a:</strong></td>                  <td><input type="password" name="password" value="<?= @set_value('password')?>"></td>                  <td class="ligarojo11"> </td>                </tr>                <tr>                   <td>&nbsp;</td>                  <td><div align="center">                       <input type="submit" name="submit" value="Entrar al PRIDE">                    </div></td>                  <td>&nbsp;</td>                </tr>              </table>            </form> </td>        </tr>      </table>       <br></td>  </tr></table>
<?php $this->load->view("admin/templates/footer");?></body></html>