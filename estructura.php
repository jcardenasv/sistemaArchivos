<?php

$rutaActual = "/var/www/html";
$mostrar = "none";
$contraseña="1028";

function listarElementos($ruta){

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
                        <img src="direccion.png" id="imgDirectorio" height="120" width="120" style="margin-top: -15px">
                    </div>';
        } elseif ($letra == "-") {
            echo '<div style="margin-right: 20px; margin-bottom: 30px">
                        <p>' . end($datos) . '</p>
                        <img src="txt.webp" id="imgArchivo" height="120" width="120" style="margin-top: -15px">
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

function filtro($var){
    return ($var !== "");
}

//If para funcion atrás
if (isset($_GET["atras"])) {
    $nombre = $_GET["atras"];
    $rutaActual = $nombre;
}

//If para funcion ir
if (isset($_GET["nombreIr"])) {
    $nombre = $_GET["nombreIr"];
    $rutaActual = $nombre;
}

//If para funcion cambiar nombre
if (isset($_GET["nombreNuevo"]) && isset($_GET["nombreViejo"])) {
    $nombreNuevo = $_GET["nombreNuevo"];
    $nombreViejo = $_GET["nombreViejo"];
    $path = $_GET["path"];
    $rutaActual = $path;
    rename($nombreViejo, $nombreNuevo);

}

//If para funcion crear
if (isset($_GET["crear"]) && isset($_GET["tipo"])) {
    $crear = $_GET["crear"];
    $tipo = $_GET["tipo"];
    $path = $_GET["path"];
    $rutaActual = $path;
    if($tipo == "archivo"){
        touch($crear);
    }else{
        mkdir($crear);
    }
}

//If para funcion eliminar
if (isset($_GET["eliminar"]) && isset($_GET["tipo"])) {
    $eliminar = $_GET["eliminar"];
    $tipo = $_GET["tipo"];
    $path = $_GET["path"];
    $rutaActual = $path;
    if($tipo == "archivo"){
        unlink($eliminar);
    }else{
        auxiliarEliminar($eliminar);
    }
}

//If para funcion copiar
if (isset($_GET["CopiarViejo"]) && isset($_GET["nuevaDireccion"])) {
    $direccionAntigua = $_GET["CopiarViejo"];
    $direccionNueva= $_GET["nuevaDireccion"];
    $path = $_GET["path"];
    $rutaActual = $path;
    AuxiliarCopiar($direccionAntigua, $direccionNueva);
}

//If para funcion mover
if (isset($_GET["direccionViejo"]) && isset($_GET["direccionNuevo"])) {
    $direccionAntigua = $_GET["direccionViejo"];
    $direccionNueva= $_GET["direccionNuevo"];
    $path = $_GET["path"];
    $rutaActual = $path;
   
    AuxiliarCopiar($direccionAntigua, $direccionNueva);
    if(is_dir($direccionAntigua)){
        auxiliarEliminar($direccionAntigua);
    }else{
        unlink($direccionAntigua);
    }
}

//If para funcion Informacion permisos
if (isset($_GET["infPermisos"]) && isset($_GET["nombre"])) {
    $mostrar="true";
    $infPermisos = $_GET["infPermisos"];
    $nombre = $_GET["nombre"];
    $path = $_GET["path"];
    $rutaActual = $path;

    $titulo;
    $permisos;
    $propietario;
    $grupo;

    exec("ls -l ".$infPermisos, $elementos);

    foreach($elementos as $elemento){
        $datos = explode(" ", $elemento);
        $datos= array_filter($datos, "filtro");

        if($nombre == end($datos)){
            $titulo=array_pop($datos);
            for ($i = 1; $i <= 4; $i++) {
                array_pop($datos);
            }
            $grupo=array_pop($datos);
            $propietario=array_pop($datos);
            array_pop($datos);
            $permisos=array_pop($datos);
            
            break;
        }else{
            $titulo="no lo encontró";
        }
    }
}

//If para cerrar en informacion permisos
if (isset($_GET["cerrar"])) {
    $cerrar = $_GET["cerrar"];
    $mostrar= $cerrar;
    $path = $_GET["path"];
    $rutaActual = $path;
}

//If para funcion Cambiar permisos
if (isset($_GET["direccionCambio"]) && isset($_GET["permisosCambio"])) {
    $direccion = $_GET["direccionCambio"];
    $permisos = $_GET["permisosCambio"];
    $path = $_GET["path"];
    $rutaActual = $path;
    exec("echo ".$contraseña." | sudo -S chmod ".$permisos." ".$direccion);
}

//If para funcion cambiar propietario
if (isset($_GET["direccionPropietario"]) && isset($_GET["nombreUsuario"])) {
    $direccionPropietario = $_GET["direccionPropietario"];
    $nombreUsuario = $_GET["nombreUsuario"];
    $path = $_GET["path"];
    $rutaActual = $path;

    exec("echo ".$contraseña." | sudo -S chown ".$nombreUsuario.":".$nombreUsuario." ".$direccionPropietario);
    
}
?>