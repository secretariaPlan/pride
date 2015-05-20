function asignaEvaluadorEvaluado(idEvaluador,idEvaluado){
    var parametros = {
        idEvaluador:idEvaluador,
        idEvaluado:idEvaluado
    }
    $.ajax({
        data: parametros,
        url: "../evaluador_evaluado/asignaEvaluadoAEvaluador",
        type: "POST",
        beforeSend: function(){},
        success: function(response){
            var respuesta = $.parseJSON(response);
            console.log(respuesta);
            $("#alerta").removeClass();
            if(respuesta.status){
                $("#alerta").addClass("notice success");
            } 
            else{
                 $("#alerta").addClass("notice error");
            }
            $("#alerta>p").html(respuesta.mensaje);
            $("#alerta").show();
            $('html, body').animate({scrollTop: '0px'},"fast");
            setTimeout(function(){
                     $("#alerta").hide();
                },2000);
        }
    });
}

function evaluadosAsignadosAEvaluador(idevaluador){
    var tabla ="";
    var parametros = {
        idEvaluador:idevaluador
    }
    $.ajax({
        data: parametros,
        url: "evaluadosAsignados",
        type: "POST",
        beforeSend: function(){},
        success: function(response){
            var respuesta = $.parseJSON(response);
            //console.log(response);
            $("#asignados").html("");
            if(respuesta.respuesta.exito){
                $.each(respuesta.datos,function(index){
                tabla += "<tr id='" + respuesta.datos[index].id_evaluado + "'>" + 
                            "<td>" + respuesta.datos[index].nombre + "</td>" + 
                            "<td><button class='red small desasignar tooltip'' title = 'Desasignar profesor'><i class='fa fa-remove'></i></button></td>" +
                        "</tr>";
                }); 
                $("#asignados").html(tabla);
            }
                  
        }
    });
}

function desasignar(idEvaluador,idEvaluado){
    var parametros={
        idEvaluador:idEvaluador,
        idEvaluado:idEvaluado
    }
    $.ajax({
        data:parametros,
        url:"../evaluador_evaluado/desasignar",
        type: "POST",
        beforeSend: function(){},
        success: function(response){
            var respuesta = $.parseJSON(response);
            console.log(respuesta);
            $("#alerta").removeClass();
            $("#alerta").addClass("notice success");
            $("#alerta>p").html(respuesta.respuesta.mensaje);
            $("#alerta").show();
            $('html, body').animate({scrollTop: '0px'},"fast");
            setTimeout(function(){
                     $("#alerta").hide();
                },2000);
        }
    });
}

$(document).ready(function () {
    
    $("#evaluador").on("change keyup copy paste cut", function(){
        
        if($("#evaluador").val().length < 5 && $('input[name="idEvaluador"]').val() ){
            $("#evaluador").val("");
            $("#evaluado").val("");
            $('input[name="idEvaluador"]').val("");
            $('input[name="idEvaluado"]').val("");
            $('input[name="nombreEvaluador"]').val("");
            $('input[name="nombreEvaluado"]').val("");
            $("#asignados").html("");     
        }
        
    });
    
    $("#evaluado").on("change keyup copy paste cut", function(){
        
        if($("#evaluado").val().length < 5 && $('input[name="idEvaluado"]').val() ){
            
            $("#evaluado").val("");
            $('input[name="idEvaluado"]').val("");
            $('input[name="nombreEvaluado"]').val("");
        }
        
    });
    
    //Obtiene el evaluador
    $("#evaluador").autocomplete({
        source:"busquedaEvaluadorPorNombre",
        //source:data;
        minLength: 3,
        select: function(event,ui){
        	$("#evaluador").val(ui.item.nombre);
            $('input[name="idEvaluador"]').val(ui.item.idEvaluador);
            $('input[name="nombreEvaluador"]').val(ui.item.nombre);
            evaluadosAsignadosAEvaluador(ui.item.idEvaluador);
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
        source:"busquedaEvaluadoPorNombre",
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
    //Asigna el profesor
    $("#asignar").click(function(){
        var idEvaluador = $('input[name="idEvaluador"]').val();
        var nombreEvaluador = $('input[name="nombreEvaluador"]').val();
        var idEvaluado = $('input[name="idEvaluado"]').val();
        var nombreEvaluado = $('input[name="nombreEvaluado"]').val();
        asignaEvaluadorEvaluado(idEvaluador,idEvaluado);
        setTimeout(function(){
                     evaluadosAsignadosAEvaluador(idEvaluador);
                },500);
        $("#evaluado").val("");
        $('input[name="idEvaluado"]').val("");
        $('input[name="nombreEvaluado"]').val("");
        
    });
    
    //Desasignar el profesor
    $(document).on("click",".desasignar",function(){
        var idEvaluador = $('input[name="idEvaluador"]').val();
        var idEvaluado = $(this).closest("tr").attr("id");
        desasignar(idEvaluador,idEvaluado);
        setTimeout(function(){
                     evaluadosAsignadosAEvaluador(idEvaluador);
                },500);
        
    });
    
});