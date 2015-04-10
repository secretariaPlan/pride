<?php
$evaluador = array(
		"id" => "evaluador",
		"name" => "evaluador",
		"size" => "50",
		"type" => "text",
		"placeholder" => "Ingrese el nombre del evaluador"
);

$hidden = array(
		"idEvaluador" => "",
		"nombreEvaluador" => "",
		"idEvaluado" => "",
		"nombreEvaluado" =>""
);

$evaluado = array(
		"id" => "evaluado",
		"name" => "evaluado",
		"size" => "50",
		"type" => "text",
		"placeholder" => "Ingrese el nombre del evaluado"
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
<script src="<?php echo base_url();?>js/administrador/asignacion.js" ></script>
<body>
    <div class="grid flex">
    	<div class="col_12">
            <div class="col_2"></div>
            <div class="col_8 center">
                <fieldset>
                    <legend>Asignacion</legend>
                    <?php echo form_open("","",$hidden) ?>
                    <?php echo form_label("Evaluador","evaluador")?>
                    <br>
                    <?php echo form_input($evaluador)?>
                    <br>
                    <br>
                    <?php echo form_label("Evaluado","evaluado")?>
                    <br>
                    <?php echo form_input($evaluado)?>
                    <br>
                    <br>
                     <?php echo form_close() ?>
                     <?php echo form_input($boton)?>
                    <br>
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