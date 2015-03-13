<body>
    <div class="grid flex">
        <div class="col_4"></div>
        <div class="col_4">

				<br>
        		<br>
        
				        <!-- Periodo de Alta -->
        <div id = "fechaAlta" style="display:none">
        	
        	<!-- boton -->
        	   	<div class="center">
	        		  <button class="blue" id="boton1">Nuevo Periodo</button>
	        	</div>
        	<!-- Fin del Boton -->
        	
        	<!-- contenido -->
        	 <div id="contenidoPeriodo" style="display: none;"> 
	         	<div class="center">
	                    <fieldset>
	                    <br>
						<label for="ano">A&ntilde;o</label>
						<input id="ano" type="text" placeholder="Ingrese el A&ntilde;o">
						<br>
						<br>
						<label for="numero">N&uacute;mero</label>
						<select id="numero">
						<option value="0">-- Seleccione el N&uacute;mero --</option>
						<option value="1">1</option>
						<option value="2">2</option>
						</select>
						<br>
						<br>
	                    <button class="blue">Guardar Periodo</button>
	                    <br>
	                </fieldset>
	            </div>
	         </div>
        <!-- fin del contenido -->
        
        </div>
		<!-- Fin del periodo de alta -->
		
		
		<!-- Fecha donde no se puede dar de alta -->
		<div id = "fechaFin" style="display:none">
			En este momento no puede dar de alta un nuevo periodo
		</div>
		<!-- Fin de la fecha donde no puede dar de alta -->
        		
        		
       	
       
       
       
       
       
       
       
       </div> 		
    
    
    </div>



        

</body>
<script type="text/javascript" src="<?= base_url() ?>js/periodo.js"></script>