<script src="<?php echo base_url();?>js/comentario.js" ></script>
<body>
    <input type = "hidden" id= "idUsuario" value = "<?php echo $idUsuario?>" />
    <input type = "hidden" id= "idEvaluado" value = "<?php echo $idEvaluado?>" />
    <input type = "hidden" id= "idseccion" value = "6" />
    <div class="grid flex">
    	<div class="col_12">
            <div class="col_2"></div>
            <div class="col_8">
  				<fieldset>
                    <legend>DIFUS&Iacute;ON</legend>
                    <table class="striped visible" cellspacing="0" cellpadding="0" >
                        <tr>
                            <td width="50%" rowspan="2">Presentaci&oacute;n de trabajos en congresos (cartel/oral)</td>
                            <td width="30%">Nacional</td>
                            <td width="20%"><?php echo $presentacion["nacionales"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Internacional</td>
                            <td width="20%"><?php echo $presentacion["internacionales"] ?></td>
                        </tr>
                        <tr>
                            <td width="50%">Conferencias impartidas</td>
                            <td width="30%"></td>
                            <td width="20%"><?php echo $conferencia ?></td>
                        </tr>
                        <tr>
                            <td width="50%">Organizacion de eventos</td>
                            <td width="30%"></td>
                            <td width="20%"><?php echo  $eventos ?></td>
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