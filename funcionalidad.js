function irDirectorio() {
    var nombre = document.getElementById("nombreIr").value;
    window.location.href = "?nombreIr=" + nombre;
}

function cambiarNombre() {
    var nombreViejo = document.getElementById("nombreViejo").value;
    var nombreNuevo = document.getElementById("nombreNuevo").value;
    var direccion = nombreViejo.split("/");
    direccion.pop();
    var dir = direccion;
    direccion.push(nombreNuevo);
    direccion = direccion.join("/");
    window.location.href = "?nombreNuevo=" + direccion + "&nombreViejo=" + nombreViejo;
}

function crearElemento() {
    var direccion = document.getElementById("direccionCrear").value;
    var nombre = document.getElementById("nombreCrear").value;
    var tipo;
    if (document.getElementById("crearArchivo").checked) {
        tipo = "archivo";
    } else {
        tipo = "directorio";
    }
    var crear = direccion.concat("/", nombre);
    window.location.href = "?crear=" + crear + "&tipo=" + tipo;
}

function eliminarElemento() {
    var eliminar = document.getElementById("eliminar").value;
    var tipo;
    if (document.getElementById("eliminarArchivo").checked) {
        tipo = "archivo";
    } else {
        tipo = "directorio";
    }
    window.location.href = "?eliminar=" + eliminar + "&tipo=" + tipo;
}

function moverElemento() {
    console.log("entro a funcion");
    var direccionViejo = document.getElementById("direccionMoverViejo").value;
    var direccionNuevo = document.getElementById("direccionMoverNuevo").value;
    var direccion = direccionViejo.split("/");
    var nombre = direccion.pop();
    var direccionNueva;

    if (direccionNuevo.charAt(direccionNuevo.length - 1) == "/") {
        direccionNueva = direccionNuevo.concat(nombre);

    } else {
        direccionNueva = direccionNuevo.concat("/", nombre);
    }

    window.location.href = "?direccionViejo=" + direccionViejo + "&direccionNuevo=" + direccionNueva;
}

function copiarElemento() {
    var CopiarViejo = document.getElementById("CopiarViejo").value;
    var CopiarNuevo = document.getElementById("CopiarNuevo").value;

    var direccion = CopiarViejo.split("/");
    var nombre = direccion.pop();
    var direccionNueva;

    if (CopiarNuevo.charAt(CopiarNuevo.length - 1) == "/") {
        direccionNueva = CopiarNuevo.concat(nombre);

    } else {
        direccionNueva = CopiarNuevo.concat("/", nombre);
    }
    window.location.href = "?CopiarViejo=" + CopiarViejo + "&nuevaDireccion=" + direccionNueva;
}

function verPermisos() {
    var direccion = document.getElementById("verPermisos").value;
    var arrayNombre = direccion.split("/");
    var nombre = arrayNombre.pop();
    direccion = arrayNombre.join("/");
    window.location.href = "?infPermisos=" + direccion + "&nombre=" + nombre;
}
function cerrar() {
    window.location.href = "?cerrar=" + "none";
}

function cambiarPermisos() {
    var direccion = document.getElementById("cambiarPermisos").value;
    var numUsuario = document.getElementById("numeroUsuario").value;
    var numGrupo = document.getElementById("numeroGrupo").value;
    var numOtros = document.getElementById("numeroOtros").value;
    if (numUsuario > 7 || numUsuario < 0 || numGrupo > 7 || numGrupo < 0 || numOtros > 7 || numOtros < 0) {
        alert("Número Inválido");
    } else {
        var permisos = numUsuario.concat(numGrupo.concat(numOtros));
        window.location.href = "?direccionCambio=" + direccion + "&permisosCambio=" + permisos;
    }
}

function cambiarPropietario() {
    var direccionPropietario = document.getElementById("direccionPropietario").value;
    var nombreUsuario = document.getElementById("nombreUsuario").value;
    window.location.href = "?direccionPropietario=" + direccionPropietario + "&nombreUsuario=" + nombreUsuario;
}