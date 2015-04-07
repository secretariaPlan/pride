<script type="text/javascript" src="<?php echo base_url()?>js/valida.js"></script>
<?php

	if(isset($error)){
		echo "<div class='center'><strong style='color:red;'>".$error."</strong></div>";
	}
	$email = array(
		"id" => "email",
		"name" => "email",
		"required" => "required",
		"placeholder" => "Correo Electr&oacute;nico",
					
	);
	
	$reemail = array(
			"id" => "reemail",
			"name" =>  "reemail",
			"type" => "text",
			"required" => "required",
			"placeholder" => "Repita su Correo Electr&oacute;nico"
	);
	
	$boton_enviar= array(
			"id" => "boton",
			"class" => "blue",
			"name" => "boton",
			"type" => "submit",
			"content" => "Enviar Contrase&ntilde;a"
	);
?>
<body>
    <div class="grid flex">
        <div class="col_4"></div>
        <div class="col_4">
            <div class="center">
            	
            	<div class="notice error" id="mensaje1" style="display: none;">
            		<i class="fa fa-remove fa-large"></i> 
            		Correo Electronico no valido 
					<a href="#close" class="fa fa-remove"></a>
				</div>
            	
            	
            	<div class="notice error" id="mensaje2" style="display: none;">
            		<i class="fa fa-remove fa-large"></i> 
            		Repita el Correo Electronico 
					<a href="#close" class="fa fa-remove"></a>
				</div>
            	
            
                <fieldset>
                	<legend>Recuperar Contrase&ntilde;a</legend>
                	<?php echo form_open("recovery_pass/recuperar"); ?>
                		<?php echo form_label("Correo","email")?>
	                    <br>
	                    <?php echo form_input($email)?>
	                    <br>
	                    <br>
	                    <?php echo form_label("Repita su Correo","reemail");?>
	                    <br>
	                    <?php echo form_input($reemail); ?>
	                    <br>
	                    <br>
	                    <?php echo form_button($boton_enviar)?>
                    <?php echo form_close()?>
                    <br>
                    <div class="col_12 right">
                        <a href="<?php echo site_url()?>">Regresar</a>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="col_4"></div>
    </div>
</body>
<script type="text/javascript" src="<?php echo base_url()?>js/recovery_pass.js"></script>