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

    window.location.href = "?atras=" + direccion;
}

function irDirectorio() {
    var nombre = document.getElementById("nombreIr").value;
    window.location.href = "?nombreIr=" + nombre;
}

function cambiarNombre() {
    var nombreViejo = document.getElementById("nombreViejo").value;
    var nombreNuevo = document.getElementById("nombreNuevo").value;

    nombreViejo = quitarSlash(nombreViejo);

    var direccion = nombreViejo.split("/");
    direccion.pop();
    var path = direccion;
    path = path.join("/");
    direccion.push(nombreNuevo);
    direccion = direccion.join("/");
    window.location.href = "?nombreNuevo=" + direccion + "&nombreViejo=" + nombreViejo + "&path=" + path;
}

function crearElemento() {
    var direccion = document.getElementById("direccionCrear").value;

    var nombre = document.getElementById("nombreCrear").value;
    direccion = quitarSlash(direccion);
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
    var eliminar = document.getElementById("eliminar").value;
    eliminar = quitarSlash(eliminar);
    var tipo;
    if (document.getElementById("eliminarArchivo").checked) {
        tipo = "archivo";
    } else {
        tipo = "directorio";
    }

    var path = eliminar.split("/");
    path.pop();
    path = path.join("/");

    window.location.href = "?eliminar=" + eliminar + "&tipo=" + tipo + "&path=" + path;
}

function copiarElemento() {
    var CopiarViejo = document.getElementById("CopiarViejo").value;
    var CopiarNuevo = document.getElementById("CopiarNuevo").value;

    CopiarViejo = quitarSlash(CopiarViejo);
    CopiarNuevo = quitarSlash(CopiarNuevo);

    var direccion = CopiarViejo.split("/");
    var nombre = direccion.pop();
    var direccionNueva;

    if (CopiarNuevo.charAt(CopiarNuevo.length - 1) == "/") {
        direccionNueva = CopiarNuevo.concat(nombre);

    } else {
        direccionNueva = CopiarNuevo.concat("/", nombre);
    }

    var path = CopiarNuevo;

    window.location.href = "?CopiarViejo=" + CopiarViejo + "&nuevaDireccion=" + direccionNueva + "&path=" + path;
}

function moverElemento() {
    var direccionViejo = document.getElementById("direccionMoverViejo").value;
    var direccionNuevo = document.getElementById("direccionMoverNuevo").value;

    direccionViejo = quitarSlash(direccionViejo);
    direccionNuevo = quitarSlash(direccionNuevo);

    var direccion = direccionViejo.split("/");
    var nombre = direccion.pop();
    var direccionNueva;

    if (direccionNuevo.charAt(direccionNuevo.length - 1) == "/") {
        direccionNueva = direccionNuevo.concat(nombre);

    } else {
        direccionNueva = direccionNuevo.concat("/", nombre);
    }

    var path = direccionNuevo;

    window.location.href = "?direccionViejo=" + direccionViejo + "&direccionNuevo=" + direccionNueva + "&path=" + path;
}



function verPermisos() {
    var direccion = document.getElementById("verPermisos").value;
    direccion = quitarSlash(direccion);
    var arrayNombre = direccion.split("/");
    var nombre = arrayNombre.pop();
    direccion = arrayNombre.join("/");
    var path = direccion;
    window.location.href = "?infPermisos=" + direccion + "&nombre=" + nombre + "&path=" + path;

}
function cerrar() {
    var path = document.getElementById("direccion").value;
    window.location.href = "?cerrar=" + "none" + "&path=" + path;
}

function cambiarPermisos() {
    var direccion = document.getElementById("cambiarPermisos").value;
    direccion = quitarSlash(direccion);
    var numUsuario = document.getElementById("numeroUsuario").value;
    var numGrupo = document.getElementById("numeroGrupo").value;
    var numOtros = document.getElementById("numeroOtros").value;
    if (numUsuario > 7 || numUsuario < 0 || numGrupo > 7 || numGrupo < 0 || numOtros > 7 || numOtros < 0) {
        alert("Número Inválido");
    } else {
        var path = direccion.split("/");
        path.pop();
        path = path.join("/");

        var permisos = numUsuario.concat(numGrupo.concat(numOtros));

        window.location.href = "?direccionCambio=" + direccion + "&permisosCambio=" + permisos + "&path=" + path;
    }
}

function cambiarPropietario() {
    var direccionPropietario = document.getElementById("direccionPropietario").value;
    direccionPropietario = quitarSlash(direccionPropietario);
    var nombreUsuario = document.getElementById("nombreUsuario").value;

    var path = direccionPropietario.split("/");
    path.pop();
    path = path.join("/");

    window.location.href = "?direccionPropietario=" + direccionPropietario + "&nombreUsuario=" + nombreUsuario + "&path=" + path;
}