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
                    <legend>PRODUCTIVIDAD ACAD&Eacute;MICA</legend>
                    <table class="striped visible" cellspacing="0" cellpadding="0" >
                        <tr>
                            <td width="50%" rowspan="2">Publicaciones nacionales</td>
                            <td width="30%">Con arbitraje</td>
                            <td width="20%"><?php echo $articulo["arbitradaNacional"]?></td>
                        </tr>
                        <tr>
                            <td width="30%">Sin arbitraje</td>
                            <td width="20%"><?php echo $articulo["noArbitradaNacional"]?></td>
                        </tr>
                        <tr>
                            <td width="50%" rowspan="2">Publicaciones internacionales</td>
                            <td width="30%">Con arbitraje</td>
                            <td width="20%"><?php echo $articulo["arbitradaInternacional"]?></td>
                        </tr>
                        <tr>
                            <td width="30%">Sin arbitraje</td>
                            <td width="20%"><?php echo $articulo["noArbitradaInternacional"]?></td>
                        </tr>
                        <tr>
                            <td width="50%">Proyectos de investigaci&oacute;n de los que no se es responsable</td>
                            <td width="30%"></td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%">Cap&iacute;tulos en libros publicados</td>
                            <td width="30%"></td>
                            <td width="20%"><?php echo $capitulo ?></td>
                        </tr>
                        <tr>
                            <td width="50%">Libros publicados</td>
                            <td width="30%"></td>
                            <td width="20%"><?php echo $libro ?></td>
                        </tr>
                        <tr>
                            <td width="50%">Participaciones como &aacute;rbitro de publicaciones</td>
                            <td width="30%"></td>
                            <td width="20%"><?php echo $participacion ?></td>
                        </tr>
                        <tr>
                            <td width="50%" rowspan="2">Citas en publicaciones</td>
                            <td width="30%">Nacional</td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="30%">Internacional</td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%" rowspan="2">Memorias in extenso de Congresos</td>
                            <td width="30%">Nacional</td>
                            <td width="20%"><?php echo $memoria["nacional"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Internacional</td>
                            <td width="20%"><?php echo $memoria["internacional"] ?></td>
                        </tr>
                        <tr>
                            <td width="50%">Patentes registradas</td>
                            <td width="30%"></td>
                            <td width="20%"><?php echo $patente ?></td>
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