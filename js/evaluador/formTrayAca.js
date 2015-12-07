$(document).ready(function(){
    $("#comentario").hide();
    $("#botonComentario").click(function(){
        $("#comentario").dialog({
            height:350,
            width:600,
            show: { effect: 'drop', direction: "up" },
            modal:true
        });
    });
    
    $("#guardar").click(function(){
        alert();
    });
});