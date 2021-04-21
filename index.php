<?php
//      /var/www/html/sistemaArchivos$ git commit -a -m "Alto cambio"
//      /var/www/html/sistemaArchivos$ git add --all


echo '
<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="funcionalidad.js"></script>
';
include 'estructura.php'

?>

<html>

<head>
    <title> Sistema de Exploración de Archivos </title>
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <div class="input-group">
                <div style="margin-right: 20px">
                    <input id="direccion" type="text" readonly="readonly" class="form-control" style="width: 300px" value= <?= $rutaActual ?>>   
                </div>
                <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#modalIr"> Ir </button>
                <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#modalCambiarNombre"> Cambiar Nombre </button>
                <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#modalCrear"> Crear </button>
                <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#modalEliminar"> Eliminar </button>
                <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#modalCopiar"> Copiar </button>
                <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#modalMover"> Mover </button>
                <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#modalInfPermisos"> Informacion Permisos </button>
                <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#modalCambiarPermisos"> Cambiar Permisos </button>
                <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#modalCambiarPropietario"> Cambiar Propietario </button>

            </div>
        </form>
    </nav>

    <div class="modal-dialog modal-dialog-centered" role="document" style="display:<?= $mostrar ?>;margin-top:-200px; margin-bottom:-200px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle"> Información de Permisos </h4>
            </div>
            <div class="modal-body">
                <h4><?= $titulo?></h4>
                <p>Permisos: <?= $permisos?></p>
                <p>Propietario: <?= $propietario?></p>
                <p>Grupo: <?= $grupo?></p>
            </div>
            <div class="modal-footer">
                <button onclick="cerrar()" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>

    <section class="d-flex flex-row flex-wrap p-4 text-center" id="filesSection">
		<?php listarElementos($rutaActual); ?>
	</section>

    <div class="modal fade" id="modalIr" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle"> Ir </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="false">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style = "margin:-2px;"> Ingrese la direccion a la que desea ir:</p>
                    <input id="nombreIr" type="text" class="form-control" placeholder="Ejemplo: /var/www/html">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button onclick="irDirectorio()" type="button" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCambiarNombre" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle"> Cambiar Nombre </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="false">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style = "margin:-2px;"> Ingrese la dirección del elemento a cambiar:</p>
                    <input id="nombreViejo" type="text" class="form-control" placeholder="Ejemplo: /var/www/html/elementoQueDeseaCambiarNombre">
                    <p style = "margin-top:15px; margin-bottom:-2px;">Ingrese el nuevo nombre para el elemento:</p>
                    <input id="nombreNuevo" type="text" class="form-control" placeholder="Ejemplo: nuevoNombre">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button onclick="cambiarNombre()" type="button" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCrear" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle"> Crear </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="false">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style = "margin:-2px;"> Ingrese la dirección donde quiere ubicar el nuevo elemento:</p>
                    <input id="direccionCrear" type="text" class="form-control" placeholder="Ejemplo: /var/www/html">

                    <p style = "margin-top:15px; margin-bottom:-2px;">Ingrese el nuevo nombre del nuevo elemento:</p>
                    <input id="nombreCrear" type="text" class="form-control" placeholder="Ejemplo: nombre"><br>
                    
                    <p>Seleccione si quiere crear un archivo o un directorio:</p>

                    <input id="crearArchivo" type="radio" name="tipoCrear" value="archivo" checked> Archivo <br>
                    <input id="crearDirectorio" type="radio" name="tipoCrear" value="directorio"> Directorio
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button onclick="crearElemento()" type="button" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle"> Eliminar </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="false">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <p>Seleccione si quiere eliminar un archivo o un directorio:</p>

                    <input id="eliminarArchivo" type="radio" name="tipoEliminar" value="archivo" checked> Archivo <br>
                    <input id="eliminarDirectorio" type="radio" name="tipoEliminar" value="directorio"> Directorio  
                    <p style="margin-top:20px; margin-bottom:-2px;">Ingrese la dirección del elemento a eliminar:</p>
                    <input id="eliminar" type="text" class="form-control" placeholder="Ejemplo: /var/www/html/elementoQueDeseaEliminar">   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button onclick="eliminarElemento()" type="button" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCopiar" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle"> Copiar </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="false">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style = "margin:-2px;">Ingrese la direccion del elemento que desea copiar: </p>
                    <input id="CopiarViejo" type="text" class="form-control" placeholder="Ejemplo: /var/www/html/elementoACopiar">
                    <p style = "margin-top:15px; margin-bottom:-2px;">Ingrese la dirección donde desea copiar el elemento:</p>
                    <input id="CopiarNuevo" type="text" class="form-control" placeholder="Ejemplo: /var/www/html/directorioDondeSeCopia">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" onclick="copiarElemento()" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalMover" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle"> Mover </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="false">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style = "margin:-2px;">Ingrese la dirección del elemento que desea mover:</p>
                    <input id="direccionMoverViejo" type="text" class="form-control" placeholder="Ejemplo: /var/www/html/nombreElemento">
                    <p style = "margin-top:15px; margin-bottom:-2px;">Ingrese la dirección donde se va a mover el elemento:</p>
                    <input id="direccionMoverNuevo" type="text" class="form-control" placeholder="Ejemplo: /var/www/html/directorioDondeSeVaAMover">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button onclick = "moverElemento()" type="button" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalInfPermisos" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle"> Información de Permisos </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="false">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style = "margin:-2px;">Ingrese la dirección del elemento al cual quiere ver sus permisos:</p>
                    <input id="verPermisos" type="text" class="form-control" placeholder="Ejemplo: /var/www/html/elementoQueDeseaVerPermisos">   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalInfPermisos2" onclick="verPermisos()">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCambiarPermisos" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle"> Cambiar Permisos </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="false">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <h5 class="modal-title"> Permisos: </h5>
                        0: Ningun permiso <br>
                        1: Permiso de ejecución <br>
                        2: Permiso de escritura <br>
                        3: Permiso de ejecución y escritura <br>
                        4: Permiso de lectura <br>
                        5: Permiso de lectura y ejecución <br>
                        6: Permiso de lectura y escritura <br>
                        7: Todos los permisos <br>
                    </p>
                    <p style = "margin:-2px">Ingrese la dirección del elemento al cual quiere cambiar sus permisos:</p>
                    <input id="cambiarPermisos" type="text" class="form-control" placeholder="Ejemplo: /var/www/html/elementoQueDeseaCambiarPermisos"> <br> 
                    <p style = "margin-bottom:-1px"> Ponga el número según los permisos que quiera otorgar: </p> 
                    <p>
                    Usuario: <input id="numeroUsuario" type="number" placeholder="Usuario" > <br>
                    Grupo: &nbsp <input id="numeroGrupo" type="number" placeholder="Grupo"> <br>
                    Otros:  &nbsp&nbsp <input id="numeroOtros" type="number" placeholder="Otros">
                    </p> 

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button onclick="cambiarPermisos()" type="button" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCambiarPropietario" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle"> Cambiar Propietario </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="false">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p style = "margin:-2px;">Ingrese la dirección del elemento al que desea cambiarle el propietario:</p>
                    <input id="direccionPropietario" type="text" class="form-control" placeholder="Ejemplo: /var/www/html/prueba">
                    <p style = "margin-top:15px; margin-bottom:-2px;">Ingrese el nombre del usuario:</p>
                    <input id="nombreUsuario" type="text" class="form-control" placeholder="Ejemplo: usuario">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button onclick='cambiarPropietario()' type="button" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

 

</body>

</html>