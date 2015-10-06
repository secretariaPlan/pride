<script type="text/javascript" src="<?php echo base_url()?>js/valida.js"></script>
<script type="text/javascript"
	src="<?php echo base_url()?>js/jquery.filter_input.js"></script>
<body>
	<div class="grid flex">
		<div class="col_4"></div>
		<div class="col_4">
			<div class="center">


				<div class="notice error" id="error" style="display: none;">
					<i class="fa fa-remove fa-large"></i> <a href="#close"
						class="fa fa-remove"></a>
				</div>
	            	
	            	
	            	
	            	<?php
														if (isset ( $mensaje )) {
															echo "<div class='notice success' id='mensaje' >" . $mensaje . "<i class='fa fa-check fa-large'></i><a href='#close' class='fa fa-remove'></a></div>";
														}
														?>

	            	
	                <fieldset id="nuevoProfesor">
	                	 <?php echo form_open('admin/administrador/nuevoProfesor'); ?>
		            	<?php
															$boton = array (
																	'class' => 'blue',
																	'id' => 'boton',
																	'name' => 'submit_reg',
																	'type' => 'submit',
																	'content' => 'Guardar Profesor' 
															)
															;
															
															$rfc = array (
																	'id' => 'rfc',
																	'name' => 'rfc',
																	'class' => 'datosProfesor',
																	'required' => 'required',
																	'pattern' => "\S{13}",
																	'placeholder' => 'Ingresa el RFC',
																	'onkeyup' => 'javascript:this.value=this.value.toUpperCase()',
																	'value' => set_value ( 'rfc' ) 
															)
															;
															
															$nombre = array (
																	'id' => 'nomprofe',
																	'name' => 'nombre',
																	'class' => 'datosProfesor',
																	'required' => 'required',
																	'placeholder' => 'Ingresa el Nombre',
																	'value' => set_value ( 'nombre' ) 
															);
															
															$apaterno = array (
																	'id' => 'apaterno',
																	'name' => 'apaterno',
																	'class' => 'datosProfesor',
																	'required' => 'required',
																	'placeholder' => 'Ingresa el Apellido Paterno',
																	'value' => set_value ( 'apaterno' ) 
															);
															
															$amaterno = array (
																	'id' => 'amaterno',
																	'name' => 'amaterno',
																	'class' => 'datosProfesor',
																	'required' => 'required',
																	'placeholder' => 'Ingresa el Apellido Materno',
																	'value' => set_value ( 'amaterno' ) 
															);
															
															$correo = array (
																	'id' => 'correo',
																	'name' => 'correo',
																	'class' => 'datosProfesor',
																	'required' => 'required',
																	'placeholder' => 'Ingresa Correo Electronico',
																	'value' => set_value ( 'correo' ) 
															);
															
															$password = array (
																	'id' => 'password',
																	'name' => 'password',
																	'class' => 'datosProfesor',
																	'required' => 'required',
																	'type' => 'password',
																	'placeholder' => 'Ingresa la contrase&ntilde;a',
																	'value' => set_value ( 'password' ) 
															)
															;
															
															$repass = array (
																	'id' => 'repass',
																	'name' => 'repass',
																	'class' => 'datosProfesor',
																	'required' => 'required',
																	'type' => 'password',
																	'placeholder' => 'Ingresa la contrase&ntilde;a',
																	'value' => set_value ( 'repass' ) 
															)
															;
															
															?>
		            	
		            	
		            	<div class="col_5"><?php echo form_label('RFC: ', 'rfc')?></div>
							<?php echo form_input($rfc)?>
							<br>
					<div id="rfcval" style="display: none;"></div>
					<br>
					<div class="col_5"><?php echo form_label('Nombre: ', 'nomprofe')?></div>
			            	<?php echo form_input($nombre)?>
							<br> <br>

					<div class="col_5"><?php echo form_label('Apellido Paterno: ', 'apaterno')?></div>
			            	<?php echo form_input($apaterno)?>
							<br> <br>

					<div class="col_5"><?php echo form_label('Apellido Materno: ', 'amaterno')?></div>
			            	<?php echo form_input($amaterno)?>
							<br> <br>

					<div class="col_5"><?php echo form_label('Correo: ', 'correo')?></div>
							<?php echo form_input($correo)?>
							<br> <br>

					<div class="col_5"><?php echo form_label('Contrase&ntilde;a: ', 'password')?></div>
							<?php echo form_input($password)?>
							<br> <br>

					<div class="col_5"><?php echo form_label('Repetir contrase&ntilde;a: ', 'repass')?></div>
							<?php echo form_input($repass)?>
							<br> <br>
		                
		                    <?php echo form_button($boton)?>
		                    <br>
		 
		            	<?php echo form_close()?>
	                </fieldset>

			</div>
		</div>
		<div class="col_4"></div>
	</div>
</body>
<script type="text/javascript"
	src="<?php echo base_url()?>js/nuevo_profesor.js"></script>