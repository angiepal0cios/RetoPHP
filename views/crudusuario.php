<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Configuración básica del documento -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Usuarios - CRUD</title>
    <!-- Ajuste de la visualización en dispositivos -->
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- Estilos Bootstrap (CDN) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <!-- Estructura principal de la página -->
    <div class="d-flex mt-4" id="wrapper">
        <div id="page-content-wrapper" class="w-100">
            <div class="container" id="contenido">
                <!-- Encabezado principal -->
                <div class="center d-flex justify-content-center">
                    <h2><strong>Registra tus usuarios</strong></h2>
                </div>
                <!-- Formulario para agregar un nuevo usuario -->
                <form action="<?php echo constant('URL'); ?>crudusuario/crear" method="POST">
                    <div class="col-md-12 mt-3">
                        <!-- Campos del formulario -->
                        <div class="form-row py-2">
                            <div class="col-md-4">
                                <p><strong>NOMBRE:</strong></p>
                            </div>
                            <div class="col-md-8">
                                <input required name="nombre" type="text" class="form-control" placeholder="Ingrese el nombre...">
                            </div>
                        </div>
                        <div class="form-row py-2">
                            <div class="col-md-4">
                                <p><strong>TELÉFONO:</strong></p>
                            </div>
                            <div class="col-md-8">
                                <input required name="telefono" type="text" class="form-control" placeholder="Ingrese el teléfono...">
                            </div>
                        </div>
                        <div class="form-row py-2">
                            <div class="col-md-4">
                                <p><strong>CORREO:</strong></p>
                            </div>
                            <div class="col-md-8">
                                <input required name="correo" type="email" class="form-control" placeholder="Ingrese el correo...">
                            </div>
                        </div>
                        <div class="form-row py-2">
                            <div class="col-md-4">
                                <p><strong>COMPAÑÍA:</strong></p>
                            </div>
                            <div class="col-md-8">
                                <input required name="compania" type="text" class="form-control" placeholder="Ingrese la compañía...">
                            </div>
                        </div>
                        <div class="form-row py-2">
                            <div class="col-md-4">
                                <p><strong>CALLE:</strong></p>
                            </div>
                            <div class="col-md-8">
                                <input required name="calle" type="text" class="form-control" placeholder="Ingrese la calle..." />
                            </div>
                        </div>
                        <div class="form-row py-2">
                            <div class="col-md-4">
                                <p><strong>LATITUD:</strong></p>
                            </div>
                            <div class="col-md-8">
                                <input required name="latitud" type="number" step=".01" class="form-control" placeholder="Ingrese la latitud..." />
                            </div>
                        </div>
                        <div class="form-row py-2">
                            <div class="col-md-4">
                                <p><strong>LONGITUD:</strong></p>
                            </div>
                            <div class="col-md-8">
                                <input required name="longitud" type="number" step=".01" class="form-control" placeholder="Ingrese la longitud..." />
                            </div>
                        </div>
                        <!-- Botón para añadir un nuevo usuario -->
                        <div class="d-flex flex-row justify-content-center mt-4">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-plus-circle"></i> AÑADIR</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Tabla para mostrar la lista de usuarios -->
                <div class="center">
                    <div class="container mt-4">
                        <!-- Tabla con desplazamiento vertical -->
                        <div class="table-wrapper-scroll-y my-custom-scrollbar table-responsive">
                            <table class="table table-striped">
                                <!-- Cabecera de la tabla -->
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Teléfono</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Compañía</th>
                                        <th scope="col">Calle</th>
                                        <th scope="col">Latitud</th>
                                        <th scope="col">Longitud</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-usuarios">
                                    <!-- Filas de la tabla generadas dinámicamente -->
                                    <?php
                                    // Generar filas de la tabla a partir de los datos de los usuarios
                                    require_once 'models/usuario.php';
                                    foreach ($this->usuarios as $row) {
                                        $usuario = new usuario();
                                        $usuario = $row;
                                    ?>
                                        <tr id="fila-<?php echo $usuario->id; ?>">
                                            <!-- Datos del usuario -->
                                            <td><?php echo $usuario->id; ?></td>
                                            <td><?php echo $usuario->nombre; ?></td>
                                            <td><?php echo $usuario->telefono; ?></td>
                                            <td><?php echo $usuario->correo; ?></td>
                                            <td><?php echo $usuario->compania; ?></td>
                                            <td><?php echo $usuario->calle; ?></td>
                                            <td><?php echo $usuario->latitud; ?></td>
                                            <td><?php echo $usuario->longitud; ?></td>
                                            <td>
                                                <div role="group" class="mb-2 btn-group-md btn-group">
                                                    <!-- Botón para editar -->
                                                    <button data-id="<?php echo $usuario->id; ?>" class="bEditar btn-shadow btn-hover-shine btn btn-success btn-md btn-pill pl-3" title="Editar">
                                                        <i class="iEditar fa fa-pencil" aria-hidden="true"></i>
                                                    </button>
                                                    <!-- Botón para eliminar -->
                                                    <button data-id="<?php echo $usuario->id; ?>" class="bEliminar btn-shadow btn-hover-shine btn btn-danger btn-md btn-pill pr-3" title="Eliminar">
                                                        <i class="iEliminar fa fa-trash" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap y jQuery (CDN) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Scripts de lógica de negocio -->
    <script src="<?php echo constant('URL'); ?>public/js/scriptUsuario.js"></script>

    <!-- Iconos de Fontawesome -->
    <script src="https://kit.fontawesome.com/ace083e1cb.js" crossorigin="anonymous"></script>
</body>

</html>