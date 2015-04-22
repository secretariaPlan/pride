        
        <div class="col_4"></div>
        <div class="col_4 center">
        
<?php
if(isset($error)){
	echo "<div class='notice error'><i class='icon-remove-sign icon-large'></i>" . $error . "<a href='#close' class='icon-remove'></a></div>";
}
if(isset($exito)){
	echo "<div class='notice success'>" . $exito . "<i class='fa fa-check fa-large'></i><a href='#close' class='fa fa-remove'></a></div>";
}
$contador = 0;
?>
</div>



<body>
    <div class="grid flex">
    
    <div class="col_3"></div>
    
    <div id="pasos">
	    <div class="col_6 center visible ">
	    <!-- Warning -->
	        	<div class="notice warning"><i class="fa fa-warning fa-large"></i> 
	        	Solo puedes cargar Archivos con formato CSV<br>
		EJEMPLO: "profesores.csv" 
		<a href="#close" class="fa fa-remove"></a></div>
				
					<h5>Pasos para cargar a los profesores correctamente</h5>
					<ol align="left">
						<li>Genera tu tabla de datos en Excel como se muestra en la imagen<br>
						Nota: Recuerda usar los campos rfc, nombre, amaterno, pass, mail<br>
						<img src="<?php echo base_url('images/tabla1.png')?>">
						</li>
						<li>Guardalo en formato CSV (delimitado por comas)(*.csv)<br>
						<img src="<?php echo base_url('images/tabla2.png')?>">
						</li>
						<li>Presiona el boton "Seleccionar archivo" y el boton "Cargar Archivo"</li>
					</ol>
		</div>
    </div>    
        <div class="col_4"></div>
        <div class="col_4 center">
        	
			<h5>Cargar Archivo CSV</h5>
        
        	<?php if(!isset($datos)){ 
        		echo form_open_multipart("administrador/cargarCsv") ?>
	           	    <input type="file" name="userfile" value="archivo" />
	                <br>
	                <br>
	                <button class="blue" id="boton">Cargar archivo</button>
			<?php echo form_close();
        	}?>
        </div>
        <div class="col_4"></div>
       
        <div class="clear fix"></div>
        <?php if (isset($datos)) {
        	echo form_open("administrador/guardarDatos") 
        ?>
            <div class="col_2"></div>
	        <div class="col_8">
	        	<div class="col_12 center">
	        		<button class="blue center">Guardar registros</button>
	        	</div>
	            <table  cellspacing="0" cellpadding="0" class="striped">
	                <thead>
	                    <tr>
	                        <th>RFC</td>
	                        <th>Nombre</td>
	                        <th>Apellido paterno</th>
	                        <th>Apellido materno</th>
	                        <th>Contrase&ntilde;a</th>
	                        <th>Correo electronico</th>
	                        </tr>
	                </thead>
	            
	                <tbody id="datos">
	            	<?php foreach ($datos as $dato) {?>
	            		<tr>
	            			<td><input type="text" id="rfc-<?php echo $contador?>" name="rfc[<?php echo $contador ?>]" value="<?php echo $dato["rfc"] ?>" ></td>
	            			<td><input type="text" id="nombre-<?php echo $contador?>" name="nombre[<?php echo $contador ?>]" value="<?php echo $dato["nombre"] ?>" ></td>
	            			<td><input type="text" id="apaterno-<?php echo $contador?>"name="apaterno[<?php echo $contador ?>]" value="<?php echo $dato["apaterno"] ?>" ></td>
	            			<td><input type="text" id="amaterno-<?php echo $contador?>" name="amaterno[<?php echo $contador ?>]" value="<?php echo $dato["amaterno"] ?>" ></td>
	            			<td><input type="password" id="pass-<?php echo $contador?>" name="pass[<?php echo $contador ?>]" value="<?php echo $dato["pass"] ?>" ></td>
	            			<td><input type="text" id="correo-<?php echo $contador?>" name="correo[<?php echo $contador ?>]" value="<?php echo $dato["mail"] ?>" ></td>
	            		</tr>
	            	<?php $contador++; }?>
	                </tbody>
	            </table>
	        </div>
	        <div class="col_2"></div>
			        
        <?php echo form_close(); 
        }?>
    </div>
</body>
<script type="text/javascript"
	src="<?php echo base_url()?>js/cargar_csv.js"></script>