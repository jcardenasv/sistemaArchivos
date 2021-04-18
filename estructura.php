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

function rrmdir($dir) { 
    $objects = scandir($dir);
    foreach ($objects as $object) {
        if ($object != "." && $object != "..") { 
            if (is_dir($dir."/".$object)){
                rrmdir($dir."/".$object); 
            } else{
                unlink($dir."/".$object);
            }
        }
    }
    rmdir($dir);
}

if (isset($_GET["nombreIr"])) {
    $nombre = $_GET["nombreIr"];
    $rutaActual = $nombre;
}

if (isset($_GET["nombreNuevo"]) && isset($_GET["nombreViejo"])) {
    $nombreNuevo = $_GET["nombreNuevo"];
    $nombreViejo = $_GET["nombreViejo"];
    rename($nombreViejo, $nombreNuevo);
}

if (isset($_GET["crear"]) && isset($_GET["tipo"])) {
    $crear = $_GET["crear"];
    $tipo = $_GET["tipo"];
    if($tipo == "archivo"){
        touch($crear);
    }else{
        mkdir($crear);
    }
}

if (isset($_GET["eliminar"]) && isset($_GET["tipo"])) {
    $eliminar = $_GET["eliminar"];
    $tipo = $_GET["tipo"];
    if($tipo == "archivo"){
        unlink($eliminar);
    }else{
        rrmdir($eliminar);
    }
}

?>