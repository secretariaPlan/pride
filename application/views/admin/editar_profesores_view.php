<?php
//El GUi de mant a usuarios
//Javier Alpizar, 2 Abr 08 08

//include_once("nivelAdmin.php");
//include_once("SessionOk.php");

//include_once("lib/UsuarioDALC.php");
//$usuarios = UsuarioDALC::ObtenUsuarios();
header("Content-Type:text/html; charset=iso-8859-1");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>



<script type="text/javascript">
    $(document).ready(function() {
        $('#sample-table-2').dataTable({                              
          "oLanguage": {
          "sProcessing": "Aguarde enquanto os dados são carregados ...",
          "sLengthMenu": "Mostrar _MENU_ registros por pagina",
          "sZeroRecords": "Nenhum registro correspondente ao criterio encontrado",
          "sInfoEmtpy": "Exibindo 0 a 0 de 0 registros",
          "sInfo": "Exibindo de _START_ a _END_ de _TOTAL_ registros",
          "sInfoFiltered": "",
          "sSearch": "Pesquisar",
         "oPaginate": {
           "sFirst":    "Primeiro",
           "sPrevious": "Anterior",
           "sNext":     "Próximo",
           "sLast":     "Último"
          }
       }                              
    });   
   });
  
</script>
<script type="text/javascript">
    function excluir(id, linha) {
     var url = "<?php echo base_url().'aluno/excluir/' ?>";
        if (confirm("Deseja excluir esse aluno definitivamente?")) {
            $.post(url+ id).done(function() {
                var objLinha = $("#linha" + linha);
                objLinha.hide({
                    effect: "fade",
                    complete: function() {
                        oTable1.fnDeleteRow(oTable1.fnGetPosition(this));
                    }
                });
            }).fail(function() {
                $(".page-content:eq(0)").prepend('<div class="alert alert-danger">Ocorreu um erro.</div>');
            });
        }
        return false;
    }
</script>

<?php $this->load->view("admin/templates/head");?>
</head>
<link href="style.css" rel="stylesheet" type="text/css">

<body>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="15%" rowspan="2" valign="top"> 
      <?php $this->load->view("admin/templates/menu");?>
    </td>
    <td height="60" valign="top"> 
      <?php $this->load->view("admin/templates/top1");?>
    </td>
  </tr>
  <tr> 
    <td width="90%" valign="top" class="cuadrogris"> 
      <?php $this->load->view("admin/templates/usuario");?>
      <?php $this->load->view("admin/templates/estatus");?>
      <table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
        <tr> 
          <td width="65%" class="tituloama30"> Usuarios</td>
          <td width="35%" class="tituloama30">&nbsp;</td>
        </tr>
      </table>
      
      
      
      
      
      
      
      
      <table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
     
        <tr> 
          <td class="renglonazul"><div align="center">Editar Profesor con RFC: <?php echo $usuario->rfc;?>
          
          </div>
             
              <div align="center"  style="background-color:#FF0000;">
                 <?php if (isset($suceso)) { ?>
                <div class="alert alert-success"><?php echo $suceso; ?></div>
            <?php } ?>
            <?php if (isset($erro)) { ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>
              </div>
              </td>
        </tr>
        <tr> 
          <td class="backgris">
       
                               
                               
                               <?php if(!isset($usuario) || empty($usuario)){ ?>

          		<table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
              	<tr>
                	<td width="2%" class="renglorojo"><img src="<?php echo base_url();?>imagenes/error.gif" width="30" height="30" align="absmiddle"></td>
                	<td width="98%" class="renglorojo" align="center">Profesor No Encontrado </td>
              	</tr>
            	</table>
            	<br>
    <?php }else{?>
            <form id="formulario" name="form1" method="post">

 <!-- jalar option 
 <label for="Tipo">Tipo:</label>
<select name="tipo">
<?php
/*foreach ($arrTipo as $i => $tipo)
   echo '<option values="',$tipo,'">',$tipo,'</option>';
*/?>
</select><br> //-->
	
	<label for="Rfc">RFC:</label>
			<input type="text" name="rfc" class="ligarojo11" value="<?php echo set_value('rfc') ? set_value('rfc') : $usuario->rfc; ?>" placeholder="Ej. RFC. CADM7611125D8"></input><br>

			<label for="Nombre">Nombre</label>
			<input type="text" name="nombre" value="<?php echo set_value('nombre') ? set_value('nombre') : $usuario->nombre; ?>"></input><br>
			
			<label for="AP">Apellido Paterno</label>
			<input type="text" name="apaterno" value="<?php echo set_value('apaterno') ? set_value('apaterno') : $usuario->apaterno; ?>"></input><br>
			
			<label for="AM">Apellido Materno</label>
			<input type="text" name="amaterno" value="<?php echo set_value('amaterno') ? set_value('amaterno') : $usuario->amaterno; ?>"</input><br>
			
			<label for="Correo">Correo</label>
			<input type="text" name="correo" value="<?php echo set_value('correo') ? set_value('correo') : $usuario->correo; ?>"</input><br>
			
				
			<label for="Password">Contraseña</label>
			<input type="password" name="password" value="<?php echo set_value('password') ? set_value('passwprd') : $usuario->password; ?>"></input><br>
			
			<label for="Password">Confirme Contraseña</label>
			<input type="password" name="pass2" value="<?php echo set_value('pass2') ? set_value('pass2') : $usuario->password; ?>"></input><br>
			
			<input type="submit" value="Editar" name="acao">
		</form>
		<a href="<?php echo base_url().'admin/profesores/listar'?>" title="Regresar">Regresar</a>
			<hr>
			<br>
			
		<?php }?> 
		
		 <?php if(validation_errors()): ?>
       <strong>Atención!</strong>
						<?php echo form_error('rfc'); ?> 
                        <?php echo form_error('nombre'); ?>
                        <?php echo form_error('apaterno'); ?>
                        <?php echo form_error('amaterno'); ?>
                        <?php echo form_error('password'); ?>
                        <?php echo form_error('pass2'); ?>
                        <?php echo form_error('correo'); ?>
                        
                               <?php endif; ?>
		</td>
        </tr>
        <tr>
        <td>
             
        </td>
        </tr>
      </table>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
    </td>
  </tr>
</table>


<?php $this->load->view("admin/templates/footer");?>
</body>
</html>
