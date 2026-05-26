<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Alumno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilos.css">

</head>

<body>
    <!--NAVBAR  (.navbar-nav-scroll)-->

    <nav class="navbar navbar-expand-lg bg-body-tertiary ">
        <div class="container-fluid">
            <!--logo y marca -->
            <a class="navbar-brand d-flex align-items-center">
                <img src="../img/logo.jpeg" alt="Logo" width="50" height="50"
                    class="d-inline-block align-text-top me-2">
                <div class="d-flex flex-column">
                    <span class="fw-bold">INNOVACODE</span>
                    <small>Actividades complementarias</small>
                </div>
            </a>



            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav ms-auto me-1 ">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Usuarios
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="administrar-administradores.php">Administrar cuentas
                                    administrativas</a></li>
                            <li><a class="dropdown-item" href="administrar-alumnos.php">Administrar cuentas de
                                    alumnos</a></li>
                            <li><a class="dropdown-item" href="administrar-profesores.php">Administrar cuentas de
                                    profesores</a></li>
                        </ul>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Descarga</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="menu-administrador.php">Actividades
                            complementarias</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../index.html">Cerrar sesión</a>
                    </li>
                </ul>

                <a class=" d-flex flex-column p-0 " aria-disabled="true"><img src="../img/perfil.png" alt="Logo"
                        width="30" height="30" class="d-inline-block align-text-end d-none d-md-block">Administrador</a>
            </div>
        </div>
    </nav>
    <!--contenido-->

    <div class="container  justify-content-center mt-5 mb-5">


        <div class="text-center ">
            <h2>Administrar administrativos</h2>
        </div>


        <!--Mensajes de alerta-->
        <?php
        if (isset($_GET['mensaje'])) {

            if ($_GET['mensaje'] == "duplicado") {
                echo "<div class='alert alert-danger' role='alert'>Ya existe un usuario con ese nombre.</div>";
            }

            if ($_GET['mensaje'] == "exito") {
                echo "<div class='alert alert-success' role='alert'>Usuario agregado correctamente.</div>";
            }

            if ($_GET['mensaje'] == "editado") {
                echo "<div class='alert alert-success' role='alert'>Datos del usuario actualizados exitosamente.</div>";
            }

            if ($_GET['mensaje'] == "campos") {
                echo "<div class='alert alert-danger' role='alert'>Ha ocurrido un error, favor de llenar todos los campos.</div>";
            }

            if ($_GET['mensaje'] == "desconocido") {
                echo "<div class='alert alert-danger' role='alert'>Ha ocurrido un error inesperado al registrar.</div>";
            }

            if ($_GET['mensaje'] == "error") {
                echo "<div class='alert alert-danger' role='alert'>Ha ocurrido un error inesperado.</div>";
            }
        }
        ?>

        <!--Inicio del formulario-->
        <form action="../php/crud-cuentas-administradores/insertar-administrador.php" method="post">

            <div class="text-center row">



                <div class="mb-3  text-start col-md-3">
                    <label for="nombre" class="form-label fw-bold">Nombre</label>
                    <input name="n" type="text" class="form-control" id="nombre" placeholder="Nombre" required minlength="1" maxlength="100" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y espacios">
                </div>

                <div class="mb-3 text-start col-md-3">
                    <label for="apellido_paterno" class="form-label fw-bold">Apellido paterno</label>
                    <input name="ap1" type="text" class="form-control" id="apellido_paterno" placeholder="Apellido paterno" required minlength="1" maxlength="100" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y espacios">
                </div>

                <div class="mb-3 text-start col-md-3">
                    <label for="apellido_materno" class="form-label fw-bold">Apellido materno</label>
                    <input name="ap2" type="text" class="form-control" id="apellido_materno" placeholder="Apellido paterno" required minlength="1" maxlength="100" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y espacios">
                </div>



                <div class="mb-3 text-start col-md-3">
                    <label for="user" class="form-label fw-bold">Usuario</label>
                    <input name="u" type="text" class="form-control" id="user" placeholder="Ej. admin01" required minlength="4" maxlength="20" pattern="[A-Za-z0-9_]+" title="Solo letras, números o guiones bajos">
                </div>

                <div class="mb-3 text-start col-md-3">
                    <label name="correo" for="password" class="form-label fw-bold">Correo electronico</label>
                    <input name="e" type="email" class="form-control" id="correo" placeholder="example@gmail.com" required>
                </div>


                <div class="mb-3 text-start col-md-3">
                    <label name="contrasena" for="password" class="form-label fw-bold">Contraseña</label>
                    <input name="p" type="password" class="form-control" id="contrasena" placeholder="********" required minlength="6" title="Debe tener al menos 6 caracteres">
                </div>

                <div class="text-start col-md-3 pt-4">
                    <button type="submit" class="btn btn-custom  mb-5">Crear cuenta</button>
                </div>

            </div>
        </form>


        <!--tabla de datos administradores-->
        <div class="table-responsive mt-5 ">
            <?php require("../php/crud-cuentas-administradores/ver-administrador.php"); ?>

            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $valores = conectando();
                    while ($p = $valores->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $p['nombre']; ?> <?php echo $p['apellido_materno']; ?> <?php echo $p['apellido_paterno']; ?></td>
                            <td><?php echo $p['usuario']; ?></td>
                            <td><?php echo $p['correo']; ?></td>
                            <td>
                                <!-- BOTÓN EDITAR que abre el modal -->
                                <button
                                    class="btn btn-primary btn-sm editarBtn"
                                    data-id-administrador="<?php echo $p['id_administrador']; ?>"
                                    data-id-usuario="<?php echo $p['id_usuario']; ?>"
                                    data-nombre="<?php echo $p['nombre']; ?>"
                                    data-ap1="<?php echo $p['apellido_paterno']; ?>"
                                    data-ap2="<?php echo $p['apellido_materno']; ?>"
                                    data-usuario="<?php echo $p['usuario']; ?>"
                                    data-correo="<?php echo $p['correo']; ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editarModal">
                                    Editar
                                </button>

                                <!-- BOTÓN ELIMINAR -->
                                <a href="../php/crud-cuentas-administradores/eliminar-administrador.php?id=<?php echo $p['id_usuario']; ?>"
                                    class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

    <!-- ========================= -->
    <!-- MODAL EDITAR ADMINISTRADOR -->
    <!-- ========================= -->

    <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editarModalLabel">Editar Administrador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <form action="../php/crud-cuentas-administradores/actualizar-administrador.php" method="POST">
                    <div class="modal-body">

                        <input type="hidden" name="id-admin" id="edit-id-admin">
                        <input type="hidden" name="id-user" id="edit-id-user">

                        <div class="mb-3">
                            <label for="edit-user" class="form-label fw-bold">Usuario</label>
                            <input type="text" name="u" id="edit-user" class="form-control" required minlength="4" maxlength="20" pattern="[A-Za-z0-9_]+" title="Solo letras, números o guiones bajos">
                        </div>

                        <div class="mb-3">
                            <label for="edit-name" class="form-label fw-bold">Nombre</label>
                            <input type="text" name="n" id="edit-name" class="form-control" required minlength="1" maxlength="100" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y espacios">
                        </div>

                        <div class="mb-3">
                            <label for="edit-ap1" class="form-label fw-bold">Apellido paterno</label>
                            <input type="text" name="ap1" id="edit-ap1" class="form-control" required minlength="1" maxlength="100" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y espacios">
                        </div>

                        <div class="mb-3">
                            <label for="edit-ap2" class="form-label fw-bold">Apellido materno</label>
                            <input type="text" name="ap2" id="edit-ap2" class="form-control" required minlength="1" maxlength="100" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y espacios">
                        </div>

                        <div class="mb-3">
                            <label for="edit-email" class="form-label fw-bold">Correo electrónico</label>
                            <input type="email" name="e" id="edit-email" class="form-control" required>
                        </div>

                        <hr>
                        <!--si la check box esta activada se esta habilidata el input del password y este esta vacio y se puede cambiar la contraseña, si no esta desabilidato y no se puede canbiar la contraseña-->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"
                                    id="checkbox_cambiar" name="cambiar_pass">
                                <label class="form-check-label" for="defaultCheck1">
                                    Cambiar contraseña
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="edit-pass" class="form-label fw-bold">Escribe nueva contraseña</label>
                            <input type="password" name="p" id="edit-pass" class="form-control" minlength="6" disabled>
                        </div>



                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- SCRIPT PARA LLENAR EL MODAL -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editarBtns = document.querySelectorAll(".editarBtn");

            editarBtns.forEach(btn => {
                btn.addEventListener("click", function() {
                    // Tomar datos del botón
                    const id_administrador = this.getAttribute("data-id-administrador");
                    const id_usuario = this.getAttribute("data-id-usuario");
                    const nombre = this.getAttribute("data-nombre");
                    const ap1 = this.getAttribute("data-ap1");
                    const ap2 = this.getAttribute("data-ap2");
                    const usuario = this.getAttribute("data-usuario");
                    const correo = this.getAttribute("data-correo");


                    // Cargar datos al modal
                    document.getElementById("edit-id-admin").value = id_administrador;
                    document.getElementById("edit-id-user").value = id_usuario;
                    document.getElementById("edit-user").value = usuario;
                    document.getElementById("edit-name").value = nombre;
                    document.getElementById("edit-ap1").value = ap1;
                    document.getElementById("edit-ap2").value = ap2;
                    document.getElementById("edit-email").value = correo;

                });
            });
        });
    </script>

    <script>
        const checkbox = document.getElementById("checkbox_cambiar");
        const password = document.getElementById("edit-pass");

        checkbox.addEventListener("change", function() {

            if (this.checked) {
                password.disabled = false;
                password.required = true;
            } else {
                password.disabled = true;
                password.required = false;
                password.value = "";
            }

        });
    </script>




    <!--PIE DE PÁGINA-->

    <footer class="fixed-bottom footer mt-auto py-3">
        <div class="container text-center">
            <small>Copyright &copy; InovaCode</small>
        </div>
    </footer>


    <!--JS BOOTSTRAP-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>




</body>

</html>