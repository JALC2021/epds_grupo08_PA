function comprobarnoticia() {
    var not = document.getElementById("titulo").value;
    if (not == "" || not == null) {
        alert("Indique un titulo");
        return false;
    }
    if (document.formularionoticia.noticia.value.length == 0) {
        alert("Indique una noticia");
        return false;
    }
    return true;
}

