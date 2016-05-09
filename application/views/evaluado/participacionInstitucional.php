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
                    <legend>PARTICIPACI&Oacute;N INSTITUCIONAL</legend>
                    <table class="striped visible" cellspacing="0" cellpadding="0" >
                        <tr>
                            <td width="50%">Cagos Acad&eacute;mico-Administrativos</td>
                            <td width="30%"></td>
                            <td width="20%"><?php echo $cargo ?></td>
                        </tr>
                        <tr>
                            <td width="50%">Miembro de Comisi&oacute;n Evaluadora</td>
                            <td width="30%"></td>
                            <td width="20%"><?php echo $comisiones["total"] ?></td>
                        </tr>
                        <tr>
                            <td width="50%">Participaci&oacute;n como jurado calificador</td>
                            <td width="30%"></td>
                            <td width="20%"><?php echo $comisiones["juradoCalificador"] ?></td>
                        </tr>
                        <tr>
                            <td width="50%" rowspan="3">Coordinaci&oacute;n o jefatura de</td>
                            <td width="30%">Asignatura</td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="30%">Laboratorio</td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="30%">Examenes</td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%">Integrante del Consejo Universitario</td>
                            <td width="30%"></td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%">Integrante del Consejo T&eacute;cnico</td>
                            <td width="30%"></td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%">Integrante de Comisiones Dictaminadoras</td>
                            <td width="30%"></td>
                            <td width="20%"><?php echo $comisiones["comisionDictaminadora"] ?></td>
                        </tr>
                        <tr>
                            <td width="50%">Integrante de Comisiones Evaluadoras del PRIDE</td>
                            <td width="30%"></td>
                            <td width="20%"><?php echo $comisiones["comisionPride"] ?></td>
                        </tr>
                        <tr>
                            <td width="50%">Participaci&oacute;n en proyectos institucionales</td>
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