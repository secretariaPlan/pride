<script src="<?php echo base_url();?>js/administrador/listaEvaluadoresEvaluados.js" ></script>
<body>
	<div class="grid flex">
		<div class="col_12">
			<div class="col_2"></div>
			<div class="col_8 center">
				<fieldset>
					<legend>Lista de Evaluados</legend>
					<br>
					<br>
					<table class="stripped" cellspacing="0" cellpadding="0">
						<thead>
							<tr>
								<th>RFC</th>
								<th width = 30%>Nombre</th>
								<th>Opciones</th>
							</tr>
						</thead>	
						<tbody>
							<?php
								foreach ($lista as $evaluado) {
									echo "<tr id='".$evaluado["idUsuario"]."''>";
										echo "<td>".$evaluado["rfc"]."</td>";
										echo "<td>".$evaluado["nombre"]."</td>";
										echo "<td id='pass_".$evaluado["idUsuario"]."' class='center'><button class='pass blue pop'><i class='fa fa-pencil'></i> Cambiar Contraseña</button></td>";
									echo"</tr>";
								}
							?>	
						</tbody>	
					</table>
				</fieldset>	
			</div>
			<div class="col_2"></div>
		</div>
	</div>
</body>