function nuevoComentario(idUsuario,idEvaluado,idSeccion,texto){
    var parametros = {
        idUsuario:idUsuario,
        idEvaluado:idEvaluado,
        idSeccion:idSeccion,
        texto:texto
    }
    
    $.ajax({
        data: parametros,
        url: "../comentario_controller/nuevoComentario",
        type: "POST",
        beforeSend: function(){},
        success: function(response){
            var respuesta = $.parseJSON(response);
            console.log(respuesta);
            $("#alerta").removeClass();
            if(respuesta.exito){
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

function cargarComentarios(idEvaluado,idSeccion){
    var parametros = {
        idEvaluado:idEvaluado,
        idSeccion:idSeccion,
    }

    $.ajax({
        data: parametros,
        url: "../comentario_controller/buscaComentarios",
        type: "POST",
        beforeSend: function(){},
        success: function(response){
            $("#historialComentarios").html("");
            var respuesta = $.parseJSON(response);
            console.log(respuesta);
            if(respuesta.exito){
                $("#botonMostrarComentarios").show();
                var tabla = "<table cellspacing='0' cellpadding='0'>";
                $.each(respuesta.respuesta,function(index){
                    tabla += "<tr>" +   
                                "<th>" + respuesta.respuesta[index].nombre + " escribió el " + respuesta.respuesta[index].fecha + " a las " + respuesta.respuesta[index].hora + "</th>" +
                            "</tr>" +
                            "<tr>" +
                                "<td>" + respuesta.respuesta[index].texto + "</td>" +
                            "</tr>";
                });
                tabla += "</tabla>";
                var comentarios = "<fieldset>" +
                                    "<legend class='center'>Historial de comentarios</legend>" +
                                    tabla +
                                "</fieldset>";
                $("#historialComentarios").html(comentarios);
            }
            
        }
    });
}

$(document).ready(function(){

    var idUsuario = $("#idUsuario").val();
    var idEvaluado = $("#idEvaluado").val();
    var idSeccion = $("#idseccion").val();

    cargarComentarios(idEvaluado,idSeccion);
    $("#historialComentarios").hide();
    $("#botonMostrarComentarios").hide();
    $("#comentario").hide();
    $("#comentario").html("<div class='col_12'>" +
                            "<textarea id='texto' class='col_12' placeholder='Agregue un comentario'></textarea>" +
                        "</div>" +
                        "<div class='col_12 center'>" +
                            "<button id='guardar' class='small green'>Guardar</button>"+
                        "</div>");
    $("#botonComentario").click(function(){
        $("#comentario").dialog({
            height:350,
            width:600,
            show: { effect: 'drop', direction: "up" },
            modal:true
        });
    });

    $("#botonMostrarComentarios").click(function(){
        if($("#historialComentarios").is(":visible")){
            $("#historialComentarios").hide("slow");
            $("#botonMostrarComentarios").html("Mostrar comentarios");
        }
        else{
            $("#historialComentarios").show("slow");
            $("#botonMostrarComentarios").html("Ocultar comentarios");
        }            
    });
    
    $("#guardar").click(function(){
        $("#comentario").dialog("close");
        var texto = $("#texto").val();
        nuevoComentario(idUsuario,idEvaluado,idSeccion,texto);
        setTimeout(function(){
            cargarComentarios(idEvaluado,idSeccion);
        },1000);    
    });


});