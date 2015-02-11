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



        <!-- 888888888888888888888 ESTILOS 88888888888888888888888888888888888888888888-->
        <!-- estilos básicos -->
        <link href="<?php echo base_url(); ?>public/assets/css/bootstrap.min.css" rel="stylesheet" />

        <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/font-awesome.min.css" />
        <!-- FONTAWESOME NOVO -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/font-awesome.css" />
        <!--[if IE 7]>
          <link rel="stylesheet" href="http://localhost/PHP/sistema_escolar/public/assets/css/font-awesome-ie7.min.css" />
        <![endif]-->
        <!-- estilos básicos FIM -->

        <!-- fonts -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/ace-fonts.css" />
        <!-- fonts FIM -->

        <!-- estilos do template ACE -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/ace.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/ace-rtl.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/main.css" />
        <!--[if lte IE 8]>
          <link rel="stylesheet" href="http://localhost/PHP/sistema_escolar/public/assets/css/ace-ie.min.css" />
        <![endif]-->
        <!-- estilos do template ACE FIM -->

        <!-- suporte do html5 no ie8 -->
        <!--[if lt IE 9]>
        <script src="http://localhost/PHP/sistema_escolar/public/assets/js/html5shiv.js"></script>
        <script src="http://localhost/PHP/sistema_escolar/public/assets/js/respond.min.js"></script>
        <![endif]-->
        <!-- suporte do html5 no ie8 FIM -->
        <!-- 888888888888888888888 ESTILOS FIM 8888888888888888888888888888888888888888-->

 <!-- ##################### SCRIPTS ############################################-->
        <!-- Scripts básicos -->
        <!--[if !IE]> -->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='<?php echo base_url(); ?>public/assets/js/jquery-2.0.3.min.js'>" + "<" + "/script>");
        </script>
        <!-- <![endif]-->
        <!--[if IE]>
        <script type="text/javascript">
         window.jQuery || document.write("<script src='<?php echo base_url(); ?>public/assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
        </script>
        <![endif]-->
        <script type="text/javascript">
            if ("ontouchend" in document)
                document.write("<script src='<?php echo base_url(); ?>public/assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
        </script>
        <script src="<?php echo base_url(); ?>public/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>public/assets/js/typeahead-bs2.min.js"></script>
        <!-- Scripts básicos FIM -->
        <script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/jquery.maskedinput.min.js">
        </script>

        <!-- Bibliotecas de plugins específicos desta página -->
        <!--[if lte IE 8]>
          <script src="http://localhost/PHP/sistema_escolar/public/assets/js/excanvas.min.js"></script>
        <![endif]-->
        <script src="<?php echo base_url(); ?>public/assets/js/jquery-ui-1.10.3.custom.min.js"></script>
        
        <!-- Bibliotecas de plugins específicos desta página FIM -->


        <!-- scripts do template ACE -->
        <script src="<?php echo base_url(); ?>public/assets/js/ace-elements.min.js"></script>
        <script src="<?php echo base_url(); ?>public/assets/js/ace.min.js"></script>
        <!-- scripts do template ACE FIM -->
        <script type="text/javascript">
        </script>

        <!-- ##################### SCRIPTS FIM ########################################-->


        
        
        
        <!-- Bibliotecas de plugins específicos desta página tabela FIM -->
<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX COPIAR  XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/js/jquery.dataTables.bootstrap.js"></script>
<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX COPIAR FIM XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
<!-- Bibliotecas de plugins específicos desta página tabela FIM -->
        
        
        
        
        
        

<script type="text/javascript">
    $(document).ready(function() {
        $('#sample-table-2').dataTable({                              
          "oLanguage": {
          "sProcessing": "Por favor, espere mientras se cargan los datos ...",
          "sLengthMenu": "Mostrar _MENU_ registros por página",
          "sZeroRecords": "No se encontro al profesor",
          "sInfoEmtpy": "Exibindo 0 a 0 de 0 registros",
          "sInfo": "Mostrar de _START_ a _END_ de _TOTAL_ registros",
          "sInfoFiltered": "",
          "sSearch": "Buscar por RFC",
         "oPaginate": {
           "sFirst":    "Primero",
           "sPrevious": "Anterior",
           "sNext":     "Próximo",
           "sLast":     "Último"
          }
       }                              
    });   
   });
  
</script>
<script type="text/javascript">
    function eliminar(id, linha) {
     var url = "<?php echo base_url().'admin/profesores/eliminar/' ?>";
        if (confirm("Desea borrar a este profesor definitivamente?")) {
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
<!-- XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX COPIAR FIM XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
<!-- Scripts inline de plugins específicos desta página tabela FIM -->

<!-- ##################### SCRIPTS FIM ############################################-->




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
      
      
      <table width="95%" border="0" align="center" cellpadding="3" cellspacing="1" >
     
        <tr> 
          <td width="83%" class="renglonazul"> Usuarios</td>
          <td width="17%"><table width="130" border="0" align="right" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="134" class="agregar"><a href="<?php echo base_url("admin/profesores/agregar");?>"><font color="#3B7F1B">Agregar 
                  usuario</font></a></td>
              </tr>
            </table></td>
        </tr>
        
        
        
        <tr valign="top"> 
          <td colspan="2" class="backgris"> 
          
           <div class="table-responsive">
                <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="24" class="center">
                                <label>
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </th>
                            <th width="80">RFC:</th>
                            <th width="120" class="hidden-480">Nombre:</th>
                            <th width="100" class="hidden-480">Apellido Paterno:</th>
                            <th width="100" class="hidden-480">Apellido Materno:</th>
                            <th width="80" class="hidden-480">Correo:</th>
                            <th width="90" class="hidden-480">Contraseña:</th>
                            <th width="54">Acción:</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $numLinha = 0;
                        if(!isset($usuario) || empty($usuario)){
                           echo 'Nenhum aluno encontrado'; 
                        }else{
                         foreach ($usuario as $a){
                        ?> 
                   
                        <tr id="linha<?php echo $numLinha; ?>">
                            <td class="center">
                                <label>
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </td>	

                            <td><?php echo $a->rfc; ?></td>
                            <td><?php echo $a->nombre; ?></td>
                            <td><?php echo $a->apaterno; ?></td>
                            <td><?php echo $a->amaterno; ?></td>
                         	<td><?php echo $a->correo; ?></td>
                         	<td><?php echo $a->password; ?></td>
                            <td>
                                <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">

                                    <a class="green" title="editar infomações" href="<?php echo base_url().'admin/profesores/editar/'.$a->id.'/'.url_title($a->nombre); ?>">
                                        <i class="icon-pencil bigger-130"></i>
                                    </a>

                                    <a class="red" title="apagar" href="" onClick="return excluir(<?php echo $a->id, ', ', $numLinha; ?>);">
                                        <i class="icon-trash bigger-130"></i>
                                    </a>
                                </div>

                                <div class="visible-xs visible-sm hidden-md hidden-lg">
                                    <div class="inline position-relative">
                                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-caret-down icon-only bigger-120"></i>
                                        </button>

                                    </div>
                                </div>
                            </td>

                            <?php
                            $numLinha++;
                            }//fim foreach
                            }//fim else
                            ?>
                        </tr>




                    </tbody>
                </table>
            </div>
  
          
          
            </td>
        </tr>
      </table>
      
      
 
      
      
      
      
      
      
      
     
      
      
      
      
      
      
      
      
      
      
      
    </td>
  </tr>
</table>





























<?php $this->load->view("admin/templates/footer");?>
</body>
</html>
