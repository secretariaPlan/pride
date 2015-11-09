<script src="<?php echo base_url();?>js/evaluador/prodAca.js" ></script>
<body>
    <div class="grid flex">
    	<div class="col_12">
            <div class="col_2"></div>
            <div class="col_8">
  				<fieldset>
                    <legend>PRODUCTIVIDAD ACAD&Eacute;MICA</legend>
                    <table class="striped visible" cellspacing="0" cellpadding="0" >
                        <tr>
                            <td width="50%" rowspan="2">Publicaciones nacionales</td>
                            <td width="30%">Con arbitraje</td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="30%">Sin arbitraje</td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%" rowspan="2">Publicaciones internacionales</td>
                            <td width="30%">Con arbitraje</td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="30%">Sin arbitraje</td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%">Proyectos de investigaci&oacute;n de los que no se es responsable</td>
                            <td width="30%"></td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%">Cap&iacute;tulos en libros publicados</td>
                            <td width="30%"></td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%">Libros publicados</td>
                            <td width="30%"></td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%">Participaciones como &aacute;rbitro de publicaciones</td>
                            <td width="30%"></td>
                            <td width="20%">Valor</td>
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
                            <td width="30%">NAcional</td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="30%">Internacional</td>
                            <td width="20%">Valor</td>
                        </tr>
                        <tr>
                            <td width="50%">Patentes registradas</td>
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