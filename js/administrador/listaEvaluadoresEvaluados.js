function cambiarContraseña(idUsuario,nuevoPass){
	//console.log(nuevoPass);
	var parametros={
        idUsuario:idUsuario,
        password:nuevoPass
    }
    $.ajax({
        data:parametros,
        url:"../usuario_controller/cambiarPassword",
        type: "POST",
        beforeSend: function(){},
        success: function(response){
            var respuesta = $.parseJSON(response);
            if(respuesta["exito"]){
            	alert("Contraseña cambiada correctamente");
            	location.reload();
            }
            // setTimeout(function(){
            //          $("#alerta").hide();
            //     },2000);
        }
    });
}

$(document).ready(function () {

	$(document).on('click','.pass', function(){
		var id = $(this).closest('tr').attr('id');
		var cambiar = 
		"<div class='col_12'>" +
			"<label>Nueva contraseña: </label><input id='password_"+id+"' type='password' />"+
			"<br>"+
			"<br>"+
			"<label>Confirmar contraseña: </label><input id='confirmar_"+id+"' type='password' />"+
			"<br>"+
			"<br>"+
			"<button class='guardar green' >Guardar</button>"+
		"</div>";

		$("#pass_"+id).html(cambiar);
	});

	$(document).on('click','.guardar', function(){
		var id = $(this).closest('tr').attr('id');
		if($("#password_"+id).val() == ""){
			alert("Ingrese una contraseña");
			$("#password_"+id).focus();
		}else if($("#confirmar_"+id).val() == ""){
			alert("Confirme la contraseña");
			$("#confirmar_"+id).focus();
		}else if($("#password_"+id).val() != $("#confirmar_"+id).val()){
			$("#password_"+id).val("");
			$("#confirmar_"+id).val("")
			alert("Las contraseñas no coinciden");
		}else if($("#password_"+id).val() == $("#confirmar_"+id).val()){
			cambiarContraseña(id,$("#password_"+id).val());
		}
	});
});