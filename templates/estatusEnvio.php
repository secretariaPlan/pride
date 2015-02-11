<?php
//para mostrar el resultado de una solicitud, como una banda superior
//estatus debe ser un parametro 1 ok, 0 mal o puede no venir y no causa nigun efecto
$estado = "";
if (isset($_REQUEST["estatus"]))
{
	$estado = '<div class="renglonverde"><img src="imagenes/flechaverde.gif" width="27" height="27" align="absmiddle">
          Agradecemos su atención, su mensaje fue enviado correctamente.</div>';
	if($_REQUEST["estatus"] == 0)
		$estado = '<div class="renglorojo"><img src="imagenes/error.gif" width="30" height="30" align="absmiddle">No se pudo enviar el mensaje</div>';
}
echo $estado;

?>