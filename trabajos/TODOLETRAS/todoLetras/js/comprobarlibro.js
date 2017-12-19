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

function comprobarlibro()
{
    var titulo = document.getElementById("titulo");
    var autor = document.getElementById("autor");
    var editorial = document.getElementById("editorial");
    var edicion = document.getElementById("edicion");
    var file = document.getElementById("file");
    var precio = document.getElementById("precio");
    if (validarTitulo(titulo) && validarAutor(autor) && validarEditorial(editorial) && validarEdicion(edicion) && validarFile(file) && validarPrecio(precio)) {
        return true;
    }
    else {
        alert("Hay datos erroneos en el formulario");
        return false;
    }
}

function validarTitulo(element) {

    var valor = element.value;
    var msgError = new Array();
    if (valor.length == 0) {
        msgError.push("Debe indicar el titulo del libro");
    }
    return setErrors(msgError, element);

}
function validarAutor(element) {

    var valor = element.value;
    var msgError = new Array();
    if (valor.length == 0) {
        msgError.push("Debe indicar el autor del libro");
    }
    return setErrors(msgError, element);

}
function validarEditorial(element) {

    var valor = element.value;
    var msgError = new Array();
    if (valor.length == 0) {
        msgError.push("Debe indicar la editorial del libro");
    }
    return setErrors(msgError, element);

}
function validarEdicion(element) {

    var valor = element.value;
    var msgError = new Array();
    if (valor.length < 4) {
        msgError.push("Debe indicar el anio de edicion del libro (4 digitos");
    }
    if (isNaN(valor)){
        msgError.push("El anio de edicion debe ser numerico");
    }
    return setErrors(msgError, element);

}
function validarFile(element) {

    var valor = element.value;
    var msgError = new Array();
    var ext = (valor.substring(valor.lastIndexOf("."))).toLowerCase(); 
    if (valor.length == 0) {
        msgError.push("No ha seleccionado ninguna portada");
    }
    if (ext != ".jpg"){
        msgError.push("El formato de la portada no es valido. Deben ser imagenes en .jpg");
    }
    return setErrors(msgError, element);

}
function validarPrecio(element) {

    var valor = element.value;
    var msgError = new Array();
    var exp = /^\d{8}[a-zA-Z]$/;
    if (valor.length == 0) {
        msgError.push("Debe indicar el precio del libro");
    }
    if (isNaN(valor)){
        msgError.push("El precio debe ser numerico");
    }
    return setErrors(msgError, element);

}