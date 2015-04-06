<?php
$evaluador = array(
		"id" => "evaluador",
		"name" => "evaluador",
		"size" => "50",
		"required" => "required",
		"type" => "text",
		"placeholder" => "Ingrese el nombre del evaluador"
);

$evaluado = array(
		"id" => "evaluado",
		"name" => "evaluado",
		"required" => "required",
		"size" => "50",
		"type" => "text",
		"placeholder" => "Ingrese el nombre del evaluado"
);

$boton = array(
		"class" => "blue",
		"type" => "submit",
		"id" => "boton",
		"name" => "boton",
		"content" => "Guardar asignacion",
		"value" => "Guardar"
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
                    <?php echo form_open("administrador/asignaProfesores") ?>
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
                     <?php echo form_input($boton)?>
                    <?php echo form_close() ?>
                    <br>
                </fieldset>
            </div>
            <div class="col_2"></div>
            <div class="clearfix"></div>
            
            <div class="col_2"></div>
            <div class="col_8 center">
                <fieldset>
                    <legend>Profesores</legend>
                    <table class="sortable" cellspacing="0" cellpadding="0">
                        <thead>
                            <th>Profesor</th>
                            <th>Opciones</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td><a><i></i></i></a></td>
                            </tr>
                            <tr>
                                <td><a><i></i></i></a></td>
                            </tr>
                        </tbody>
                    </table>    
                </fieldset>
            </div>
            <div class="col_2"></div>
        </div>
    </div>
</body>