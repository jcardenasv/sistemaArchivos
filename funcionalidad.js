function irDirectorio() {
    var nombre = document.getElementById("nombreIr").value;
    window.location.href = "?nombreIr=" + nombre;
}

function cambiarNombre(){
    var nombreViejo = document.getElementById("nombreViejo").value;
    var nombreNuevo = document.getElementById("nombreNuevo").value;
    var direccion = nombreViejo.split("/");
    direccion.pop();
    direccion.push(nombreNuevo);
    direccion = direccion.join("/");
    window.location.href = "?nombreNuevo=" + direccion + "&nombreViejo=" + nombreViejo;
}

function crearElemento(){
    var direccion = document.getElementById("direccionCrear").value;
    var nombre = document.getElementById("nombreCrear").value;
    var tipo;
    if(document.getElementById("crearArchivo").checked){
        tipo = "archivo";
    }else{
        tipo = "directorio";
    }
    var crear = direccion.concat("/",nombre);
    window.location.href = "?crear=" + crear + "&tipo=" + tipo;
}

function eliminarElemento(){
    var eliminar = document.getElementById("eliminar").value;
    var tipo;
    if(document.getElementById("eliminarArchivo").checked){
        tipo = "archivo";
    }else{
        tipo = "directorio";
    }
    window.location.href = "?eliminar=" + eliminar + "&tipo=" + tipo;
}

function moverElemento(){
    var mover;
}

function copiarElemento(){
    var CopiarViejo = document.getElementById("CopiarViejo").value;
    var CopiarNuevo = document.getElementById("CopiarNuevo").value;

    var direccion = CopiarViejo.split("/");
    var nombre = direccion.pop();
    var direccionNueva

    if(CopiarNuevo.charAt(CopiarNuevo.length -1) == "/"){
        direccionNueva = CopiarNuevo.concat(nombre);

    } else{
        direccionNueva = CopiarNuevo.concat("/",nombre);
    }
    window.location.href = "?CopiarViejo=" + CopiarViejo + "&nuevaDireccion=" + direccionNueva;
}