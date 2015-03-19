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
	                
		                <?= form_open("administrador/recibirDatos")?>
		            	<?
		            		$boton = array(
		            			'class' => 'blue',
		            			'id' => 'boton',
								'name' => 'submit',
		            			'type' => 'submit',
		            			'content' => 'Guardar Profesor'
		            			
		            		);
		            	
		            		$rfc = array(
		            			'id' => 'rfc',
		   						'class' => 'datosProfesor',
								'required'       => 'required',
		            			'placeholder' => 'Ingresa el RFC'	
		            				 
		            		);
		            		
		            		$nombre = array(
		            				'id' => 'nombre',
		            				'class' => 'datosProfesor',
		            				'required'       => 'required',
		            				'placeholder' => 'Ingresa el Nombre'
		            		);
		            		
		            		$apaterno = array(
		            				'id' => 'apaterno',
		            				'class' => 'datosProfesor',
		            				'required'       => 'required',
		            				'placeholder' => 'Ingresa el Apellido Paterno'
		            		);
		            		
		            		$amaterno = array(
		            				'id' => 'amaterno',
		            				'class' => 'datosProfesor',
		            				'required'       => 'required',
		            				'placeholder' => 'Ingresa el Apellido Materno'
		            		);
		            		
		            		$correo = array(
		            				'id' => 'correo',
		            				'class' => 'datosProfesor',
		            				'required'       => 'required',
		            				'placeholder' => 'Ingresa el Correo Electronico'
		            		);
		            		
		            		$password = array(
		            				'id' => 'password',
		            				'class' => 'datosProfesor',
		            				'type' => 'password',
		            				'required'       => 'required',
		            				'placeholder' => 'Ingresa la contrase&ntilde;a'
		            				
		            		);
		            		
		            		
		            		$repass = array(
		            				'id' => 'repass',
		            				'class' => 'datosProfesor',
		            				'type' => 'password',
		            				'required'       => 'required',
		            				'placeholder' => 'Repita la contrase&ntilde;a'
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