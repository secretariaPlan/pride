<?php
if(isset($error)){
	echo "Algo";
    echo "<strong style='color:red;'>".$error."</strong>";
}

if(isset($datos)){
	//print_r($datos);
}
$contador = 0;
?>


<body>
    <div class="grid flex">
        
        <div class="col_4"></div>
        <div class="col_4 center">
        	<?php echo form_open_multipart("administrador/cargarCsv") ?>
           <!-- <form action="<?php //echo site_url("administrador/cargarCsv") ?>" method="post" enctype="multipart/form-data">-->
			    <input type="file" name="userfile" value="archivo" />
                <br>
                <br>
                <button class="blue">Cargar archivo</button>
			 <!--</form>-->
			 <?php echo form_close()?>
        </div>
        <div class="col_4"></div>
       
        <div class="clear fix"></div>
        <?php if (isset($datos)) {
        	echo form_open("administrador/guardarDatos") 
        ?>
            <div class="col_2"></div>
	        <div class="col_8">
	            <table  cellspacing="0" cellpadding="0" class="striped">
	                <thead>
	                    <tr>
	                        <th>RFC</td>
	                        <th>Nombre</td>
	                        <th>Apellido paterno</th>
	                        <th>Apellido materno</th>
	                        <th>Contrase&ntilde;a</th>
	                        <th>Correo electronico</th>
	                        <th>Opciones</th>
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
	            			<td><input type="text" id="correo-<?php echo $contador?>" name="correo[<?php echo $contador ?>]" value="<?php echo $dato["email"] ?>" ></td>
	            			<td></td>
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
