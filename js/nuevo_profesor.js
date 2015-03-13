var expr = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
var expr1 = /^[a-zA-Z]*$/;
 
$(document).ready(function () {
    $("#boton").click(function (){ 
    	
    	var rfc = $("#rfc").val();
        var nombre = $("#nombre").val();
        var apaterno = $("#apaterno").val();
        var amaterno = $("#amaterno").val();
        var correo = $("#correo").val();
        var passw = $("#pass").val();
        var repass = $("#repass").val();
 
 
        //Verifica que no este vacío y que sean letras
        if(nombre == "" || !expr1.test(nombre)){
            $("#mensaje1").fadeIn("slow"); //Muestra mensaje de error
            return false;                  // con false sale de la secuencia
        }
        else{
            $("#mensaje1").fadeOut();   //Si el anterior if cumple, se oculta el error
 
            if(rfc == "" || !expr1.test(rfc)){
                $("#mensaje2").fadeIn("slow");
                return false;
            }
            
            if(apaterno == "" || !expr1.test(apaterno)){
                $("#mensaje2").fadeIn("slow");
                return false;
            }
            if(amaterno == "" || !expr1.test(amaterno)){
                $("#mensaje2").fadeIn("slow");
                return false;
            }
            else{
                $("#mensaje2").fadeOut();
 
                if(correo == "" || !expr.test(correo)){
                    $("#mensaje3").fadeIn("slow");
                    return false;
                }
                else{
                    $("#mensaje3").fadeOut();
 
                    if(passw != repass){
                        $("#mensaje4").fadeIn("slow");
                        return false;
                    }
                }
            }
        }
 
    });//fin click
 

    $("#rfc, #nombre, #apaterno, #amaterno").keyup(function(){
        if( $(this).val() != "" && expr1.test($(this).val())){
            $("#mensaje1, #mensaje2").fadeOut();
            return false;
        }
    });
 
    $("#correo").keyup(function(){
        if( $(this).val() != "" && expr.test($(this).val())){
            $("#mensaje3").fadeOut();
            return false;
        }
    });
 
    var valido=false;
    $("#repass").keyup(function(e) {
        var pass = $("#pass").val();
        var re_pass=$("#repass").val();
 
        if(pass != re_pass)
        {
            $("#repass").css({"background":"#F22" }); //El input se pone rojo
            valido=true;
        }
        else if(pass == re_pass)
        {
            $("#repass").css({"background":"#8F8"}); //El input se ponen verde
            $("#mensaje4").fadeOut();
            valido=true;
        }
    });//fin keyup repass
 
});//fin ready