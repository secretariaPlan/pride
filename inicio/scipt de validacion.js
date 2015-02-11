<!--
            //Esto puede ir fuera o dentro de la forma pero no antes ( en el head)
            
            function ValorOtro(obj,objOtro)
    		{
    			//alert(obj.value);
    			if (obj.value == "0")
    			{
    				//objOtro.disabled=false;
    				//al hacerlo invisible en lugar de disabled, no es necesario reactivarlo cuando termina el script pues si se manda
    				//en la forma
    				objOtro.style.visibility="visible";
    				objOtro.focus();
    				
    			}
    			else
    			{
    				objOtro.style.visibility="hidden";
    				//objOtro.disabled=true;
    			}
    		}
    		
    		
    		    		
    		//si la funcion es concluida permitas capturar la fecha final
    		function Concluido()
    		{
    			//document.datos.fin.disabled=false;
    			//document.datos.finTrigger.disabled=false;
    			document.datos.finTrigger.style.visibility="visible";
    			document.datos.fin.style.visibility="visible";
    			
    			
    		}
    		
    		//no ha concluido, no permitas capturar la fecha
    		function NoConcluido()
    		{
    			//document.datos.fin.disabled=true;
    			//document.datos.finTrigger.disabled=true;
    			document.datos.finTrigger.style.visibility="hidden";
    			document.datos.fin.style.visibility="hidden";
    		}
    		
    		//Para revisar q los datos obligatorios este capturados
    		function RevisaDatos()
    		{ 
    			datosOk=true;
    			
    			
    			celda = document.getElementById("cell_subprograma");
    			celda.className="backgris";
    			
    			
    			datosOk=true;	
    			if (document.datos.subprogramaId.value == 0 && document.datos.subprogramaOtro.value == "")
    			{
    				celda = document.getElementById("cell_subprograma");
    				celda.className="renglorojo";
    				datosOk = false;
    			} 
    			
    			
    			if (datosOk == false)
    			{
    				
    				lugar =  document.getElementById("errorMsg");
    				//para q no repita la imagne si se hacen multiples llamadas el submit
    				if (lugar.hasChildNodes())
    				{
    					//y si ya existe la debe quitar primero
    					lugar.removeChild(lugar.childNodes[0]);
    				}
    				var imagen = document.createElement("img");
    				imagen.setAttribute("src","imagenes/errorDatos.jpg");
    				//mensaje.appendChild(txtNode);
    				    				
    				lugar.appendChild(imagen);
    				
    				
    			}
    			else
    			{
    			
    				//sin un campo esta disabled entonces no se manda en el submit, por eso
	    			//aqui se rehabilitan los campos q js pudo haber deshabilitado
	    			//no importa q tengan o no valor pues aqui ya se verifico y la forma se manda
    				//document.datos.fin.disabled=false;
    				//document.datos.subprogramaOtro.disabled=false;
    				    				
    				if(document.datos.concluido[1].checked == true)  //  document.datos.concluido.value == "No")
    				{//ojo, con radios se debe especificar cual item, aqui se refieres a no
    					document.datos.fin.value = "";
    				}	
    			}
    			
    			return datosOk;
    			
    			
    		}
    		

			if (document.datos.concluido[1].checked == true)
			{    		
    			//document.datos.fin.disabled=true;
    			//document.datos.finTrigger.disabled=true;
    			document.datos.finTrigger.style.visibility="hidden";
    			document.datos.fin.style.visibility="hidden";
    		}
    		if (document.datos.subprogramaId.value > 0)
    		{
    			//document.datos.subprogramaOtro.disabled = true;
    			document.datos.subprogramaOtro.style.visibility = "hidden";
    		}
    		
    		
    		Calendar.setup({
        				inputField     :    "inicio",     // id of the input field
        				ifFormat       :    "%d-%m-%Y",      // format of the input field
        				button         :    "inicioTrigger",  // trigger for the calendar (button ID)
        				singleClick    :    true,           // double-click mode
        				step           :    1               // show all years in drop-down boxes (instead of every other year as default)
    				});
    		
    		Calendar.setup({
        				inputField     :    "fin",     // id of the input field
        				ifFormat       :    "%d-%m-%Y",      // format of the input field
        				button         :    "finTrigger",  // trigger for the calendar (button ID)
        				singleClick    :    true,           // double-click mode
        				step           :    1               // show all years in drop-down boxes (instead of every other year as default)
    				});
    	    -->
    	</script>