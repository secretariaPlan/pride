//Varible para tipo de correo
var expr = /^[a-zA-Z0-9]*$/;
var expr1 = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
 
$(document).ready(function () {
    $("#boton").click(function (){ //función para el boton de enviar

    	var rfc = $("#rfc").val();
    	var nombre = $("#nombre").val();
    	var apaterno = $("#apaterno").val();
    	var amaterno = $("#amaterno").val();
    	var correo = $("#amaterno").val();
        var pass = $("#pass").val();
        var repass = $("#repass").val();
 
        //Secuencia de if's para verificar contenido de los inputs
 
        
        
        //Verifica que no este vacío y que sean letras
        
        
		if(rfc == "" || !expr.test(rfc)){
		        	
		        	// .fadeIn("slow") mostrar con efecto
		        	//$("#mensaje2").fadeOut(); ocultar con efecto
		        	
		            $("#error").show();
		            $("#error").html("Ingrese el rfc");
		        	$("#rfc").css({"background":"#F22" }); //El input se pone rojo
		
		            return false;// con false sale de la secuencia
		        }
		
		
		if(nombre == "" || !expr.test(nombre)){
        	
        	// .fadeIn("slow") mostrar con efecto
        	//$("#mensaje2").fadeOut(); ocultar con efecto
        	
            $("#error").show();
            $("#error").html("Ingrese el nombre");
        	$("#nombre").css({"background":"#F22" }); //El input se pone rojo

            return false;// con false sale de la secuencia
        }
		
		
		
		
		if(apaterno == "" || !expr.test(apaterno)){
		        	
		        	// .fadeIn("slow") mostrar con efecto
		        	//$("#mensaje2").fadeOut(); ocultar con efecto
		        	
		            $("#error").show();
		            $("#error").html("Ingrese el Apellido Paterno");
		        	$("#apaterno").css({"background":"#F22" }); //El input se pone rojo
		
		            return false;// con false sale de la secuencia
		        }
		
		
		
		if(amaterno == "" || !expr.test(amaterno)){
        	
        	// .fadeIn("slow") mostrar con efecto
        	//$("#mensaje2").fadeOut(); ocultar con efecto
        	
            $("#error").show();
            $("#error").html("Ingrese el Apellido Materno");
        	$("#amaterno").css({"background":"#F22" }); //El input se pone rojo

            return false;// con false sale de la secuencia
        }
		        
        
		
		if(correo == "" || !expr.test(correo)){
		        	
		        	// .fadeIn("slow") mostrar con efecto
		        	//$("#mensaje2").fadeOut(); ocultar con efecto
		        	
		            $("#error").show();
		            $("#error").html("Ingrese un Correo Valido");
		        	$("#correo").css({"background":"#F22" }); //El input se pone rojo
		
		            return false;// con false sale de la secuencia
		        }
        
        
        
        
        if(pass == "" || !expr.test(repass)){
        	
        	// .fadeIn("slow") mostrar con efecto
        	//$("#mensaje2").fadeOut(); ocultar con efecto
        	
            $("#error").show();
            $("#error").html("Ingrese las Contraseñas");
        	$("#repass").css({"background":"#F22" }); //El input se pone rojo

            return false;// con false sale de la secuencia
        }
  
  
        else{
            $("#error").hide();
            
            if(pass != repass){
            	 $("#error").show();
                 $("#error").html("Las contraseñas no coinciden");
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
        	$("#error").hide();
        	$("#rfc").css({"background":"#8F8"}); //El input se ponen verde
        	$("#nombre").css({"background":"#8F8"}); //El input se ponen verde
        	$("#apaterno").css({"background":"#8F8"}); //El input se ponen verde
        	$("#amaterno").css({"background":"#8F8"}); //El input se ponen verde
        	$("#correo").css({"background":"#8F8"}); //El input se ponen verde
            $("#repass").css({"background":"#8F8"}); //El input se ponen verde
            $("#mensaje").show();
            $("#mensaje").html("Datos Correctos");
            valido=true;
        }
    });//fin keyup repass
   
});//fin ready