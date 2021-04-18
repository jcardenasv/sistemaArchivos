function abrirDirectorio() {
    var nombre = document.getElementById("nombreAbrir");
    window.location.href = window.location.href + "?nombreAbrir=" + nombre;
}