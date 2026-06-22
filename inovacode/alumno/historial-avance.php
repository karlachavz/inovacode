<?php
session_start();

// Verificar que el usuario haya iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../alumno/login-alumno.php");
    exit();
}

// Obtener el ID de usuario de la sesión
$id_usuario = $_SESSION['id_usuario'];
$usuario = $_SESSION['usuario'];
$nombre = $_SESSION['nombre'];
$apellido1 = $_SESSION['apellido1'];
$apellido2 = $_SESSION['apellido2'];
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
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary ">
        <div class="container-fluid">
            <a class="navbar-brand">
                <img src="../img/logo.jpeg" alt="Logo" width="50" height="50"
                    class="d-inline-block align-text-top">
                <div class="d-flex flex-column me-auto">
                    <a href="#" class="text-decoration-none text-dark fw-bold">INNOVACODE</a> Actividades complementarias
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav ms-auto me-1 ">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="menu-alumno.php">Actividades ofertadas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Historial de avance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../php/login/cerrar-sesion.php">Cerrar sesión</a>
                    </li>
                </ul>

                <a class=" d-flex flex-column p-0 " aria-disabled="true">
                    <img src="../img/perfil.png" alt="Logo" width="30" height="30"
                        class="d-inline-block align-text-end d-none d-md-block">
                    <span> <?php echo $nombre ?></span></a>
            </div>
        </div>
    </nav>

    <!--CONTENIDO-->

    <div class="container mt-5">
        <h2 class="text-center mb-4 fw-bold">Historial de avance</h2>

        <!--Alertas-->
        <?php
        if (isset($_GET['mensaje'])) {

            if ($_GET['mensaje'] == "denegado") {
                echo "<div class='alert alert-danger' role='alert'>Ha ocurrido un error. Acceso denegado</div>";
            }


            if ($_GET['mensaje'] == "inscrito") {
                echo "<div class='alert alert-success' role='alert'>Se ha inscrito exitosamente al grupo </div>";
            }
        }
        ?>



        <a href="menu-alumno.php" class="btn btn-custom"><i class="bi bi-arrow-left-circle"></i> Regresar</a>


        <div class="row p-0">
            <h4 class="mt-5">Complementarias en curso </h4>
            <hr>
            <!---Cards grupos-->
            <?php require("../php/grupo-alumno/ver-grupos-alumnos.php"); ?>

            <?php

            // Llamamos a la función que trae todos los datos
            $resultado = consultar($usuario);

            // Si no hay registros
            if ($resultado->num_rows == 0) {

                echo '
                <div class="text-center py-5 text-muted">
                <i class="bi bi-calendar-x fs-1"></i>
                <p class="mt-3 mb-1 fw-semibold">
                    No tienes actividades inscritas
                </p>
                <small>
                    Aún no estás registrado en ninguna actividad complementaria este periodo.
                </small>
                </div>
                ';
            }

            // Arreglo donde vamos a agrupar los datos por grupo
            $grupos = [];
            // Recorremos cada fila devuelta por la BD
            while ($p = $resultado->fetch_assoc()) {
                // Guardamos el id del grupo actual
                $id = $p['id_grupo'];
                // Si el grupo NO existe aún en el arreglo, lo creamos
                if (!isset($grupos[$id])) {
                    $grupos[$id] = [
                        //Datos delgrupo 
                        'id_grupo' => $p['id_grupo'],
                        'nombre_grupo' => $p['nombre_grupo'],
                        'nombre' => $p['nombre'],
                        'apellido_paterno' => $p['apellido_paterno'],
                        'apellido_materno' => $p['apellido_materno'],
                        //aquí guardaremos todos lo horarios
                        'horarios' => []
                    ];
                };
                $grupos[$id]['horarios'][] =
                    $p['dia'] . ' ' .
                    $p['hora_inicio'] . ' - ' .
                    $p['hora_fin'];
            }
            ?>


            <?php foreach ($grupos as $g) { ?>

                <div class="col-12 col-md-6 col-lg-4 mt-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <!-- Encabezado -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">
                                    <?= $g['nombre_grupo']; ?>
                                </h5>
                                <span class="badge bg-success">
                                    En curso
                                </span>
                            </div>
                            <!-- Profesor -->
                            <div class="mb-3">
                                <h6 class="text-muted mb-1">
                                    Profesor
                                </h6>
                                <p class="mb-0">
                                    <?= $g['nombre'] ?>
                                    <?= $g['apellido_paterno'] ?>
                                    <?= $g['apellido_materno'] ?>
                                </p>
                            </div>
                            <!-- Horarios -->
                            <div>
                                <h6 class="text-muted mb-1">
                                    Horarios
                                </h6>
                                <p class="mb-0">
                                    <?php foreach ($g['horarios'] as $h) { ?>
                                        <span class="badge bg-light text-dark border me-1 mb-1">
                                            <?= $h ?>
                                        </span>
                                    <?php } ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <h4 class="mt-5">Complementarias aprobadas</h4>
            <hr>
        </div>
    </div>

    <br><br><br>
    <!-- PIE DE PÁGINA -->
    <footer class="footer mt-auto">
        <div class="footer-content">
            <h3>Informes</h3>
            <p>Departamento de Educación Continua</p>
            <p>Tel: (55) 5864 3170 Ext. 405</p>
            <p>Horario: 9:00 a 18:00 horas</p>

            <div class="footer-links mt-3">
                <a href="https://tesci.edomex.gob.mx/actividades_complementarias" target="_blank">
                    <i class="fa-solid fa-globe"></i> Página oficial
                </a>
                <a href="https://www.facebook.com/share/1F2RGeKUMw/" target="_blank">
                    <i class="fa-brands fa-facebook"></i> Facebook
                </a>
                <a href="https://www.instagram.com/comunidad.tesci?igsh=ZGtna2drbmMzNGx2" target="_blank">
                    <i class="fa-brands fa-instagram"></i> Instagram
                </a>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 TESCI | Todos los derechos reservados</p>
        </div>
    </footer>
    <!-- JS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>