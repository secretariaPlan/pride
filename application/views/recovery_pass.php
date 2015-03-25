<body>
    <div class="grid">
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
            	
            	<form action="<?php echo site_url('recovery_pass/recuperar')?>">
                <fieldset>
                    <label>Correo Electr&oacute;nico</label>
                    <br>
                    <input id="email" type="text" placeholder="Correo Electr&oacute;nico"/>
                    <br>
                    <br>
                    <label>Repita su Correo Electr&oacute;nico</label>
                    <br>
                    <input id="reemail" type="text" placeholder="Repita su Correo Electr&oacute;nico"/>
                    <br>
                    <br>
                    <button class="blue" id="boton">Enviar Contrase&ntilde;a</button>
                    <br>
                    <div class="col_12 right">
                        <a href="<?php echo site_url()?>">Regresar</a>
                    </div>
                    
      
                </fieldset>
                </form>
            </div>
        </div>
        <div class="col_4"></div>
    </div>
</body>
<script type="text/javascript" src="<?= base_url() ?>js/recovery_pass.js"></script>