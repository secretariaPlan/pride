	function validar(e){
		tecla=(document.all) ? e.keyCode : e.which;
		if((tecla<48 || tecla>57) && (tecla<1 || tecla>31) && tecla!=127)
			return false;
	}
	
	document.onkeydown = function(){
		switch(window.event.keyCode){
			case 116:
				alert("La tecla F5 no está permitida!");
				return false;
			break;
			
			case 82:
				if(window.event.ctrlKey){
					alert("La página no permite recargar los datos!");
					return false;
				}
			break;
		}
	}