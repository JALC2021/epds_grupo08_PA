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

function comprobaremail()
{
    var nombre = document.getElementById("nombre");
    var email = document.getElementById("email");
    var tlf = document.getElementById("tlf");
    var consulta = document.getElementById("consulta");
    if (validarNombre(nombre) && validarEmail(email) && validarTelefono(tlf) && validarConsulta(consulta)) {
        return true;
    }
    else {
        alert("Hay datos erroneos en el formulario");
        return false;
    }
}

function validarNombre(element) {

    var valor = element.value;
    var msgError = new Array();
    if (valor.length == 0) {
        msgError.push("Debe indicarnos su nombre");
    }
    return setErrors(msgError, element);

}
function validarEmail(element) {

    var valor = element.value;
    var msgError = new Array();
    var expresionEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
    if (valor.length == 0) {
        msgError.push("Debe indicar un email");
    }
    if (!expresionEmail.test(valor)) {
        msgError.push("Debe indicar un email valido");
    }
    return setErrors(msgError, element);

}
function validarTelefono(element) {

    var valor = element.value;
    var msgError = new Array();
    var expresionRegular1 = /^([0-9]+){9}$/;//<--- con esto vamos a validar el numero
    var expresionRegular2 = /\s/;//<--- con esto vamos a validar que no tenga espacios en blanco
    if (valor.length == 0) {
        msgError.push("Debe indicar un telefono de contacto");
    }
    if (expresionRegular2.test(valor)) {
        msgError.push("Debe indicar un telefono correcto");
    }
    else if (!expresionRegular1.test(valor)) {
        msgError.push("Debe indicar un telefono valido");
    }
    
    return setErrors(msgError, element);

}
function validarConsulta(element) {

    var valor = element.value;
    var msgError = new Array();
    if (valor.length == 0) {
        msgError.push("Debe indicarnos su consulta");
    }
    
    return setErrors(msgError, element);

}