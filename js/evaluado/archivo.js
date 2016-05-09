$(document).ready(function(){

	var idUsuario = $("#idUsuario").val();
    var idEvaluado = $("#idEvaluado").val();
    var idSeccion = $("#idseccion").val();

	$("#cargarArchivo").submit(function(e){
		e.preventDefault();
		var parametros = {
	        idEvaluado:idEvaluado,
	        idSeccion:idSeccion
	    	}

    	$.ajax({
	        data: parametros,
	        url: "../evaluado_controller/cargarArchivo/",
	        type: "POST",
	        beforeSend: function(){},
	        success: function(response){
	           
	            var respuesta = $.parseJSON(response);
	            console.log(respuesta);
	            
	            
	        }
    	});

    	
	});

});

// $(function() {
// 	$('#upload_file').submit(function(e) {
// 		e.preventDefault();
// 		$.ajaxFileUpload({
// 			url 			:'./upload/upload_file/', 
// 			secureuri		:false,
// 			fileElementId	:'userfile',
// 			dataType		: 'json',
// 			data			: {
// 				'title'				: $('#title').val()
// 			},
// 			success	: function (data, status)
// 			{
// 				if(data.status != 'error')
// 				{
// 					$('#files').html('<p>Reloading files...</p>');
// 					refresh_files();
// 					$('#title').val('');
// 				}
// 				alert(data.msg);
// 			}
// 		});
// 		return false;
// 	});
// });