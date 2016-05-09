<script src="<?php echo base_url();?>js/comentario.js" ></script>
<body>
    <div class="grid flex">
    	<div class="col_12">
            <?php  
            if(isset($archivo["exito"])){                
            ?>
                <div class="col_4"></div>
                <div class="col_4 center">
                    <?php
                    if($archivo["exito"])
                        echo "<div class='notice success'>" . $archivo["mensaje"] . "<i class='fa fa-check fa-large'></i><a href='#close' class='fa fa-remove'></a></div>";
                    else
                        echo "<div class='notice error'><i class='icon-remove-sign icon-large'></i>" . $archivo["mensaje"] . "<a href='#close' class='icon-remove'></a></div>";
                    ?>
                </div>    
                <div class="col_4"></div>
                <div class="clearfix"></div>
            <?php } ?>
            <div class="col_2"></div>
            <div class="col_8">
  				<fieldset>
                    <div id="alerta"><p id="alertaMensaje" class="center"></p></div>
                    <legend>DOCENCIA</legend>
                    <table class="striped visible" cellspacing="0" cellpadding="0" >
                        <tr>
                            <td width="50%" rowspan="2">Asignaturas curriculares impartidas en licencitaura</td>
                            <td width="30%">No. Grupos</td>
                            <td width="20%"><?php echo $cursosLicenciatura["numGrupos"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Horas totales</td>
                            <td width="20%"><?php echo $cursosLicenciatura["horasTotales"] ?></td>
                        </tr>
                        <tr>
                            <td width="50%" rowspan="2">Asignaturas curriculares impartidas en posgrado</td>
                            <td width="30%">No. Grupos</td>
                            <td width="20%"><?php echo $cursosPosgrado["numGrupos"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Horas totales</td>
                            <td width="20%"><?php echo $cursosPosgrado["horasTotales"] ?></td>
                        </tr>
                        <tr>
                            <td width="50%">Cursos extracurriculares impartidos</td>
                            <td width="30%"></td>
                            <td width="20%"><?php echo $cursosExtra ?></td>
                        </tr>
                        <tr>
                            <td width="50%">Cursos intersemestrales impartidos</td>
                            <td width="30%"></td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%">Otros (precisar)</td>
                            <td width="30%"></td>
                            <td width="20%">Valor</td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset>
                    <legend>Archivos</legend>
                    <div  id="archivosSubidos" style="overflow:scroll;height:200px">
                        <?php
                        $this->load->helper('file');
                        if(sizeof($listaArchivos)){
                        ?>
                            <ul class="alt">
                                <?php
                                    foreach ($listaArchivos as $lista) {
                                    ?> 
                                        <li><a href="<?php echo '../../subidas/'.$lista->nombre ?>"  target="_blank"><?php echo $lista->nombre_original ?></a></li>
                                        <?php
                                    }
                                ?>
                            </ul>    
                        <?php        
                        }
                        ?>                            
                    </div>
                    <?php echo form_open_multipart("evaluado_controller/cargarArchivo")?>
                        <input type = "hidden" name="idUsuario" id= "idUsuario" value = "<?php echo $idUsuario?>" />
                        <input type = "hidden" name="idEvaluado" id= "idEvaluado" value = "<?php echo $idEvaluado?>" />
                        <input type = "hidden" name ="idSeccion" id= "idSeccion" value = "<?php echo $idSeccion ?>" />
                        <input type="file" name="userfile" value="archivo" />
                        <br>
                        <br>
                        <button class="blue" id="botonCargar">Cargar archivo</button>
                    <?php echo form_close() ?>
                </fieldset>
                <div class="col_12 center">
                    <button id="botonComentario" class="medium blue">Agregar comentario</button>
                </div>
                <div class="col_12 center">
                    <button id="botonMostrarComentarios" class="small blue">Mostrar comentario</button>
                </div>
                <br>
                <div id="historialComentarios"></div>
                <div id="comentario"></div>
            </div>
            <div class="col_2"></div>
        </div>
    </div>
</body>