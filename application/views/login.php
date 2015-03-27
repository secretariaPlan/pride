<?php

	if(isset($error)){
		echo "<div class='center'><strong style='color:red;'>".$error."</strong></div>";
	}
	$rfc = array(
		"id" => "rfc",
		"name" => "rfc",
		"required" => "required",
		"placeholder" => "RFC con homoclave",
					
	);
	
	$pass = array(
			"id" => "pass",
			"name" =>  "pass",
			"type" => "password",
			"required" => "required",
			"placeholder" => "Contrase&ntilde;a"
	);
	
	$boton_ingresa = array(
			"id" => "boton",
			"class" => "blue",
			"name" => "boton",
			"type" => "submit",
			"content" => "Ingresar"
	);
?>
<body>
    <div class="grid flex">
        <div class="col_4"></div>
        <div class="col_4">
            <div class="center">
                <fieldset>
                	<legend>Ingreso al sistema</legend>
                	<?php echo form_open("login/ingresa"); ?>
                		<?php echo form_label("RFC","rfc")?>
	                    <br>
	                    <?php echo form_input($rfc)?>
	                    <br>
	                    <br>
	                    <?php echo form_label("Contrase&ntilde;a","pass");?>
	                    <br>
	                    <?php echo form_input($pass); ?>
	                    <br>
	                    <br>
	                    <?php echo form_button($boton_ingresa)?>
                    <?php echo form_close()?>
                    <br>
                    <div class="col_12 right">
                        <a href="<?php echo site_url('recovery_pass')?>">¿Olvido su contrase&ntilde;a?</a>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="col_4"></div>
    </div>
</body>