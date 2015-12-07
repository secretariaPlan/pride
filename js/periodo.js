function listaPeriodoUltimo(){
    $.ajax({
        url: "../periodos/listaUltimoPeriodo",
        type: "POST",
        beforeSend: function(){},
        success: function(response){
            var tabla = "";
            var respuesta = $.parseJSON(response);
            //console.log(respuesta.exito);
                $.each(respuesta.periodos,function(index){
                    //console.log(respuesta.usuarios[index]);
                    tabla += "<tr id='"+ respuesta.periodos[index].id +"'>"+
                                "<td>"+ respuesta.periodos[index].periodo +"</td>" +
                                "<td>"+ respuesta.periodos[index].inicioper +"</td>" +
                                "<td>"+ respuesta.periodos[index].finper +"</td>" +
                                "<td>"+ respuesta.periodos[index].inicioeval +"</td>" +
                                "<td>"+ respuesta.periodos[index].fineval +"</td>" +
                                "<td>"+ respuesta.periodos[index].inicioentrega +"</td>" +
                                "<td>"+ respuesta.periodos[index].finentrega +"</td>" +
                                "<td><button class='green small editar tooltip' title = 'Editar'><i class='fa fa-pencil'></i></button></td>" +
                            "</tr>";
                });
                $("#ultimoPeriodo").html(tabla);
                //console.log(tabla);
            }
    });
}

function listaPeriodos(){
    $.ajax({
        url: "../periodos/listaSinUltimoPeriodo",
        type: "POST",
        beforeSend: function(){},
        success: function(response){
            var tabla = "";
            var respuesta = $.parseJSON(response);
            //console.log(respuesta.exito);
                $.each(respuesta.periodos,function(index){
                    //console.log(respuesta.usuarios[index]);
                    tabla += "<tr id='"+ respuesta.periodos[index].id +"'>"+
                                "<td>"+ respuesta.periodos[index].periodo +"</td>" +
                                "<td>"+ respuesta.periodos[index].inicioper +"</td>" +
                                "<td>"+ respuesta.periodos[index].finper +"</td>" +
                                "<td>"+ respuesta.periodos[index].inicioeval +"</td>" +
                                "<td>"+ respuesta.periodos[index].fineval +"</td>" +
                                "<td>"+ respuesta.periodos[index].inicioentrega +"</td>" +
                                "<td>"+ respuesta.periodos[index].finentrega +"</td>" +
                                "<td>"+"</td>"+
                            "</tr>";
                });
                $("#periodos").html(tabla);
                //console.log(tabla);
            }
    });
}


function desasignar(id){
    var parametros = {id:id}
    $.ajax({
        data:parametros,
        url: "../periodos/desasignarPeriodo",
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

function editarPeriodo(){

    alert('Se detecto el click. Ahora se desea mandar a llamar un nuevo controlador que cargue las views para la edición del periodo desde JQuery');
}

$(document).ready(function(){
    $(".fecha").datepicker({dateFormat: "dd-mm-yy"});
    
    listaPeriodoUltimo();

    //////////////////////
    //Lista de Periodos//
    ////////////////////
    listaPeriodos();

    //Nombrar como evalaudor//
    /////////////////////////
    
    $(document).on("click",".desasignar",function(){
        var id = $(this).closest("tr").attr("id");
        desasignar(id);
        setTimeout(function(){
        	listaPeriodos();
        },500);
    });

    //Editar periodo actual
     $(document).on("click",".editar",function(){
        editarPeriodo();
    });
});
