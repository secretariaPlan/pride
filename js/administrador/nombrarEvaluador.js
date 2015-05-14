$(document).ready(function () {
    
    $("#evaluador").on("change keyup copy paste cut", function(){
        
        if($("#evaluador").val().length < 5 && $('input[name="idEvaluador"]').val() ){
            $("#evaluador").val("");
            $('input[name="idEvaluador"]').val("");
            $('input[name="nombreEvaluador"]').val("");
            $("#asignados").html("");     
        }
        
    });
    
    $("#evaluador").autocomplete({
        source:"buscarUsuarioPorNombre",
        //source:data;
        minLength: 3,
        select: function(event,ui){
            console.log(ui);
        	$("#evaluador").val(ui.item.nombre);
            $('input[name="idEvaluador"]').val(ui.item.id);
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
});