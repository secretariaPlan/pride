<script src="<?php echo base_url();?>js/comentario.js" ></script>
<body>
    <input type = "hidden" id= "idUsuario" value = "<?php echo $idUsuario?>" />
    <input type = "hidden" id= "idEvaluado" value = "<?php echo $idEvaluado?>" />
    <input type = "hidden" id= "idSeccion" value = "5" />
    <div class="grid flex">
    	<div class="col_12">
            <div class="col_2"></div>
            <div class="col_8">
  				<fieldset>
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