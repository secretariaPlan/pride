//Varible para tipo de correo
var expr = /^[a-zA-Z0-9]*$/;
 
$(document).ready(function () {
    $("#boton").click(function (){ //función para el boton de enviar

        var pass = $("#pass").val();
        var repass = $("#repass").val();
 
        //Secuencia de if's para verificar contenido de los inputs
 
        
        
        //Verifica que no este vacío y que sean letras
        if(pass == "" || !expr.test(repass)){
        	
        	// .fadeIn("slow") mostrar con efecto
        	//$("#mensaje2").fadeOut(); ocultar con efecto
        	
            $("#mensaje1").show();
            $("#mensaje2").show();
        	$("#repass").css({"background":"#F22" }); //El input se pone rojo

            return false;// con false sale de la secuencia
        }
  
  
        else{
            $("#mensaje1").hide();
            if(pass != repass){
            	$("#mensaje2").show();
            	$("#repass").css({"background":"#F22" }); //El input se pone rojo
                return false;
            }
            
        }
        $("#mensajeok").show();
        $("#nueva").hide();

        window.setTimeout("location=('http://localhost/pride/');",5000);
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
    $("#repass").keyup(function(e) {
        var pass = $("#pass").val();
        var re_pass=$("#repass").val();
 
        if(pass != re_pass)
        {
            valido=true;
        }
        else if(pass == re_pass )
        {
            $("#repass").css({"background":"#8F8"}); //El input se ponen verde
            $("#mensaje2").hide();
            valido=true;
        }
    });//fin keyup repass
   
});//fin ready