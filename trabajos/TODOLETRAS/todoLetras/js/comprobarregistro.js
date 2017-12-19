function setErrors(errors, input) {
    var res;
    var idCampo = input.getAttribute("id");
    var tdElement = document.getElementById(idCampo + "Error");

    while (tdElement.hasChildNodes()) {
        tdElement.removeChild(tdElement.firstChild);
    }

    if (errors.length > 0) {
        res = false;
        setAsError(true, input);
        var text, br;
        for (var i = 0; i < errors.length; i++) {
            text = document.createTextNode(errors[i]);
            br = document.createElement("br");
            tdElement.appendChild(text);
            if (i < errors.length)
                tdElement.appendChild(br);
        }
    }
    else {
        res = true;
        setAsError(false, input);
    }
    return res;
}

function setAsError(isError, input) {
    if (isError) {
        $(document).ready(function () {
            $(input).css("borderColor", "#B81D22").animate({borderWidth: '5px'}, 500);
        });
    }
    else {
        $(input).css("borderColor", "").animate({borderWidth: '2px'}, 500);
    }
}

function comprobarregistro()
{
    var user = document.getElementById("user");
    var pass = document.getElementById("pass");
    var nom = document.getElementById("nombre");
    var apel = document.getElementById("apellidos");
    var dni = document.getElementById("dni");
    if (validarUsuario(user) && validarPassword(pass) && validarNombre(nom) && validarApellidos(apel) && validarDni(dni)) {
        return true;
    }
    else {
        alert("Hay datos erroneos en el formulario");
        return false;
    }
}

function validarUsuario(element) {

    var valor = element.value;
    var msgError = new Array();
    if (valor.length < 4) {
        msgError.push("Minimo 4 caracteres");
    }
    return setErrors(msgError, element);

}
function validarPassword(element) {

    var valor = element.value;
    var msgError = new Array();
    if (valor.length < 4) {
        msgError.push("Minimo 4 caracteres");
    }
    return setErrors(msgError, element);

}
function validarNombre(element) {

    var valor = element.value;
    var msgError = new Array();
    if (valor.length == 0) {
        msgError.push("Indica un nombre");
    }
    return setErrors(msgError, element);

}
function validarApellidos(element) {

    var valor = element.value;
    var msgError = new Array();
    if (valor.length == 0) {
        msgError.push("Indica tus apellidos");
    }
    return setErrors(msgError, element);

}
function validarDni(element) {

    var valor = element.value;
    var msgError = new Array();
    var exp = /^\d{8}[a-zA-Z]$/;
    if (valor.length == 0) {
        msgError.push("Indicar tu DNi");
    }
    if (!exp.test(valor)){
        msgError.push("Formato DNI valido");
    }
    return setErrors(msgError, element);

}