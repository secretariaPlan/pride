<script src="<?php echo base_url();?>js/evaluador/formTrayAca.js" ></script>
<body>
    <div class="grid flex">
    	<div class="col_12">
            <div class="col_2"></div>
            <div class="col_8">
  				<fieldset>
                    <legend>FORMACI&Oacute;N Y TRAYECTORIA ACAD&Eacute;MICA</legend>
                    <table class="striped visible" cellspacing="0" cellpadding="0" >
                        <tr>
                            <td width="50%" rowspan="4">Estudios realizados durante el periodo:</td>
                            <td width="30%">Licenciatura</td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="30%">Maestr&iacute;a</td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="30%">Doctorado</td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="30%">Posdoctorado</td>
                            <td width="20%">Valor</td>
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
                            <td width="20%">Valor</td>
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
                        <div class="col_12">
                            <textarea id="texto" class="col_12" placeholder="Agregue un comentario"></textarea>
                        </div>
                        <div class="12 center">
                            <button class="small green">Guardar</button>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col_2"></div>
        </div>
    </div>
</body>
