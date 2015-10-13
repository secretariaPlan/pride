<?php
$year = array(
		"id" => "year",
		"name" => "year",
		"type" => "text",
		"value" => date("Y"),
		"size" => "5"
		
);

$numeroPeriodo = array(
		"0" => "Seleccione un n&uacute;mero",
		"1" => "1",
		"2" => "2"
		
);

$inicioPeriodo = array(
		"id" => "inicioPeriodo",
		"class" => "fecha",
		"name" => "inicioPeriodo",
		"type" => "text",
		"placeholder" => "Elija una fecha",
        "value" => set_value('inicioPeriodo')
        
);

$finPeriodo = array(
		"id" => "finPeriodo",
		"class" => "fecha",
		"name" => "finPeriodo",
		"type" => "text",
		"placeholder" => "Elija una fecha",
        "value" => set_value('finPeriodo')

);

$inicioEvaluacion = array(
		"id" => "inicioEvaluacion",
		"class" => "fecha",
		"name" => "inicioEvaluacion",
		"type" => "text",
		"placeholder" => "Elija una fecha",
        "value" => set_value('inicioEvaluacion')
);

$finEvaluacion = array(
		"id" => "finEvaluacion",
		"class" => "fecha",
		"name" => "finEvaluacion",
		"type" => "text",
		"placeholder" => "Elija una fecha",
        "value" => set_value('finEvaluacion')

);

$inicioEntrega = array(
		"id" => "inicioEntrega",
		"class" => "fecha",
		"name" => "inicioEntrega",
		"type" => "text",
		"placeholder" => "Elija una fecha",
        "value" => set_value('inicioEntrega')
);

$finEntrega = array(
		"id" => "finEntrega",
		"class" => "fecha",
		"name" => "finEntrega",
		"type" => "text",
		"placeholder" => "Elija una fecha",
        "value" => set_value('finEntrega')
        
);

$boton = array(
		"class" => "blue",
		"type" => "submit",
		"id" => "asignar",
		"name" => "boton",
		"content" => "Guardar periodo",
		"value" => "Guardar Periodo"
);
?>
<script src="<?php echo base_url();?>js/periodo.js" ></script>
<body>

    <div class="grid flex">

    	<div class="col_12">
    	 
    		<?php if(isset($exito)){?>
    		<div class="col_4"></div>
            <div class="col_4 center">
            	<div class = "notice success"><i class="icon-ok icon-large"></i><?php echo $exito?></div>
            </div>
            <div class="col_4"></div>
            <div class="clearfix"></div>
    		<?php }?>
    		<?php if(isset($error)){?>
    		<div class="col_4"></div>
            <div class="col_4 center">
            	<div class = "notice error"><i class="icon-remove-sign icon-large"></i><?php echo "Error: ".$error?></div>
            </div>
            <div class="col_4"></div>
            <div class="clearfix"></div>
    		<?php }?>
    		<div class="col_4"></div>
    		<div class="col_4 center">
            	<div id="alerta"><p id="alertaMensaje" class="center"></p></div>
                
                <?php echo validation_errors(); ?>

            </div>
 
     
            <div class="clearfix"></div>            
            <div class="col_2"></div>
            <div class="col_8 center">
                <fieldset>
                    <legend>Nuevo periodo</legend>
                    <div class = "col_12">
                        
                    	<?php echo form_open("administrador/nuevoPeriodo") ?>
                    	<div class = "col_1"></div>
                    	<div class = "col_5 right">
                    		<?php echo form_label("Año","año");?>
                    		<?php echo form_input($year);?>
                    	</div>
                    	<div class = "col_5 right">
                    		<?php echo form_label("N&uacute;mero","numero");?>
                    		<?php echo form_dropdown("numero",$numeroPeriodo);?>
                    	</div>
                    	<div class = "col_1"></div>
                    	
                    	<div class = "clearfix"></div>
                    	
                    	<div class = "col_1"></div>
                    	<div class = "col_5 right">
                    		<?php echo form_label("Fecha de Inicio","inicioPeriodo");?>
                    		<?php echo form_input($inicioPeriodo);?>
                    	</div>
                    	<div class = "col_5 right">
                    		<?php echo form_label("Fecha de termino","finPeriodo");?>
                    		<?php echo form_input($finPeriodo);?>

                    	</div>
                    	<div class = "col_1"></div>
                    	
                    	<div class = "clearfix"></div>
                    	
                    	<div class = "col_1"></div>
                    	<div class = "col_5 right">
                    		<?php echo form_label("Inicio de evaluaci&oacute;n","inicioEvaluacion");?>
                    		<?php echo form_input($inicioEvaluacion);?>
                    	</div>
                    	<div class = "col_5 right">
                    		<?php echo form_label("Termino de evaluaci&oacute;n","finEvaluacion");?>
                    		<?php echo form_input($finEvaluacion);?>
                    	</div>
                    	<div class = "col_1"></div>
                    	
                    	<div class = "clearfix"></div>
                    	
                    	<div class = "col_1"></div>
                    	<div class = "col_5 right">
                    		<?php echo form_label("Inicio de entrega de documentos","inicioEntrega");?>
                    		<?php echo form_input($inicioEntrega);?>
                    	</div>
                    	<div class = "col_5 right">
                    		<?php echo form_label("Termino  de entrega de documentos","finEntrega");?>
                    		<?php echo form_input($finEntrega);?>
                    	</div>
                    	<div class = "col_1"></div>
                    </div>
                    <br>
                    <br>
                    <?php echo form_input($boton)?>
                     <?php echo form_close() ?>
                </fieldset>
            </div>
            <div class="col_2"></div>
            <div class="clearfix"></div>
            
            <div class="col_2 center"></div>
            <div class="col_8 center">
                <div class="col_12">
                    <fieldset>
                        <legend>Periodos Registrados</legend>

                        <div class="col_12">
                            <table class="sortable" cellspacing="0" cellpadding="0">
                                <thead><tr>
                                    <th>Periodo</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Fecha de término</th>
                                    <th>Inicio de evaluación</th>
                                    <th>Término de evaluación</th>
                                    <th>Inicio de entrega de documentos</th>
                                    <th>Término de entrega de documentos</th>
                                    <th>Opciones</th>
                                </tr></thead>
                                <tbody id = "ultimoPeriodo"></tbody>
                                <tbody id = "periodos">
                                </tbody>
                            </table>    
                        </div>

                    </fieldset>    
                </div>
            </div>
            
       </div>
    </div>
</body>








