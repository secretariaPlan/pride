//Varible para tipo de correo
var expr = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
 
$(document).ready(function () {
    $("#boton").click(function (e){ //función para el boton de enviar

        var email = $("#email").val();
        var reemail = $("#reemail").val();
 
        //Secuencia de if's para verificar contenido de los inputs
 
        //Verifica que no este vacío y que sean letras
        if(email == "" || !expr.test(email)){
            $("#mensaje1").show();
            $("#mensaje2").show();
        	$("#reemail").css({"background":"#F22" }); //El input se pone rojo

            return false;// con false sale de la secuencia
        }
  
  
        else{
            $("#mensaje1").hide();
            if(email != reemail){
            	$("#mensaje2").show();
            	$("#reemail").css({"background":"#F22" }); //El input se pone rojo
                return false;
            }
        }
 
    });//fin click
 
    /*
     *Con estas funciones de keyup, el mensaje de error se muestra y
     * se ocultará automáticamente, si el usuario escribe datos admitidos.
     * Sin necesidad de oprimir de nuevo el boton de Enviar Contraseña.
     *
     * La función keyup lee lo último que se ha escrito y comparamos
     * con nuestras condiciones, si cumple se quita el error.
     *

     * */


    var valido=false;
    $("#reemail").keyup(function(e) {
        var email = $("#email").val();
        var re_email=$("#reemail").val();
 
        if(email != re_email)
        {
        	
            valido=true;
        }
        else if(email == re_email )
        {
            $("#reemail").css({"background":"#8F8"}); //El input se ponen verde
            $("#mensaje2").hide();
            valido=true;
        }
    });//fin keyup repass
 
});//fin ready