
		
$(document).ready(function(){
			$("#boton1").click(function(){
				$("div[id=contenidoPeriodo]").css("display", "block");
				$("#boton1").css("display", "none");
			});

		
		});


var today = new Date();

//var endofseason = new Date("March 4, 2013"); //Fin de temporada del Div
//if (today >= endofseason) {document.getElementById("div").style.display = "block"}

var startEventDate = new Date("March 6, 2015 00:00"); // Fecha de inicio para que se muestre el div
var endEventDate = new Date ("March 06, 2015 23:59"); // Fecha de Fin para que se muestre el div
if ((today >= startEventDate)  && (today <=endEventDate)) {document.getElementById("fechaAlta").style.display = "block"}

var startEventDate = new Date("March 5, 2015 00:00"); //Fecha de inicio para que se muestre el div
var endEventDate = new Date ("March 05, 2015 23:59"); // Fecha de Fin para que se muestre el div
if ((today >= startEventDate)  && (today <=endEventDate)) {document.getElementById("fechaFin").style.display = "block"}