<script src="<?php echo base_url();?>js/evaluador/comentario.js" ></script>
<body>
    <div class="grid flex">
    	<div class="col_12">
            <div class="col_2"></div>
            <div class="col_8">
  				<fieldset>
                    <legend>FORMACI&Oacute;N Y TRAYECTORIA ACAD&Eacute;MICA</legend>
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
                    <div class="col_12 center">
                        <button id="botonComentario" class="medium blue">Agregar comentario</button>
                    </div>
                    <div id="comentario" title="Agregar comentario">
                        
                    </div>
                </fieldset>
            </div>
            <div class="col_2"></div>
        </div>
    </div>
</body>
