<script src="<?php echo base_url();?>js/evaluador/docencia.js" ></script>
<body>
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
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="30%">Horas totales</td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%" rowspan="2">Asignaturas curriculares impartidas en posgrado</td>
                            <td width="30%">No. Grupos</td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="30%">Horas totales</td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%">Cursos extracurriculares impartidos</td>
                            <td width="30%"></td>
                            <td width="20%">Valor</td>
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