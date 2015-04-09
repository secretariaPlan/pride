$(document).ready(function () {
    //Obtiene el evaluador
    $("#evaluador").autocomplete({
        source:"administrador/listaUsuarioNombre",
        //source:data;
        minLength: 3,
        select: function(event,ui){
            $("#evaluador").val(ui.item.nombre);
            $('input[name="idEvaluador"]').val(ui.item.id);
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
        source:"administrador/listaUsuarioNombre",
        //source:data;
        minLength: 3,
        select: function(event,ui){
            $("#evaluado").val(ui.item.nombre);
            $('input[name="idEvaluado"]').val(ui.item.id);
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
        var idEvaluado = $('input[name="idEvaluador"]').val();
        var nombreEvaluado = $('input[name="nombreEvaluado"]').val();
        
        var tabla = '<tr>' + 
                        '<td>' + nombreEvaluado + '</td>' + 
                        '<td><button class="red small desasignar tooltip" title = "Desasignar profesor"><i class="fa fa-remove"></i></button></td>'
                    '</tr>';
        
        $("#asignados").append(tabla);
        
    });

    
});