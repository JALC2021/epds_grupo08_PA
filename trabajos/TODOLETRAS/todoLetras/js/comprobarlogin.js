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

function comprobarlogin()
{
    var nom = document.getElementById("user");
    var pass = document.getElementById("pass");
    if (validarUsuario(nom) && validarPassword(pass)) {
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
        msgError.push("El usuario debe tener minimo 4 caracteres");
    }
    return setErrors(msgError, element);

}
function validarPassword(element) {

    var valor = element.value;
    var msgError = new Array();
    if (valor.length < 4) {
        msgError.push("Password incorrecto, debe tener al menos 4 caracteres");
    }
    return setErrors(msgError, element);

}
