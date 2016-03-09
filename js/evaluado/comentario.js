$(document).ready(function(){
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
    
    $("#guardar").click(function(){
        var comentario = $("#texto").val();
    });
});