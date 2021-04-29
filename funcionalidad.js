function quitarSlash(direccion) {
    direccion = direccion.split("/");
    if (direccion[direccion.length - 1] == "") {
        direccion.pop();
    }
    direccion = direccion.join("/");
    return direccion;

}

function atras(){
    direccion = document.getElementById("direccion").value;
    direccion = direccion.split("/");
    direccion.pop();
    direccion = direccion.join("/");    
    if(direccion == ""){
        direccion = "/";
        }
    window.location.href = "?atras=" + direccion;
}

function irDirectorio() {
    var nombre = document.getElementById("nombreIr").value;
    window.location.href = "?nombreIr=" + nombre;
}

function cambiarNombre() {
    var direccion = document.getElementById("direccion").value;
    var nombreViejo = document.getElementById("nombreViejo").value;
    var nombreNuevo = document.getElementById("nombreNuevo").value;

    direccionVieja = direccion.concat("/",nombreViejo);
    direccionNueva = direccion.concat("/",nombreNuevo);
    window.location.href = "?nombreNuevo=" + direccionNueva + "&nombreViejo=" + direccionVieja + "&path=" + direccion;
}

function crearElemento() {
    var direccion = document.getElementById("direccion").value;
    var nombre = document.getElementById("nombreCrear").value;
    var tipo;
    if (document.getElementById("crearArchivo").checked) {
        tipo = "archivo";
    } else {
        tipo = "directorio";
    }
    var path = direccion;
    var crear = direccion.concat("/", nombre);
    window.location.href = "?crear=" + crear + "&tipo=" + tipo + "&path=" + path;
}

function eliminarElemento() {
    var direccion = document.getElementById("direccion").value;
    var eliminar = document.getElementById("eliminar").value;
    var tipo;
    if (document.getElementById("eliminarArchivo").checked) {
        tipo = "archivo";
    } else {
        tipo = "directorio";
    }

    var eliminar = direccion.concat("/", eliminar);
    window.location.href = "?eliminar=" + eliminar + "&tipo=" + tipo + "&path=" + direccion;
}

function copiarElemento() {
    var direccion = document.getElementById("direccion").value;
    var CopiarViejo = document.getElementById("CopiarViejo").value;
    var CopiarNuevo = document.getElementById("CopiarNuevo").value;

    CopiarNuevo = quitarSlash(CopiarNuevo);
    var direccionNueva = CopiarNuevo.concat("/", CopiarViejo);
    var path = direccion;
    CopiarViejo = direccion.concat("/", CopiarViejo);

    window.location.href = "?CopiarViejo=" + CopiarViejo + "&nuevaDireccion=" + direccionNueva + "&path=" + path;
}

function moverElemento() {
    var direccion = document.getElementById("direccion").value;
    var nombre = document.getElementById("direccionMoverViejo").value;
    var direccionNuevo = document.getElementById("direccionMoverNuevo").value;

    direccionNuevo = quitarSlash(direccionNuevo);
    var direccionViejo = direccion.concat("/", nombre);
    direccionNuevo = direccionNuevo.concat("/", nombre);
    window.location.href = "?direccionViejo=" + direccionViejo + "&direccionNuevo=" + direccionNuevo + "&path=" + direccion;
}

function verPermisos() {
    var direccion = document.getElementById("direccion").value;
    var nombre = document.getElementById("verPermisos").value;
    window.location.href = "?infPermisos=" + direccion + "&nombre=" + nombre + "&path=" + direccion;

}
function cerrar() {
    var path = document.getElementById("direccion").value;
    window.location.href = "?cerrar=" + "none" + "&path=" + path;
}

function cambiarPermisos() {
    var direccion = document.getElementById("direccion").value;
    var nombre = document.getElementById("cambiarPermisos").value;

    var numUsuario = document.getElementById("numeroUsuario").value;
    var numGrupo = document.getElementById("numeroGrupo").value;
    var numOtros = document.getElementById("numeroOtros").value;

    if (numUsuario > 7 || numUsuario < 0 || numGrupo > 7 || numGrupo < 0 || numOtros > 7 || numOtros < 0) {
        alert("Número Inválido");
    } 
    else {
        direccionElem = direccion.concat("/", nombre);
        var permisos = numUsuario.concat(numGrupo.concat(numOtros));
        window.location.href = "?direccionCambio=" + direccionElem + "&permisosCambio=" + permisos + "&path=" + direccion;
    }
}

function cambiarPropietario() {
    var direccion = document.getElementById("direccion").value;
    var nombre = document.getElementById("direccionPropietario").value;
    var nombreUsuario = document.getElementById("nombreUsuario").value;

    direccionPropietario = direccion.concat("/", nombre);
    window.location.href = "?direccionPropietario=" + direccionPropietario + "&nombreUsuario=" + nombreUsuario + "&path=" + direccion;
}