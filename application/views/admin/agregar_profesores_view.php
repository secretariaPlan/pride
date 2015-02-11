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
      
      <!-- Contenido para agregar profesores -->
      
      
      
      
      <table width="95%" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr> 
          <td class="renglonazul"><div align="center">Agregar Usuario</div>
              
              <div align="center"  style="background-color:#FF0000;"><?php if(isset($mensaje)): ?>
	<h2><?= $mensaje;?></h2>
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
            <form name="form_reg" action="<?= base_url().'admin/profesores/agregar_very'?>" method="post">

 <!-- jalar option 
 <label for="Tipo">Tipo:</label>
<select name="tipo">
<?php
/*foreach ($arrTipo as $i => $tipo)
   echo '<option values="',$tipo,'">',$tipo,'</option>';
*/?>
</select><br> //-->
	
	<label for="Rfc">RFC:</label>
			<input type="text" name="rfc" class="ligarojo11" value="<?= @set_value('rfc')?>" placeholder="Ej. RFC. CADM7611125D8"></input><br>

			<label for="Nombre">Nombre</label>
			<input type="text" name="nombre" value="<?= @set_value('nombre')?>" required placeholder="Nombre"></input><br>
			
			<label for="AP">Apellido Paterno</label>
			<input type="text" name="apaterno" value="<?= @set_value('apaterno')?>" required placeholder="Apellido Paterno"></input><br>
			
			<label for="AM">Apellido Materno</label>
			<input type="text" name="amaterno" value="<?= @set_value('amaterno')?>" required placeholder="Apellido Materno"></input><br>
			
			<label for="Correo">Correo</label>
			<input type="text" name="correo" value="<?= @set_value('correo')?>" required placeholder="Apellido Paterno"></input><br>
			
				
			<label for="Password">Contraseña</label>
			<input type="password" name="password" value="<?= @set_value('password')?>" required placeholder="Correo Electronico"></input><br>
			
			<label for="Password">Confirme Contraseña</label>
			<input type="password" name="pass2" value="<?= @set_value('pass2')?>" required placeholder="Confirmar Correo Electronico"></input><br>
			
			<input type="submit" value="Agregar" name="submit_reg">
		</form>
		<a href="<?php echo base_url().'admin/profesores/listar'?>"" title="Regresar">Regresar</a>
			<hr>
		<?= validation_errors();?> </td>
        </tr>
      </table>
      
      
      
      
      
      
      
      
      
      <!-- Fin del contenido par agregar profesors -->
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
    </td>
  </tr>
</table>


<?php $this->load->view("admin/templates/footer");?>
</body>
</html>
