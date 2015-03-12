<body>
    <div class="grid flex">
        <div class="col_4"></div>
        <div class="col_4">
            <div class="center">
                <fieldset>
                    <label>RFC</label>
                    <br>
                    <input id="rfc" type="text" placeholder="RFC con homoclave"/>
                    <br>
                    <br>
                    <label>Contrase&ntilde;a</label>
                    <br>
                    <input id="pass" type="password" placeholder="Contrase&ntilde;a"/>
                    <br>
                    <br>
                    <button class="blue">Ingresar</button>
                    <br>
                    <div class="col_12 right">
                        <a href="<?php echo base_url().'recovery_pass'?>">¿Olvido su contrase&ntilde;a?</a>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="col_4"></div>
    </div>
</body>