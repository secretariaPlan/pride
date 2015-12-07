function listaPeriodos(){
     $.ajax({
        url: "../periodos/listaPeriodo",
        type: "POST",
        beforeSend: function(){},
        success: function(response){
            var opcion = "<option value = 0>--Selecciona una opcion--</option>";
            var respuesta = $.parseJSON(response);
            //console.log(respuesta);
            $.each(respuesta.periodos,function(index){
                //console.log(respuesta.periodos[index].periodo);
                opcion += "<option value = " + respuesta.periodos[index].id + ">" + respuesta.periodos[index].periodo + "</option>";
            });
            //console.log(opcion);
            $("#periodo").html(opcion);
        }    
    });
}

function listaComisiones(){
     $.ajax({
        url: "../comisiones/listaComision",
        type: "POST",
        beforeSend: function(){},
        success: function(response){
           var opcion = "<option value = 0>--Selecciona una opcion--</option>";
            var respuesta = $.parseJSON(response);
            //console.log(respuesta);
            $.each(respuesta.comisiones,function(index){
                //console.log(respuesta.periodos[index].periodo);
                opcion += "<option value = " + respuesta.comisiones[index].id + ">" + respuesta.comisiones[index].comision + "</option>";
            });
            //console.log(opcion);
            $("#comision").html(opcion);
        }    
    });
}

function nombrarEvaluador(idUsuario,idPeriodo,idComision){
    //console.log(idUsuario,idPeriodo,idComision);
    var parametros = {
        idUsuario: idUsuario,
        idPeriodo: idPeriodo,
        idComision: idComision
    }
    $.ajax({
        data: parametros,
        url: "../evaluador_controller/nuevoEvaluador",
        type: "POST",
        beforeSend: function(){},
        success: function(response){
            var respuesta = $.parseJSON(response);
            $("#alerta").removeClass();
            $("#alerta").show();
            console.log(respuesta.exito);
            if(respuesta.exito){
                $("#alerta").addClass("notice success");
            } 
            else{
                 $("#alerta").addClass("notice error");
            }
            $('html, body').animate({scrollTop: '0px'},"fast");
            $("#alerta>p").html(respuesta.mensaje);
            setTimeout(function(){
                 $("#alerta").hide();
            },2000);
        }
    });
}

function listaEvaluadoresDelPeriodo(){
    $.ajax({
        url: "../evaluador_controller/evaluadoresDelPeriodo",
        type: "POST",
        beforeSend: function(){},
        success: function(response){
            var tabla = "";
            var respuesta = $.parseJSON(response);
            //console.log(respuesta.exito);
            if(respuesta.exito){
                $.each(respuesta.usuarios,function(index){
                    //console.log(respuesta.usuarios[index]);
                    tabla += "<tr id='"+ respuesta.usuarios[index].idEvaluador +"'>"+
                                "<td>"+ respuesta.usuarios[index].nombre +"</td>" +
                                "<td><button class='red small desasignar tooltip'' title = 'Desasignar profesor'><i class='fa fa-remove'></i></button></td>" +
                            "</tr>";
                });
                $("#asignados").html(tabla);
                //console.log(tabla);
            }else{
                $("#asignados").html("");
            }
        }
    });
}

function desasignar(idEvaluador){
    var parametros = {idEvaluador:idEvaluador}
    $.ajax({
        data:parametros,
        url: "../evaluador_controller/desasignarEvaluadorDelPeriodo",
        type: "POST",
        beforeSend: function(){},
        success: function(response){
            console.log(response);
            var respuesta = $.parseJSON(response);
            $("#alerta").removeClass();
            $("#alerta").addClass("notice success");
            $("#alerta").show();
            $('html, body').animate({scrollTop: '0px'},"fast");
            $("#alerta>p").html(respuesta.mensaje);
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
            $('input[name="idEvaluador"]').val("");
            $('input[name="nombreEvaluador"]').val("");
            $("#asignados").html("");     
        }
        
    });
    ///////////////////////////////////
    //Busqueda de usuarios          //
    /////////////////////////////////
    
    $("#usuario").autocomplete({
        source:"buscarUsuarioPorNombre",
        //source:data;
        minLength: 3,
        select: function(event,ui){
            //console.log(ui);
        	$("#usuario").val(ui.item.nombre);
            $('input[name="idUsuario"]').val(ui.item.id);
            $('input[name="nombreEvaluador"]').val(ui.item.nombre);
            //evaluadosAsignadosAEvaluador(ui.item.idEvaluador);
            return false;
        }
     }).data( "autocomplete" )._renderItem = function( ul, item ) {
    	return $( "<li></li>" )
			.data( "item.autocomplete", item )
			.append( "<a><strong>" + item.rfc + "</strong> / " + item.nombre + "</a>" )
			.appendTo( ul );
		};
    
    //////////////////////
    //Lista de Periodos//
    ////////////////////
    listaPeriodos();
    
    //////////////////////
    //Lista de Comisiones//
    ////////////////////
    listaComisiones();
    
    /////////////////////////////////
    //ListaEvaluadores del Periodo//
    ///////////////////////////////
    listaEvaluadoresDelPeriodo();
    //////////////////////////
    //Nombrar como evalaudor//
    /////////////////////////
    
    $("#asignar").click(function(){
        var idUsuario = $('input[name="idUsuario"]').val();
        var idPeriodo = $("#periodo").val();
        var idComision = $("#comision").val();
        //console.log(idUsuario);
        nombrarEvaluador(idUsuario,idPeriodo,idComision);
        setTimeout(function(){
                     listaEvaluadoresDelPeriodo();
                },500);
    });
    
    $(document).on("click",".desasignar",function(){
        var idEvaluador = $(this).closest("tr").attr("id");
        desasignar(idEvaluador);
        setTimeout(function(){
                     listaEvaluadoresDelPeriodo();
                },500);
        
    });
    
});