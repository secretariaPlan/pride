<script src="<?php echo base_url();?>js/evaluador/matDoc.js" ></script>
<body>
    <div class="grid flex">
    	<div class="col_12">
            <div class="col_2"></div>
            <div class="col_8">
  				<fieldset>
                    <legend>MATERIAL DOCENTE</legend>
                    <table class="striped visible" cellspacing="0" cellpadding="0" >
                        <tr>
                            <td width="50%">Manuales</td>
                            <td width="30%"></td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%">Software</td>
                            <td width="30%"></td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%">Videos</td>
                            <td width="30%"></td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%">Participaci&oacute;n en elk diseño de programas de asignatura</td>
                            <td width="30%"></td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%">Diseño de pr&acute;cticas de laboratorio</td>
                            <td width="30%"></td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%">Participaci&oacute;n en el diseño de ex&aacute;menes departamentales</td>
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