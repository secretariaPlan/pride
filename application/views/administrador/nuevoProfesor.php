<body>
	<div class="grid">
		
		<div class="col_3"></div>
        
        <div class="col_5">
        
        	
	 		<div class="center">
	            	
	
	
	
	            	
	            	<div class="notice error" id="error" style="display: none;">
	            		<i class="fa fa-remove fa-large"></i> 
	            		
						<a href="#close" class="fa fa-remove"></a>
					</div>
	            	
	            	
	            	
	            	
	            	
	            	<div class="notice success" id="mensaje" style="display: none;">
	            		<i class="fa fa-check fa-large"></i>
	            		
						<a href="#close" class="fa fa-remove"></a>
					</div>
	            	
	            	
	            	
	            
	            	
	            	
	            	
	            	
	            	
	                <fieldset id="nuevoProfesor">
	                	 <?php echo form_open('administrador/registrar_profesor'); ?>
		            	<?
		            		$boton = array(
		            			'class' => 'blue',
		            			'id' => 'boton',
								'name' => 'submit_reg',
		            			'type' => 'submit',
		            			'content' => 'Guardar Profesor'
		            			
		            		);
		            	
		            		$rfc = array(
		            			'id' => 'rfc',
		            				'name' => 'rfc',
								'required'       => 'required',
		            			'placeholder' => 'Ingresa el RFC',
		            		
		            			'onkeyup' => 'javascript:this.value=this.value.toUpperCase()',
		            			'value' => set_value('rfc'),
		            				 
		            		);
		            		
		            		$nombre = array(
		            				'id' => 'nombre',
		            				'name' => 'nombre',
		            				'class' => 'datosProfesor',
		            				'required'       => 'required',
		            				'placeholder' => 'Ingresa el Nombre',
		            				'value' => set_value('nombre'),
		            		);
		            		
		            		$apaterno = array(
		            				'id' => 'apaterno',
		            				'name' => 'apaterno',
		   						'class' => 'datosProfesor',
								'required'       => 'required',
		            			'placeholder' => 'Ingresa el Apellido Paterno',
		            			'value' => set_value('apaterno'),
		            		);
		            		
		            		$amaterno = array(
		            				'id' => 'amaterno',
		            				'name' => 'amaterno',
		   						'class' => 'datosProfesor',
								'required'       => 'required',
		            			'placeholder' => 'Ingresa el Apellido Materno',
		            			'value' => set_value('amaterno'),
		            		);
		            		
		            		$correo = array(
		            				'id' => 'correo',
		            				'name' => 'correo',
		   						'class' => 'datosProfesor',
								'required'       => 'required',
		            			'placeholder' => 'Ingresa Correo Electronico',
		            			'value' => set_value('correo'),
		            		);
		            		
		            		$password = array(
		            				'id' => 'password',
		            				'name' => 'password',
		   						'class' => 'datosProfesor',
								'required'       => 'required',
		            				'type' 		 => 'password',
		            			'placeholder' => 'Ingresa la contrase&ntilde;a',
		            			'value' => set_value('password'),
		            				
		            				
		            		);
		            		
		            		
		            		$repass = array(
		            				'id' => 'repass',
		            				'name' => 'repass',
		   						'class' => 'datosProfesor',
								'required'       => 'required',
		            				'type' 		 => 'password',
		            			'placeholder' => 'Ingresa la contrase&ntilde;a',
		            			'value' => set_value('repass'),
		            				
		            		);
		            	
		            	?>
		            	
		            	
		            	<div class="col_4"><?= form_label('RFC: ', 'rfc')?></div>
							<?= form_input($rfc)?>
							<br>
							<br>
							<div class="col_4"><?= form_label('Nombre: ', 'nombre')?></div>
			            	<?= form_input($nombre)?>
							<br>
							<br>
							
							<div class="col_4"><?= form_label('Apellido Paterno: ', 'apaterno')?></div>
			            	<?= form_input($apaterno)?>
							<br>
							<br>
							
							<div class="col_4"><?= form_label('Apellido Materno: ', 'amaterno')?></div>
			            	<?= form_input($amaterno)?>
							<br>
							<br>
							
							<div class="col_4"><?= form_label('Correo: ', 'correo')?></div>
							<?= form_input($correo)?>
							<br>
							<br>
							
							<div class="col_4"><?= form_label('Contrase&ntilde;a: ', 'password')?></div>
							<?= form_input($password)?>
							<br>
							<br>
							
							<div class="col_4"><?= form_label('Repetir contrase&ntilde;a: ', 'repass')?></div>
							<?= form_input($repass)?>
							<br>
							<br>
		                
		                    <?= form_button($boton) ?>
		                    <br>
		 
		            	<?= form_close()?>

	                                       
	      
	                </fieldset>
	            </div>
	        </div>        	
        
        
        
        
        <div class="col_3"></div>
        </div>
	
	</div>
</body>
<script type="text/javascript" src="<?= base_url() ?>js/nuevo_profesor.js"></script>