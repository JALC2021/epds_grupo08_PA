function validarMensaje(element) {
    var value = element.value;
    if (value == "") {
        alert("Escriba algun mensaje");
        return false;
    }
    return true;
}

function comprobarMensaje(){
    var nom = document.getElementById("msg");
    if (validarMensaje(nom)) {
        //alert("Mensaje insertado correctamente");
        return true;
    }
    else {
        return false;
    }
}
