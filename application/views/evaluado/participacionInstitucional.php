<script src="<?php echo base_url();?>js/comentario.js" ></script>
<body>
    <input type = "hidden" id= "idUsuario" value = "<?php echo $idUsuario?>" />
    <input type = "hidden" id= "idEvaluado" value = "<?php echo $idEvaluado?>" />
    <input type = "hidden" id= "idseccion" value = "7" />
    <div class="grid flex">
    	<div class="col_12">
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