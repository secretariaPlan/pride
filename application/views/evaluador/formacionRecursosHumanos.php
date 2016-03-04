<script src="<?php echo base_url();?>js/evaluador/comentario.js" ></script>
<body>
    <div class="grid flex">
    	<div class="col_12">
            <div class="col_2"></div>
            <div class="col_8">
  				<fieldset>
                    <legend>FORMACI&Oacute;N DE RECURSOS HUMANOS</legend>
                    <table class="striped visible" cellspacing="0" cellpadding="0" >
                        <tr>
                            <td width="50%" rowspan="9">Direcci&oacute;n de t&eacute;sis concluidas</td>
                            <td width="30%">Técnico</td>
                            <td width="20%"><?php echo $tesisConcluidas["tecnico"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Bachillerato</td>
                            <td width="20%"><?php echo $tesisConcluidas["bachillerato"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Licenciatura</td>
                            <td width="20%"><?php echo $tesisConcluidas["licenciatura"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Diplomado</td>
                            <td width="20%"><?php echo $tesisConcluidas["diplomado"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Especialización</td>
                            <td width="20%"><?php echo $tesisConcluidas["especializacion"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Maestría</td>
                            <td width="20%"><?php echo $tesisConcluidas["maestria"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Doctorado</td>
                            <td width="20%"><?php echo $tesisConcluidas["doctorado"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Posdocotorado</td>
                            <td width="20%"><?php echo $tesisConcluidas["posdoctorado"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Licenciatura(en otras instituciones)</td>
                            <td width="20%"><?php echo $tesisConcluidas["licenciaturaOtras"] ?></td>
                        </tr>
                        <tr>
                            <td width="50%" rowspan="4">Tesis concluidas en las que participo como supervisor</td>
                            <td width="30%">Licenciatura</td>
                            <td width="20%"><?php echo $examenesSupervisor["licenciatura"]?></td>
                        </tr>
                        <tr>
                            <td width="30%">Especialidad</td>
                            <td width="20%"><?php echo $examenesSupervisor["especializacion"]?></td>
                        </tr>
                        <tr>
                            <td width="30%">Maest&iacute;a</td>
                            <td width="20%"><?php echo $examenesSupervisor["maestria"]?></td>
                        </tr>
                        <tr>
                            <td width="30%">Doctorado</td>
                            <td width="20%"><?php echo $examenesSupervisor["doctorado"]?></td>
                        </tr>
                        <tr>
                            <td width="50%" rowspan="4">Ex&aacute;menes de titulaci&oacute; en donde particip&oacute; como jurado</td>
                            <td width="30%">Licenciatura</td>
                            <td width="20%"><?php echo $examenesJurado["licenciatura"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Especialidad</td>
                            <td width="20%"><?php echo $examenesJurado["especializacion"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Maest&iacute;a</td>
                            <td width="20%"><?php echo $examenesJurado["maestria"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Doctorado</td>
                            <td width="20%"><?php echo $examenesJurado["doctorado"] ?></td>
                        </tr>
                        <tr>
                            <td width="50%" rowspan="3">N&uacute;mero de alumnos asesorados en subprogramas</td>
                            <td width="30%">121</td>
                            <td width="20%"><?php echo $tutorias["tutoria121"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">127</td>
                            <td width="20%"><?php echo $tutorias["tutoria127"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Otros</td>
                            <td width="20%"><?php echo $tutorias["tutoriaOtro"] ?></td>
                        </tr>
                        <tr>
                            <td width="50%">Alumnos con Servicio Social concluido </td>
                            <td width="30%"></td>
                            <td width="20%"><?php echo $servSocial ?></td>
                        </tr>
                        <tr>
                            <td width="50%">Participaci&oacute;n en Comit&eacute;s Tutorales</td>
                            <td width="30%"></td>
                            <td width="20%">Valor</td>
                        </tr>
                        <td width="50%" rowspan="2">Tutor&iacute;s de posdoctorales</td>
                            <td width="30%">Concluidas</td>
                            <td width="20%"><?php echo $tutoriasConcluidas["concluida"] ?></td>
                        </tr>
                        <tr>
                            <td width="30%">En proceso</td>
                            <td width="20%"><?php echo $tutoriasConcluidas["enProceso"] ?></td>
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
                        <div id="comentario" title="Agregar comentario"></div>
                </fieldset>
            </div>
            <div class="col_2"></div>
        </div>
    </div>
</body>