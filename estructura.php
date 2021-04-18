<?php
//      /var/www/html/sistemaArchivos$ git commit -a -m "Alto cambio"
$rutaActual = "/var/www/html";

function listarElementos($ruta)
{

    chdir($ruta); //Ruta es la dirección completa
    exec("ls -l", $elementos);

    foreach ($elementos as $elemento) {

        $letra = substr($elemento, 0, 1);
        $datos = explode(" ", $elemento);

        if ($letra == "t") {
            continue;
        } elseif ($letra == "d") {
            echo '<div style="margin-right:20px">
                        <p>' . end($datos) . '</p>
                        <img src="directorio.png" id="imgDirectorio" height="120" width="120">
                    </div>';
        } elseif ($letra == "-") {
            echo '<div style="margin-right:20px">
                        <p>' . end($datos) . '</p>
                        <img src="archivo.png" id="imgArchivo" height="120" width="120">
                    </div>';
        }
    }
}
if (isset($_GET["nombreAbrir"])) {
    $nombre = $_GET["nombreAbrir"];
    $rutaActual= $rutaActual."/".$nombre;
    echo $nombre;
    chdir($rutaActual);
    // asignar w1 y w2 a dos variables
}

?>