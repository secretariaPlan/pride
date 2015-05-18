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

function nombrarEvaluado(idUsuario,idPeriodo,idComision){
    //console.log(idUsuario,idPeriodo,idComision);
    var parametros = {
        idUsuario: idUsuario,
        idPeriodo: idPeriodo,
        idComision: idComision
    }
    $.ajax({
        data: parametros,
        url: "../evaluado_controller/nuevoEvaluado",
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

function listaEvaluadosDelPeriodo(){
    $.ajax({
        url: "../evaluado_controller/evaluadosDelPeriodo",
        type: "POST",
        beforeSend: function(){},
        success: function(response){
            var tabla = "";
            var respuesta = $.parseJSON(response);
            $.each(respuesta.usuarios,function(index){
                //console.log(respuesta.usuarios[index]);
                tabla += "<tr id='"+ respuesta.usuarios[index].idEvaluado +"'>"+
                            "<td>"+ respuesta.usuarios[index].nombre +"</td>" +
                            "<td><button class='red small desasignar tooltip'' title = 'Desasignar profesor'><i class='fa fa-remove'></i></button></td>" +
                        "</tr>";
            });
            $("#asignados").html(tabla);
            console.log(tabla);
        }
    });
}


$(document).ready(function () {
    
    $("#usuario").on("change keyup copy paste cut", function(){
        
        if($("#usuario").val().length < 5 && $('input[name="idEvaluador"]').val() ){
            $("#usuario").val("");
            $('input[name="idUsuario"]').val("");
            $('input[name="nombreUsuario"]').val("");
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
    //ListaEvaluados del Periodo//
    ///////////////////////////////
    listaEvaluadosDelPeriodo();
    
    //////////////////////////
    //Nombrar como evalaudor//
    /////////////////////////
    
    $("#asignar").click(function(){
        var idUsuario = $('input[name="idUsuario"]').val();
        var idPeriodo = $("#periodo").val();
        var idComision = $("#comision").val();
        console.log(idUsuario);
        nombrarEvaluado(idUsuario,idPeriodo,idComision);
        listaEvaluadosDelPeriodo();
    });
    
});