function verificar()
	{
		var titulo = document.getElementById("titulo").value;
		
		if (titulo == "" || titulo == null) {
			alert("Introduzca un titulo");
		return false;
		}	
		return true;
	}