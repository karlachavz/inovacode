<?php
session_start();

// Verificar que el usuario haya iniciado sesión
if (!isset($_SESSION['profesor_usuario'])) {
    header("Location: ../alumno/login-alumno.php");
    exit();
}

// Obtener el ID de usuario de la sesión
$id_usuario =  $_SESSION['id_usuario_profesor'];
$usuario = $_SESSION['profesor_usuario'];


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Complementarias</title>
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





                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="menu-profesor.php">Mis grupos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Estadisticas</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../php/login/cerrar-sesion.php">Cerrar sesión</a>
                    </li>
                </ul>

                <?php
                require("../php/peticiones/profesor/peticiones-profesor.php");

                $datos_profesor = obtener_datos_profesor($id_usuario);

                while ($p = $datos_profesor->fetch_assoc()) {
                ?>

                    <a class=" d-flex flex-column p-0 align-items-center" aria-disabled="true"><img src="../img/perfil.png" alt="Logo"
                            width="30" height="30" class="d-inline-block align-text-end d-none d-md-block"><?= $p['nombre']; ?> <?= $p['apellido_paterno']; ?> <?= $p['apellido_materno']; ?></a>
                <?php } ?>
            </div>
        </div>
    </nav>




    <div class="container mt-5">

        <div class="text-center mb-4">
            <?php 
            $nombre_grupo =obtener_nombre_grupo($_GET['id_grupo']);
            while ($n = $nombre_grupo->fetch_assoc()) {
            ?>
            <h3>
            <?= $n['nombre']; ?>
            </h3>
            <?php } ?>
            <h4>Asistencia</h4>
        </div>

       

        <div class="table-responsive">

            <table class="table table-bordered table-striped text-center align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>Alumno</th>
                        
                        <?php
                        //agrega 20 al encabezado de la tabla con su dia respectivo 
                        for ($i = 1; $i <= 20; $i++) {
                            echo "<th>Día $i</th>";
                        }
                        ?>

                        <th>Porcentaje de asistencia</th>

                    </tr>
                </thead>

                <tbody>

                    <?php

                    $lista_alumnos = obtener_lista_alumnos($_GET['id_grupo']);
                    while ($alumno = $lista_alumnos->fetch_assoc()) {
                    ?>

                        <tr>
                            <td>
                                <?= $alumno['nombre']; ?> <?= $alumno['apellido_paterno']; ?> <?= $alumno['apellido_materno']; ?>
                            </td>

                            <?php
                            for ($i = 1; $i <= 20; $i++) {
                            ?>

                                <td>
                                    <input
                                        type="checkbox"
                                        class="form-check-input"
                                        name="asistencia[<?= $alumno['numero_control']; ?>][<?= $i; ?>]">
                                </td>

                            <?php
                            }
                            ?>

                            <td>
                                10 asistencias:
                                %80
                                
                            </td>

                        </tr>

                    <?php
                    }
                    ?>

                </tbody>

            </table>

        </div>

        <div class="text-center mt-4">
            <button class="btn btn-primary">
                Guardar asistencia
            </button>

            <a href="asignar-calificacion.php"></a>
        </div>

    </div>


    <br><br>

    <!--PIE DE PÁGINA-->

    <footer class="fixed-bottom bg-light py-3 mt-5">
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