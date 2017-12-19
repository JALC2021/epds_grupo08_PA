function comprobarpassword()
{

    var mensajeRequeridos = new String();
    mensajeRequeridos = '';
    
    
    if (validarPassword() == false)
        mensajeRequeridos += "Contraseña no válida. Formato correcto: password01\n";
   

    if (mensajeRequeridos != '') {
        alert("Debes corregir los siguientes campos:\n " + mensajeRequeridos);
        return false;
    }
    else
        return true;
}


function validarPassword() {

    var r = true;
    var expr = /^[a-zA-Z\d_]{4,15}$/i;


    if (!expr.test(document.getElementById("pass").value))
        r = false;

    return r;

}


