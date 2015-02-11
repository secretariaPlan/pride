<?php
//para mostrar el resultado de una operacion, como una banda superior
//estatus debe ser un parametro 1 ok, 0 mal o puede no venir y no causa nigun efecto
$estado = "";
if (isset($_REQUEST["estatus"]))
{
	$estado = '<div class="renglonverde"><img src="imagenes/flechaverde.gif" width="27" height="27" align="absmiddle">
          Los datos se modificaron correctamente</div>';
	if($_REQUEST["estatus"] == 0)
		$estado = '<div class="renglorojo"><img src="imagenes/error.gif" width="30" height="30" align="absmiddle">No se guardaron los datos correctamente</div>';
}
echo $estado;

?>