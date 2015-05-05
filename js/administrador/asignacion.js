function asignaEvaluadorEvaluado(idEvaluador,idEvaluado){
    var parametros = {
        idEvaluador:idEvaluador,
        idEvaluado:idEvaluado
    }
    $.ajax({
        data: parametros,
        url: "evaluador_evaluado/asignaEvaluadoAEvaluador",
        type: "POST",
        beforeSend: function(){},
        success: function(response){
            var respuesta = $.parseJSON(response);
            $("#alerta").show();
            $("#alerta").addClass("notice error");
            $('html, body').animate({scrollTop: '0px'},"fast");
            $("#alerta>p").html(respuesta.mensaje);
            
            setTimeout(function(){
                     $("#alerta").hide();
                },2000);
        }
    });
}

function evaluadosAsignadosAEvaluador(idevaluador){
     var tabla = '<tr>' + 
                        '<td>' + nombreEvaluado + '</td>' + 
                        '<td><button class="red small desasignar tooltip" title = "Desasignar profesor"><i class="fa fa-remove"></i></button></td>'
                    '</tr>';
        
        $("#asignados").append(tabla);
}

$(document).ready(function () {
    //Obtiene el evaluador
    $("#evaluador").autocomplete({
        source:"administrador/busquedaEvaluadorPorNombre",
        //source:data;
        minLength: 3,
        select: function(event,ui){
        	$("#evaluador").val(ui.item.nombre);
            $('input[name="idEvaluador"]').val(ui.item.idEvaluador);
            $('input[name="nombreEvaluador"]').val(ui.item.nombre);
            return false;
        }
     }).data( "autocomplete" )._renderItem = function( ul, item ) {
    	return $( "<li></li>" )
			.data( "item.autocomplete", item )
			.append( "<a><strong>" + item.rfc + "</strong> / " + item.nombre + "</a>" )
			.appendTo( ul );
		};
    //Obtiene el evaluado
    $("#evaluado").autocomplete({
        source:"administrador/busquedaEvaluadoPorNombre",
        //source:data;
        minLength: 3,
        select: function(event,ui){
            $("#evaluado").val(ui.item.nombre);
            $('input[name="idEvaluado"]').val(ui.item.idEvaluado);
            $('input[name="nombreEvaluado"]').val(ui.item.nombre);
            return false;
        }
     }).data( "autocomplete" )._renderItem = function( ul, item ) {
		return $( "<li></li>" )
			.data( "item.autocomplete", item )
			.append( "<a><strong>" + item.rfc + "</strong> / " + item.nombre + "</a>" )
			.appendTo( ul );
		};
    
    $("#asignar").click(function(){
        var idEvaluador = $('input[name="idEvaluador"]').val();
        //var nombreEvaluador = $('input[name="nombreEvaluador"]').val();
        var idEvaluado = $('input[name="idEvaluado"]').val();
        var nombreEvaluado = $('input[name="nombreEvaluado"]').val();
        asignaEvaluadorEvaluado(idEvaluador,idEvaluado);
        
        $("#evaluado").val("");
        
    });

    
});