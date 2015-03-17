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
	                               	            	
		            	<div class="col_4"><label for="text1">RFC</label></div>
						<input id="rfc" type="text" />
						<br>
						<br>
						<div class="col_4"><label for="text1">Nombre</label></div>
		            	<input id="nombre" type="text" />
						<br>
						<br>
						
						<div class="col_4"><label for="text1">Apellido Paterno</label></div>
		            	<input id="apaterno" type="text" />
						<br>
						<br>
						
						<div class="col_4"><label for="text1">Apellido Materno</label></div>
		            	<input id="amaterno" type="text" />
						<br>
						<br>
						
						<div class="col_4"><label for="text1">E-mail</label></div>
						<input id="correo" type="text" />
						<br>
						<br>
						
						<div class="col_4"><label for="text1">Contrase&ntilde;a</label></div>
						<input id="pass" type="password" />
						<br>
						<br>
						
						<div class="col_4"><label for="text1">Repetir contrase&ntilde;a</label></div>
						<input id="repass" type="password" />
						<br>
						<br>
	                
                  
	                    <button class="blue" id="boton">Guardar Profesor</button>
	                    <br>
	                                       
	      
	                </fieldset>
	            </div>
	        </div>        	
        
        
        
        
        <div class="col_3"></div>
        </div>
	
	</div>
</body>
<script type="text/javascript" src="<?= base_url() ?>js/nuevo_profesor.js"></script>