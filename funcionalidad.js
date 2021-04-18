function irDirectorio() {
    var nombre = document.getElementById("nombreIr").value;
    window.location.href = "?nombreIr=" + nombre;
}