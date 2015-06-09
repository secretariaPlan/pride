<!-- Menu Horizontal -->
<div class="center">	
	<ul class="menu">
		<li><a href="<?php echo site_url('administrador/asignacion')?>">Asignaci&oacute;n de Profesores</a></li>
		<li><a href="#">Profesores</a>
			<ul>
				<li><a href="<?php echo site_url('administrador/altaProfesores')?>">Alta Profesores</a></li>
				<li><a href="<?php echo site_url('administrador/nuevoProfesor')?>">Nuevo Profesor</a></li>
			</ul>
		</li>
        
        <li><a href="#">Evaluadores</a>
			<ul>
				<li><a href="<?php echo site_url('administrador/nombrarEvaluador')?>">Nombrar Evaluadores</a></li>
				<li><a href="<?php echo site_url('administrador/importarEvaluadores')?>">Importar Evaluadores</a></li>
			</ul>
            
		</li>
		
		<li><a href="#">Evaluados</a>
			<ul>
				<li><a href="<?php echo site_url('administrador/nombrarEvaluado')?>">Nombrar Evaluados</a></li>
			</ul>
            
		</li>
        
        <li><a href="#">Periodos</a>
			<ul>
				<li><a href="<?php echo site_url('administrador/altaPeriodos')?>">Alta Periodos</a></li>
			</ul>
		</li>
		<li><a href="<?php echo site_url('administrador/cerrarSesion')?>"><i class="fa fa-cog"></i> Salir </a></li>
	</ul>
</div>	