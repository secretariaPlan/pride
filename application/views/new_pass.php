<body>
    <div class="grid">
        <div class="col_4"></div>
        <div class="col_4">
        	
        
            <div class="center">
            	

            	
            	<div class="notice error" id="mensaje1" style="display: none;">
            		<i class="fa fa-remove fa-large"></i> 
            		Contrase&ntilde;a no valida 
					<a href="#close" class="fa fa-remove"></a>
				</div>
            	
            	
            	<div class="notice error" id="mensaje2" style="display: none;">
            		<i class="fa fa-remove fa-large"></i> 
            		Repita la Contrase&ntilde;a 
					<a href="#close" class="fa fa-remove"></a>
				</div>
            	
            	
            	<div class="notice success" id="mensajeok" style="display: none;">
            		<i class="fa fa-check fa-large"></i>
            		Su contrase&ntilde;a se guardo correctamente
					<a href="#close" class="fa fa-remove"></a>
				</div>
            	
                <fieldset id="nueva">
                    <label>Contrase&ntilde;a nueva</label>
                    <br>
                    <input id="pass" type="password"/>
                    <br>
                    <br>
                    <label>Confirme  la nueva contrase&ntilde;a</label>
                    <br>
                    <input id="repass" type="password"/>
                    <br>
                    <br>
                    <button class="blue" id="boton">Cambiar Contrase&ntilde;a</button>
                    <br>
                                       
      
                </fieldset>
            </div>
        </div>
        <div class="col_4"></div>
    </div>
</body>
<script type="text/javascript" src="<?= base_url() ?>js/new_pass.js"></script>