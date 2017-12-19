function validarFichero(file) {
    var value = file.value;
    var ext = (value.substring(value.lastIndexOf("."))).toLowerCase(); 
    if (value == "") {
        alert("No ha seleccionado ningun archivo");
        return false;
    }
    if (ext != ".pdf"){
        alert("Solo se permite formato .pdf");
        return false;
    }
    if(file.files[0].size > 5000000){
        alert("Supero el maximo tamaño permitido (5Mb)");
        return false;
    }
    return true;
}

function validar(){
    var nom = document.getElementById("file");
    if (validarFichero(nom)) {
        alert("eBook subido correctamente");
        return true;
    }
    else {
        
        return false;
    }
}


