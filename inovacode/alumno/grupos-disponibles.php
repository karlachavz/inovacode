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
                        <a class="nav-link active" aria-current="page" href="#">Actividades</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Historial de avance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.html">Cerrar sesión</a>
                    </li>
                </ul>

                <a class=" d-flex flex-column p-0 " aria-disabled="true">
                    <img src="../img/perfil.png" alt="Logo" width="30" height="30"
                        class="d-inline-block align-text-end d-none d-md-block">Alumno</a>
            </div>
        </div>
    </nav>

    <!--CONTENIDO-->

    <div class="container mt-5">
        <h2 class="text-center mb-4 fw-bold">Actividades Complementarias</h2>

        <?php
        if (!isset($_GET['ID'])) {
            //si no se encuentra el id la url de la página lanza la siguente alerta
            echo "<div class='alert alert-danger'>ID no proporcionado</div> <a href='menu-alumno.php' class='btn btn-custom'><i class='bi bi-arrow-left-circle'></i> Regresar</a>";
            exit;
        }
        $id_complementaria = $_GET['ID'];
        $nombre_complementaria = $_GET['nombre'];
        ?>
        <div class="text-center mt-0">
            <h4>Grupos disponibles <?php echo $nombre_complementaria; ?></h4>
        </div>



        <a href="menu-alumno.php" class="btn btn-custom"><i class="bi bi-arrow-left-circle"></i> Regresar</a>
        <hr>

        <div>
            <?php
            require "../php/conexion.php";
            require("../php/crud-grupos/ver-grupos.php");
            // Llamamos a la función que trae todos los datos
            $resultado = consultar_grupos($id_complementaria);
            // Arreglo donde vamos a agrupar los datos por grupo
            $grupos = [];
            // Recorremos cada fila devuelta por la BD
            while ($fila = $resultado->fetch_assoc()) {

                // Guardamos el id del grupo actual
                $id = $fila['id_grupo'];

                // Si el grupo NO existe aún en el arreglo, lo creamos
                if (!isset($grupos[$id])) {

                    $grupos[$id] = [
                        // Datos del grupo
                        'id_grupo' => $fila['id_grupo'],
                        'nombre_grupo' => $fila['nombre_grupo'],

                        // Concatenamos el nombre completo del profesor
                        'profesor' => $fila['nombre_profesor'] . ' ' .
                            $fila['apellido_paterno'] . ' ' .
                            $fila['apellido_materno'],

                        'cupos' => $fila['cupos_disponibles'],
                        'creditos' => $fila['creditos'],

                        // Aquí guardaremos TODOS los horarios del grupo
                        'horarios' => []
                    ];
                }

                // Agregamos el horario actual al grupo correspondiente
                $grupos[$id]['horarios'][] =
                    $fila['dia'] . ' ' .
                    $fila['hora_inicio'] . ' - ' .
                    $fila['hora_fin'];
            }
            ?>

            <!-- TABLA DE GRUPOS -->

            <table class="table table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Profesor</th>
                        <th>Día / Horario</th>
                        <th>Créditos</th>
                        <th>Cupos</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($grupos as $g) { ?>
                        <tr>
                            <!-- Nombre del grupo -->
                            <td><?= $g['nombre_grupo']; ?></td>

                            <!-- Profesor -->
                            <td><?= $g['profesor']; ?></td>

                            <!-- Horarios -->
                            <td>
                                <?php foreach ($g['horarios'] as $h) { ?>
                                    <?= $h ?><br>
                                <?php } ?>
                            </td>

                            <!-- Créditos -->
                            <td><?= $g['creditos']; ?></td>

                            <!-- Cupos -->
                            <td><?= $g['cupos']; ?></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
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