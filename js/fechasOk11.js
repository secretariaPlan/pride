	        //inicio y fin son objetos fecha, terminado es true si la act ya acabo
			//estadoActual es como viene el estatus
			//El arhivo se debe incluir en el php q se quiera usar
			//<script type="text/javascript" src="js/fechasOk.js"></script>
			// y la funcion se debe llamar dentro del RevisaDatos al final:
			//datosOk = fechasOk(document.datos.inicio,document.datos.fin,document.datos.concluido[0].checked,datosOk)
    		//return datosOk;
	        function fechasOk(inicio,fin,terminado,estadoActual)
    		{
	        	if(terminado == false)
	        		return estadoActual;
	        	if (terminado == true && fin.value.length == 0)
	        	{
					alert("Falta la fecha de término");
					return false;
				}	
	        		
    			fInicio = inicio.value;
    			fFin = fin.value;
    			if (fInicio.length > 0 && fFin.length > 0)
    			{
    				inicio = parseInt(fInicio.substr(6,4)+fInicio.substr(3,2)+fInicio.substr(0,2));
    				fin = parseInt(fFin.substr(6,4)+fFin.substr(3,2)+fFin.substr(0,2));
    				
    				if (fin < inicio)
    				{
    					alert("La Fecha de término debe ser más reciente que la de inicio");
    					return false;
    				}
    			}
    			if (fInicio.length == 0 && fFin.length > 0)
    			{
    				alert("Falta la fecha de inicio");
    				return false;
    			}
    			
    			return estadoActual;
    		}