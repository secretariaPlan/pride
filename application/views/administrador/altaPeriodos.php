<?php
$year = array(
		"id" => "year",
		"name" => "year",
		"type" => "text",
		"value" => date("Y"),
		"size" => "5",
		"readonly"=>"true"
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
		"placeholder" => "Elija una fecha"
);

$finPeriodo = array(
		"id" => "finPeriodo",
		"class" => "fecha",
		"name" => "finPeriodo",
		"type" => "text",
		"placeholder" => "Elija una fecha"
);

$inicioEvaluacion = array(
		"id" => "inicioEvaluacion",
		"class" => "fecha",
		"name" => "inicioEvaluacion",
		"type" => "text",
		"placeholder" => "Elija una fecha"
);

$finEvaluacion = array(
		"id" => "finEvaluacion",
		"class" => "fecha",
		"name" => "finEvaluacion",
		"type" => "text",
		"placeholder" => "Elija una fecha"
);

$inicioEntrega = array(
		"id" => "inicioEntrega",
		"class" => "fecha",
		"name" => "inicioEntrega",
		"type" => "text",
		"placeholder" => "Elija una fecha"
);

$finEntrega = array(
		"id" => "finEntrega",
		"class" => "fecha",
		"name" => "finEntrega",
		"type" => "text",
		"placeholder" => "Elija una fecha"
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
            
            <div class="col_2"></div>
            <div class="col_8 center">
                <div class="col_12">
                    <fieldset>
                        <legend>Periodos Registrados</legend>
                        <div class="col_3"></div>
                        <div class="col_6">
                            <table class="sortable" cellspacing="0" cellpadding="0">
                                <thead>
                                    <th>Periodo</th>
                                    <th>Opciones</th>
                                </thead>
                                <tbody id = "ultimoPeriodo">
                                <tbody id = "periodos">
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








