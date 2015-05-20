<?php
$usuario = array(
		"id" => "usuario",
		"name" => "usuario",
		"size" => "50",
		"type" => "text",
		"placeholder" => "Ingrese el nombre o RFC del profesor"
);

$hidden = array(
		"idUsuario" => "",
		"nombreUsuario" => "",
);

$boton = array(
		"class" => "blue",
		"type" => "submit",
		"id" => "asignar",
		"name" => "boton",
		"content" => "Guardar asignacion",
		"value" => "Asignar"
);
?>
<script src="<?php echo base_url();?>js/administrador/nombrarEvaluado.js" ></script>
<body>
    <div class="grid flex">
    	<div class="col_12">
            
            
            <div class="col_2"></div>
            <div class="col_8 center">
                <fieldset>
                    <legend>Nombrar Evaluados del periodo</legend>
                    <div class="col_12">
                        <div class="clearfix"></div>
                        <div class="col_4"></div>
                        <div class="col_4">
                            <div id="alerta" class="col_12"><p id="alertaMensaje" class="center"></p></div>
                        </div>
                        <div class="col_4"></div>
                        <div class="clearfix"></div>
                        <div class="col_2"></div>
                        <div class="col_8">
                             <?php echo form_open("","",$hidden) ?>
                            <?php echo form_label("Usuario","usuario")?>
                            <br>
                            <?php echo form_input($usuario)?>
                            <br>
                            <br>
                            <label>Periodo</label>
                            <select id="periodo"></select>
                            <br>
                            <br>
                            <label>Comisi&oacute;n</label>
                            <select id="comision"></select>
                            <br>
                            <br>
                            
                             <?php echo form_close() ?>
                             <?php echo form_input($boton)?>
                            <br>
                        </div>
                        <div class="col_2"></div>
                    </div>
                </fieldset>
            </div>
            <div class="col_2"></div>
            <div class="clearfix"></div>
            
            <div class="col_2"></div>
            <div class="col_8 center">
                <div class="col_12">
                    <fieldset>
                        <legend>Profesores</legend>
                        <div class="col_3"></div>
                        <div class="col_6">
                            <table class="sortable" cellspacing="0" cellpadding="0">
                                <thead>
                                    <th>Profesor</th>
                                    <th>Opciones</th>
                                </thead>
                                <tbody id = "asignados">

                                </tbody>
                            </table>    
                        </div>
                        <div class="col_3"></div>
                    </fieldset>    
                </div>
            </div>
            <div class="col_2"></div>
        </div>
    </div>
</body>