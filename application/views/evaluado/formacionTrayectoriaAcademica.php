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
                    <legend class="center">FORMACI&Oacute;N Y TRAYECTORIA ACAD&Eacute;MICA</legend>
                    <table class="striped visible" cellspacing="0" cellpadding="0" >
                        <tr>
                            <td width="50%" rowspan="9">Estudios realizados durante el periodo:</td>
                            <td width="30%">Técnico</td>
                            <td width="20%"><?php echo $formacion["tecnico"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Bachillerato</td>
                            <td width="20%"><?php echo $formacion["bachillerato"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Licenciatura</td>
                            <td width="20%"><?php echo $formacion["licenciatura"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Diplomado</td>
                            <td width="20%"><?php echo $formacion["diplomado"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Especialización</td>
                            <td width="20%"><?php echo $formacion["especializacion"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Maestría</td>
                            <td width="20%"><?php echo $formacion["maestria"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Doctorado</td>
                            <td width="20%"><?php echo $formacion["doctorado"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Posdocotorado</td>
                            <td width="20%"><?php echo $formacion["posdoctorado"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Licenciatura(en otras instituciones)</td>
                            <td width="20%"><?php echo $formacion["licenciaturaOtras"] ?></td>
                        </tr>
                        <tr>
                            <td width="50%" rowspan="2">Cursos tomados</td>
                            <td width="30%">Con evaluaci&oacute;n</td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="30%">Sin evaluaci&oacute;n</td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%">Premios recibidos</td>
                            <td width="30%"></td>
                            <td width="20%"><?php echo $premios ?></td>
                        </tr>
                        <tr>
                            <td width="50%">Reconocimientos obtenidos</td>
                            <td width="30%"></td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%">Nivel en el S.N.I.</td>
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
