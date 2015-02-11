function fechas(inicio,fin) 
    		{
    			terminadoSi = ""; terminadoNo = " checked ";
    			if (fin != "")
    			{
    				terminadoSi = " checked "; terminadoNo = " ";
    			}
    			var inicioTag = "\'"+"inicio"+posx+"\'";
    			var finTag = "\'"+"fin"+posx+"\'";
    			var inicio = '<table><tr valign="top">'+
                		'<td width="150" >Fecha de inicio:</td>'+
	               		'<td>'+	 
	               		'<input type="text" size="12" maxlength="12" id="inicio'+posx+'"  name="inicio'+posx+'" value="'+inicio+'">&nbsp;<img src="imagenes/calendario.jpg" id="inicio'+posx+'Trigger" style="cursor: pointer;" title="Seleccione la fecha" onclick="scwShow(scwID('+inicioTag+'), event);"></td>'+
	               	'</tr></table>';
	            var terminado = '<table><tr valign="top">'+
                		'<td width="150" >Terminado:</td>'+
	               		'<td><input type="radio" name="terminado'+posx+'" '+terminadoSi+' onclick="terminado('+posx+')" value="Si">Si <input type="radio" name="terminado'+posx+'" '+terminadoNo+' onclick="noTerminado('+posx+')" value="No">No'+
	               		'</td></tr></table>';	 
	               		
				var fin = '<table id="tablaFechaFin'+posx+'"><tr valign="top">'+
                		'<td width="150" >Fecha de termino:</td>'+
	               		'<td>'+	 
	               		'<input type="text" size="12" maxlength="12" id="fin'+posx+'"  name="fin'+posx+'" value="'+fin+'">&nbsp;<img src="imagenes/calendario.jpg" id="fin'+posx+'Trigger" style="cursor: pointer;" title="Seleccione la fecha" onclick="scwShow(scwID('+finTag+'), event);"></td>'+
	               	'</tr></table>';       	
	            return inicio+terminado+fin;
	        }
	        
	        function terminado(posToTest)
	        {
	        	obj = "tablaFechaFin"+posToTest;
	        	document.getElementById(obj).style.display = "block";
	        	
	        }
	        
	        function noTerminado(posToTest)
	        {
	        	obj = "tablaFechaFin"+posToTest;
	        	document.getElementById(obj).style.display = "none";
	        	obj = "fin"+posToTest;
	        	document.getElementById(obj).value= "";
	        	
	        }
	        
	        function fechasOk(inicio,fin)
    		{
    			fInicio = inicio.value;
    			fFin = fin.value;
    			if (fInicio.length > 0 && fFin.length > 0)
    			{
    				inicio = parseInt(fInicio.substr(6,4)+fInicio.substr(3,2)+fInicio.substr(0,2));
    				fin = parseInt(fFin.substr(6,4)+fFin.substr(3,2)+fFin.substr(0,2));
    				
    				if (fin < inicio)
    					return false;
    			}
    			return true;
    		}