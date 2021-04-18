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
            echo '<div style="margin-right: 20px; margin-bottom: 30px">
                        <p>' . end($datos) . '</p>
                        <img src="dir1.png" id="imgDirectorio" height="120" width="120" style="margin-top: -15px">
                    </div>';
        } elseif ($letra == "-") {
            echo '<div style="margin-right: 20px; margin-bottom: 30px">
                        <p>' . end($datos) . '</p>
                        <img src="txt.png" id="imgArchivo" height="120" width="120" style="margin-top: -15px">
                    </div>';
        }
    }
}

if (isset($_GET["nombreIr"])) {
    $nombre = $_GET["nombreIr"];
    $rutaActual = $nombre;
}

?>