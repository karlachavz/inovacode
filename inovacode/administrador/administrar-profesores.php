<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InovaCode</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
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

    <div class="container row justify-content-center mt-5 mb-5">

        <div class="text-center col-12 col-md-6 col-lg-4 me-5">
            <div class="text-center">
                <h2>Administrar profesores</h2>
            </div>

            <?php
            if (isset($_GET['mensaje'])) {

                if ($_GET['mensaje'] == "duplicado") {
                    echo "<div class='alert alert-danger' role='alert'>Ya existe un usuario con ese nombre.</div>";
                }

                if ($_GET['mensaje'] == "exitoso") {
                    echo "<div class='alert alert-success' role='alert'>Usuario agregado correctamente</div>";
                }



                if ($_GET['mensaje'] == "desconocido") {
                    echo "<div class='alert alert-danger' role='alert'>Ha ocurrido un error inesperado al reg.</div>";
                }
            }
            ?>

            <form action="../php/crud-cuentas-profesores/insertar-profesor.php" method="post">


                <div class="mb-3 text-start">
                    <label for="user" class="form-label fw-bold">Usuario</label>
                    <input name="u" type="text" class="form-control" id="user" placeholder="Ej. admin01" required minlength="4" maxlength="20" pattern="[A-Za-z0-9_]+" title="Solo letras, números o guiones bajos">
                </div>

                <div class="mb-3 text-start">
                    <label for="name" class="form-label fw-bold">Nombre</label>
                    <input name="n" type="text" class="form-control" id="name"  required minlength="1" maxlength="50" pattern="[A-Za-z]+" title="Solo admite letras">
                </div>

                <div class="mb-3 text-start">
                    <label for="fistLastName" class="form-label fw-bold">Primer apellido</label>
                    <input name="ap1" type="text" class="form-control" id="fistLastName"  required minlength="1" maxlength="50" pattern="[A-Za-z]+" title="Solo admite letras">
                </div>

                 <div class="mb-3 text-start">
                    <label for="SecondLastName" class="form-label fw-bold">Segundo apellido</label>
                    <input name="ap2" type="text" class="form-control" id="SecondLastName"  required minlength="1" maxlength="50" pattern="[A-Za-z]+" title="Solo admite letras">
                </div>

                <div class="mb-3 text-start">
                    <label name="e" for="correo" class="form-label fw-bold">Correo electronico</label>
                    <input name="e" type="email" class="form-control" id="correo" placeholder="example@gmail.com" required>
                </div>


                <div class="mb-3 text-start">
                    <label name="contrasena" for="password" class="form-label fw-bold">Contraseña</label>
                    <input name="p" type="password" class="form-control" id="contrasena" placeholder="********" required minlength="6" title="Debe tener al menos 6 caracteres">
                </div>


                <button type="submit" class="btn btn-custom  mb-5">Crear cuenta</button>

            </form>
        </div>

        <!--tabla de datos de profesores-->
        <div class="table-responsive mt-5 col-12 col-md-6">
            <?php require("../php/crud-cuentas-profesores/tabla-profesores.php"); ?>

            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Usuario</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $valores = consultar_tabla_profesores();
                    while ($p = $valores->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $p['usuario']; ?></td>
                            <td><?php echo $p['nombre'];?> <?php echo $p['apellido_paterno'];?> <?php echo $p['apellido_materno'];?></td>
                            <td><?php echo $p['correo']; ?></td>
                            <td>
                                <!-- BOTÓN EDITAR que abre el modal -->
                                <button
                                    class="btn btn-primary btn-sm editarBtn"
                                    data-id="<?php echo $p['id_profesor']; ?>"
                                    data-usuario="<?php echo $p['usuario']; ?>"
                                    data-nombre="<?php echo $p['nombre']; ?>"
                                    data-apellido1="<?php echo $p['apellido_paterno']; ?>"
                                    data-apellido2="<?php echo $p['apellido_materno']; ?>"
                                    data-correo="<?php echo $p['correo']; ?>"
                                    data-pass="<?php echo $p['contrasena']; ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editarModal">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <!-- BOTÓN ELIMINAR -->
                                <a href="../php/crud-cuentas-profesores/eliminar-profesor.php?ID=<?php echo $p['id_profesor']; ?>"
                                    class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
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

                <form action="../php/crud-cuentas-profesores/actualizar-profesor.php" method="POST">
                    <div class="modal-body">

                        <input type="hidden" name="id" id="edit-id">

                        <div class="mb-3">
                            <label for="edit-user" class="form-label fw-bold">Usuario</label>
                            <input type="text" name="u" id="edit-user" class="form-control" required minlength="4" maxlength="20" pattern="[A-Za-z0-9_]+" title="Solo letras, números o guiones bajos">
                        </div>

                        <div class="mb-3">
                            <label for="edit-name" class="form-label fw-bold">Nombre</label>
                            <input type="text" name="n" id="edit-name" class="form-control" required minlength="1" maxlength="50" pattern="[A-Za-z]+" title="Solo letras">
                        </div>

                        <div class="mb-3">
                            <label for="edit-ap1" class="form-label fw-bold">Primer apellido</label>
                            <input type="text" name="ap1" id="edit-ap1" class="form-control" required minlength="1" maxlength="50" pattern="[A-Za-z]+" title="Solo letras">
                        </div>

                        <div class="mb-3">
                            <label for="edit-ap2" class="form-label fw-bold">Segundo apellido</label>
                            <input type="text" name="ap2" id="edit-ap2" class="form-control" required minlength="1" maxlength="50" pattern="[A-Za-z]+" title="Solo letras">
                        </div>

                        <div class="mb-3">
                            <label for="edit-email" class="form-label fw-bold">Correo electrónico</label>
                            <input type="email" name="e" id="edit-email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-pass" class="form-label fw-bold">Contraseña</label>
                            <input type="password" name="p" id="edit-pass" class="form-control" required minlength="6">
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
                    const id = this.getAttribute("data-id");
                    const usuario = this.getAttribute("data-usuario");
                    const nombre =this.getAttribute("data-nombre");
                    const apellido1 =this.getAttribute("data-apellido1");
                    const apellido2 =this.getAttribute("data-apellido2");
                    const correo = this.getAttribute("data-correo");
                    const pass = this.getAttribute("data-pass");
                    

                    // Cargar datos al modal
                    document.getElementById("edit-id").value = id;
                    document.getElementById("edit-name").value = nombre;
                    document.getElementById("edit-ap1").value = apellido1;
                    document.getElementById("edit-ap2").value = apellido2;
                    document.getElementById("edit-user").value = usuario;
                    document.getElementById("edit-email").value = correo;
                    document.getElementById("edit-pass").value = pass;
                });
            });
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