$(document).ready(function () {
    /*$.ajax({
        type : "POST",
        url: "http://pride.dev/index.php/administrador/listaUsuarios",
        
        success:function(response){
            //var objetoJson = $.parseJSON(response);
            console.log(response);
        }
        
    });
    */
    $("#evaluador").keyup(function(){
        var datos = [];
        var cadena  = $("#evaluador").val();
        $.ajax({
            type : 'POST',
            url: "/index.php/administrador/listaUsuarioNombre/"+ cadena,

            success:function(response){
                var objetoJson = $.parseJSON(response);
                //console.log(objetoJson);
                for(var i = 0;i < objetoJson.length;i++){
                    //console.log(objetoJson[i]);
                    datos[i]={id:objetoJson[i].id,rfc:objetoJson[i].rfc,nombre:objetoJson[i].nombre};
                }
            }

        });
     });
    /*
    $("#evaluador").autocomplete({
        minLength:3,
        source : function(req,add){
            $.ajax({
                url : "/index.php/administrador/listaUsuarioNombre/",
                dataType : "json",
                type : "post",
                data : req,
                success : function(data){
                    if(data.response == 'true'){
                        add(data.message);
                    }
                }
            });
        }
    });*/
});