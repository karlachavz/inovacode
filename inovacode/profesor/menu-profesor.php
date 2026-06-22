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

<style>
    .grupo-card {
        transition: .25s ease;
        border-radius: 15px;
        overflow: hidden;
    }


    .grupo-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, .15) !important;
    }


    .card-header {
        padding: 15px;
    }
</style>

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
                        <a class="nav-link active" aria-current="page" href="#">Mis grupos</a>
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

    <!-- tagetas de Actividades Complementarias-->





    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">
                    <i class="bi bi-people-fill text-primary"></i> Mis grupos
                </h3>
                <p class="text-muted mb-0">
                    Consulta tus grupos asignados y sus alumnos.
                </p>
            </div>
        </div>


        <div class="row g-4">

            <?php
            $valores = obtener_grupos($id_usuario);


            if ($valores->num_rows == 0) {

                echo '
            <div class="col-12">
                <div class="card border-0 shadow-sm text-center py-5">
                    <div class="card-body">
                        <i class="bi bi-calendar-x text-secondary fs-1"></i>
                        <h5 class="mt-3 fw-bold">
                            No tienes grupos asignados
                        </h5>
                        <p class="text-muted">
                            No hay grupos disponibles para este periodo.
                        </p>
                    </div>
                </div>
            </div>';
            }


            $grupos = [];


            while ($p = $valores->fetch_assoc()) {

                $id_grupo = $p['id_grupo'];

                if (!isset($grupos[$id_grupo])) {

                    $grupos[$id_grupo] = [
                        'id_grupo' => $p['id_grupo'],
                        'nombre' => $p['nombre'],
                        'horarios' => []
                    ];
                }


                $grupos[$id_grupo]['horarios'][] =
                    $p['dia'] . ' ' .
                    $p['hora_inicio'] . ' - ' .
                    $p['hora_fin'];
            }



            foreach ($grupos as $g) {
            ?>


                <div class="col-12 col-md-6 col-lg-4">

                    <div class="card h-100 border-0 shadow-sm grupo-card">

                        <div class="card-header bg-primary text-white">

                            <h5 class="mb-0 fw-bold">
                                <i class="bi bi-book"></i>
                                <?= $g['nombre']; ?>
                            </h5>

                        </div>


                        <div class="card-body">


                            <div class="mb-3">

                                <small class="text-muted d-block mb-2">
                                    <i class="bi bi-clock"></i>
                                    Horario
                                </small>


                                <?php foreach ($g['horarios'] as $h) { ?>

                                    <span class="badge rounded-pill bg-light text-dark border mb-2">
                                        <?= $h ?>
                                    </span>

                                <?php } ?>

                            </div>


                            <div class="d-grid">

                                <a
                                    href="lista-alumnos.php?id_grupo=<?= $g['id_grupo']; ?>"
                                    class="btn btn-outline-primary">

                                    <i class="bi bi-person-lines-fill"></i>
                                    Ver alumnos

                                </a>

                            </div>


                        </div>
                    </div>

                </div>


            <?php } ?>

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