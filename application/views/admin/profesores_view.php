<?php
//El GUi de mant a usuarios
//Javier Alpizar, 2 Abr 08 08

//include_once("nivelAdmin.php");
//include_once("SessionOk.php");

//include_once("lib/UsuarioDALC.php");
//$usuarios = UsuarioDALC::ObtenUsuarios();
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
          <td width="83%" class="renglonazul"> Usuarios</td>
          <td width="17%"><table width="130" border="0" align="right" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="134" class="agregar"><a href="UsuarioAgregar.php"><font color="#3B7F1B">Agregar 
                  usuario</font></a></td>
              </tr>
            </table></td>
        </tr>
        <tr valign="top"> 
          <td colspan="2" class="backgris"> 
            <table width="100%" border="0" cellpadding="5" cellspacing="1">
              <tr valign="top"> 
                <td width="10%" class="renglogris">RFC</td>
                <td width="20%" class="renglogris">Nombre</td>
                <td width="20%" class="renglogris">Apellido Paterno</td>
                <td width="20%" class="renglogris">Apellido Materno</td>
                <td width="20%" class="renglogris">Password</td>
                <td width="40%" class="renglogris">Correo</td>
                <td width="10%" class="renglogris">Activo</td>
                <td width="10%">&nbsp;</td>
              </tr>
              
                  <?php
                        $numLinha = 0;
                        if(!isset($usuario) || empty($usuario)){
                           echo 'Ningun dato encontrado'; 
                        }else{
                         foreach ($usuario as $a){
                        ?>  
          
            
              <tr valign="top" id="linha<?php echo $numLinha; ?>"> 
                <td class="ligagrisch"><strong><img src="<?php echo base_url("templates/admin");?>/imagenes/flechaazul.gif" width="9" height="9"><?php echo $a->rfc;?></strong></td>
                <td class="txtgris10"><?php echo $a->nombre; ?></td>
                <td class="txtgris10"><?php echo $a->apaterno;?></td>
                 <td class="txtgris10"><?php echo $a->amaterno;?></td>
                <td class="txtgris10"><?php echo $a->password;?></td>
                <td class="txtgris10"><?php echo $a->correo;?></td>
                <td><table width="80" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="134" class="modificar"><a href="<?php echo base_url().'admin/profesores/editar/'.$a->id.'/'.url_title($a->nombre); ?>">|<font color="#FFFFFF">Modificar</font></a></td>
                    </tr>
                  </table>
                  
                  <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">

                                    <a class="green" title="editar infomações" href="<?php echo base_url().'profesor/editar/'.$a->id.'/'.url_title($a->nombre); ?>">
                                        <i class="icon-pencil bigger-130"></i>
                                    </a>

                                    <a class="red" title="apagar" href="" onClick="return excluir(<?php echo $a->id, ', ', $numLinha; ?>);">
                                        <i class="icon-trash bigger-130"></i>
                                    </a>
                                </div>
                  
                  
                  <table width="80" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td width="134" class="eliminar"><a href="#"  onclick="BorraRegistro('<? echo $a["nombre"]; ?>','<? echo $a["id"]; ?>')"><font color="#df2407">Eliminar 
                        </font></a></td>
                    </tr>
                  </table></td>
              </tr>
          
              <?php
                            $numLinha++;
                            }//fim foreach
                            }//fim else
                            ?>
          
          
            </table></td>
        </tr>
      </table>
      
    </td>
  </tr>
</table>


<?php $this->load->view("admin/templates/footer");?>
</body>
</html>
