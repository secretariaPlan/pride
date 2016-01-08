<?php
	if($seccion == "informacion")
		$informacion = "class = 'current'";
	if($seccion == "formacionT")
		$formacionT = "class = 'current'";
	if($seccion == "productividad")
		$productividad = "class = 'current'";
	if($seccion == "material")
		$material = "class = 'current'";
	if($seccion == "formacionR")
		$formacionR = "class = 'current'";
	if($seccion == "docencia")
		$docencia = "class = 'current'";
	if($seccion == "difusion")
		$difusion = "class = 'current'";
	if($seccion == "participacion")
		$participacion = "class = 'current'";
?>
<!-- Menu Horizontal -->
<div class="center">	
	<ul class="menu">
		<li <?php echo isset($informacion) ? $informacion : ""; ?>><a href="<?php echo site_url('evaluador_controller/informacionEvaluado')?>">Informacion general</a></li>
		<li <?php echo isset($formacionT) ? $formacionT : "" ;?>><a href="<?php echo site_url('evaluador_controller/formacionTrayectoriaAcademica')?>">Formaci&oacute;n y trayectoria acad&eacute;mica</a></li>
        <li <?php echo isset($productividad) ? $productividad : "" ?>><a href="<?php echo site_url('evaluador_controller/productividadAcademica')?>">Productividad acad&eacute;mica</a></li>
		<li <?php echo isset($material) ? $material :"" ?>><a href="<?php echo site_url('evaluador_controller/materialDocente')?>">Material docente</a></li>
        <li <?php echo isset($formacionR) ? $formacionR :"" ?>><a href="<?php echo site_url('evaluador_controller/formacionRecursosHumanos')?>">Formaci&oacute;n de recursos humanos</a></li>
        <li <?php echo isset($docencia) ? $docencia :"" ?>><a href="<?php echo site_url('evaluador_controller/docencia')?>">Docencia</a></li>
        <li <?php echo isset($difusion) ? $difusion :"" ?>><a href="<?php echo site_url('evaluador_controller/difusion')?>">Difusi&oacute;n</a></li>
        <li <?php echo isset($participacion) ? $participacion :"" ?>><a href="<?php echo site_url('evaluador_controller/participacionInstitucional')?>">Participaci&oacute;n institucional</a></li>
        <li <?php echo isset($lista) ? $lista :"" ?>><a href="<?php echo site_url('evaluador_controller/vistaListaEvaluados')?>">Lista de evaluados</a></li>
		<li><a href="<?php echo site_url('evaluador_controller/cerrarSesion')?>"><i class="fa fa-cog"></i> Salir </a></li>
	</ul>
</div>	