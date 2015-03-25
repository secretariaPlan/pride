//Varible para tipo de correo
var expr = /^[a-zA-Z0-9]*$/;
var expr1 = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
 
$(document).ready(function () {
	$(".datosProfesor").val("");
	
    $("#boton").click(function (){ //función para el boton de enviar
    	
    	
    	var datosProfesor = $(".datosProfesor").val();
    	var rfc = $("#rfc").val();
    	var nombre = $("#nombre").val();
    	var apaterno = $("#apaterno").val();
    	var amaterno = $("#amaterno").val();
    	var correo = $("#correo").val();
        var password = $("#password").val();
        var repass = $("#repass").val();
 
        //Secuencia de if's para verificar contenido de los inputs
 
        function mayuscula(campo){
            $(campo).keyup(function() {
                           $(this).val($(this).val().toUpperCase());
            });
}
function minuscula(campo){
            $(campo).keyup(function() {
                           $(this).val($(this).val().toLowerCase());
            });
}
//aplicando las funciones
$(document).ready(function(){
//asignamos el valor id del campo que queremos que se mayúscula
mayuscula("#rfc"); 
//asignamos el valor id del campo que queremos pasar a minúscula
minuscula("input#email");
});
        
        
        
        //Verifica que no este vacío y que sean letras
        


    	$("input").each(function(index, element){
    		var required=$(element).attr("required");
    		if(required && $(element).val().length==0 && $(element).val()!=" "){
    			$(element).addClass("error");
    			 $("#error").show();
    			 $("#error").html("Llene los Campos Requeridos");
    		}else{
    			 
    					$(element).removeClass("error");
    			
    		}
    		
    	});
		
    	
		
		if(correo == "" || !expr1.test(correo)){
        	
        	// .fadeIn("slow") mostrar con efecto
        	//$("#mensaje2").fadeOut(); ocultar con efecto
        	
        //$("#error").show();
          // $("#error").html("El correo que usted ingreso no es valido");
			$("#correo").addClass("error");

            return false;// con false sale de la secuencia
        }
        
        
        
        if(password == "" || !expr.test(repass)){
        	
        	// .fadeIn("slow") mostrar con efecto
        	//$("#mensaje2").fadeOut(); ocultar con efecto
        	
            $("#error").show();
            $("#error").html("Ingrese las Contraseñas");

            $("#repass").addClass("error");


            return false;// con false sale de la secuencia
        }
  
  
        else{
            $("#error").hide();
            
            if(password != repass){
            	 $("#error").show();
                 $("#error").html("Las contraseñas no coinciden");
                 $("#password").addClass("error");
                 $("#repass").addClass("error");
         
                return false;
            }
            
        }
        $(".datosProfesor").removeClass("error");
        $("#mensaje").show();
      $("#mensaje").html("Los datos Se Guardaron Correctamente");
       

     window.setTimeout("location=('http://localhost/pride/administrador/nuevoProfesor');",5000);
      
 
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
    


	
		
	$("input").keyup(function(e) {
        if($(this).val().length>0 && $(this).val()!=" "){
			$(this).removeClass("error");
		}else{
			$(this).addClass("error");
		}
    });

    
	
 
    
    $("#correo").keyup(function(e) {

        var correo = $("#correo").val();

        if(correo != correo)
        {
            valido=true;
        }
        else if(correo == correo )
        {
        	$("#error").hide();
            valido=true;
        }
    });//fin keyup repass
    
    
    $("#repass").keyup(function(e) {

        var password = $("#password").val();
        var re_pass=$("#repass").val();
        
        
    
        
 
        if(password != re_pass)
        {
            valido=true;
        }
        else if(password == re_pass )
        {
        	$("#error").hide();


            valido=true;
        }
    });//fin keyup repass
   
});//fin ready