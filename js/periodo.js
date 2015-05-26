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
                                "<td><button class='green small editar tooltip'' title = 'Editar'><i class='fa fa-pencil'></i></button></td>" +
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
                                "<td></td>" +
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

$(document).ready(function () {
    
    $("#periodo").on("change keyup copy paste cut", function(){
        
        if($("#periodo").val().length < 5 && $('input[name="id"]').val() ){
            $("#periodo").val("");
            $('input[name="id"]').val("");
            $('input[name="nombrePeriodo"]').val("");
            $("#periodos").html("");     
        }
        
    });
    
    
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
    
});
$(document).ready(function(){
    $(".fecha").datepicker({dateFormat: "dd-mm-yy"});
/*    
			$("#boton1").click(function(){
				$("div[id=contenidoPeriodo]").css("display", "block");
				$("#boton1").css("display", "none");
			});
*/
		
});

/*
var today = new Date();

//var endofseason = new Date("March 4, 2013"); //Fin de temporada del Div
//if (today >= endofseason) {document.getElementById("div").style.display = "block"}

var startEventDate = new Date("March 7, 2015 00:00"); // Fecha de inicio para que se muestre el div
var endEventDate = new Date ("May 07, 2015 23:59"); // Fecha de Fin para que se muestre el div
if ((today >= startEventDate)  && (today <=endEventDate)) {document.getElementById("fechaAlta").style.display = "block"}

var startEventDate = new Date("May 8, 2015 00:00"); //Fecha de inicio para que se muestre el div
var endEventDate = new Date ("May 10, 2015 23:59"); // Fecha de Fin para que se muestre el div
if ((today >= startEventDate)  && (today <=endEventDate)) {document.getElementById("fechaFin").style.display = "block"}
*/