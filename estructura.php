<?php
//      /var/www/html/sistemaArchivos$ git commit -a -m "Alto cambio"
$rutaActual = "/var/www/html";
$mostrar = "none";

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

function auxiliarEliminar($dir) { 
    $objects = scandir($dir);
    foreach ($objects as $object) {
        if ($object != "." && $object != "..") { 
            if (is_dir($dir."/".$object)){
                auxiliarEliminar($dir."/".$object); 
            } else{
                unlink($dir."/".$object);
            }
        }
    }
    rmdir($dir);
}

function AuxiliarCopiar( $inicio, $destino ) {
    //Destino debe incluir el nombre de la carpeta que se quiere copiar
    if ( is_dir( $inicio ) ) {
        mkdir( $destino );
        $d = dir( $inicio );
        while ( FALSE !== ( $entrada1 = $d->read() ) ) {
            if ( $entrada1 == '.' || $entrada1 == '..' ) {
                continue;
            }
            $entrada2 = $inicio . '/' . $entrada1; 
            if ( is_dir( $entrada2 ) ) {
                AuxiliarCopiar( $entrada2, $destino . '/' . $entrada1 );
                continue;
            }
            copy( $entrada2, $destino . '/' . $entrada1 );
        }
 
        $d->close();
    }else {
        copy( $inicio, $destino );
    }
}

if (isset($_GET["nombreIr"])) {
    $nombre = $_GET["nombreIr"];
    $rutaActual = $nombre;
}

if (isset($_GET["nombreNuevo"]) && isset($_GET["nombreViejo"])) {
    $nombreNuevo = $_GET["nombreNuevo"];
    $nombreViejo = $_GET["nombreViejo"];
    echo $nombreNuevo."<br>".$nombreViejo;
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
        auxiliarEliminar($eliminar);
    }
}
if (isset($_GET["CopiarViejo"]) && isset($_GET["nuevaDireccion"])) {
    $direccionAntigua = $_GET["CopiarViejo"];
    $direccionNueva= $_GET["nuevaDireccion"];
    AuxiliarCopiar($direccionAntigua, $direccionNueva);
}

if (isset($_GET["direccionViejo"]) && isset($_GET["direccionNuevo"])) {
    $direccionAntigua = $_GET["direccionViejo"];
    $direccionNueva= $_GET["direccionNuevo"];
   
    AuxiliarCopiar($direccionAntigua, $direccionNueva);
    echo "entró al if";
    if(is_dir($direccionAntigua)){
        auxiliarEliminar($direccionAntigua);
    }else{
        unlink($direccionAntigua);
    }
}
if (isset($_GET["infPermisos"]) && isset($_GET["nombre"])) {
    $mostrar="true";
    $infPermisos = $_GET["infPermisos"];
    $nombre = $_GET["nombre"];

    $titulo;
    $permisos;
    $propietario;
    $grupo;

    echo $infPermisos;
    echo $nombre;
    exec("ls -l ".$infPermisos, $elementos);

    foreach($elementos as $elemento){ 
        $datos = explode(" ", $elemento);
        $datos= array_filter($datos);

        if($nombre == end($datos)){
            $titulo=array_pop($datos);
            for ($i = 1; $i <= 4; $i++) {
                echo array_pop($datos);
            }
            var_dump($datos);
            $grupo=array_pop($datos);
            $propietario=array_pop($datos);
            array_pop($datos);
            $permisos=array_pop($datos);
            
            break;
        }else{
            $titulo="no lo encontró";
        }
    }
    echo $informacion;
}

if (isset($_GET["cerrar"])) {
    $cerrar = $_GET["cerrar"];
    $mostrar= $cerrar;
}

?>