<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=note_stack_add" />
    <title>Detalle de Complementaria</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<style>
    #campos-ocultos {
        display: none;
    }


    .acciones {
        display: flex;
        justify-content: space-between;
    }
</style>

<script>
    document.getElementById('modalEditarGrupo').addEventListener('show.bs.modal', function(event) {

        const button = event.relatedTarget;

        document.getElementById('edit_id_grupo').value = button.getAttribute('data-id');
        document.getElementById('edit_nombre').value = button.getAttribute('data-nombre');
        document.getElementById('edit_creditos').value = button.getAttribute('data-creditos');
        document.getElementById('edit_cupos').value = button.getAttribute('data-cupos');

    });
</script>


<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">

            <a class="navbar-brand d-flex align-items-center">
                <img src="../img/logo.jpeg" width="50" height="50" class="me-2">
                <div class="d-flex flex-column">
                    <span class="fw-bold">INNOVACODE</span>
                    <small>Actividades complementarias</small>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Usuarios</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="administrar-administradores.php">Administradores</a></li>
                            <li><a class="dropdown-item" href="administrar-alumnos.php">Alumnos</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="menu-administrador.php">Complementarias</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../index.html">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- CONTENIDO -->
    <div class="container mt-5">


        <?php
        // Validar ID en caso de entrar a la página sin ID

        if (!isset($_GET['ID'])) {
            //si no se encuentra el id la url de la página lanza la siguente alerta
            echo "<div class='alert alert-danger'>ID no proporcionado</div>";
            exit;
        }


        // si esta guardar el id en una variable
        $id = intval($_GET['ID']);
        // conexion.php contiene la conexion a la base de datos
        require "../php/conexion.php";
        $conexion = conectar();
        //consulta para obtener nobre y id de la complementaria 
        $sql = "SELECT nombre, id_complementaria FROM complementarias WHERE id_complementaria = $id";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows == 0) {
            echo "<div class='alert alert-warning'>No se encontró la complementaria</div>";
            exit;
        }

        $p = $resultado->fetch_assoc();




        ?>



        <div class="">
            <h4 class="text-center mb-4">Grupos de <?= $p['nombre']; ?></h4>


            <div class="acciones">
                <button class="btn btn-custom" data-bs-toggle="modal"
                    data-bs-target="#modalNuevoGrupo">
                    <i class="bi bi-plus-square"></i> Agregar nuevo grupo
                </button>


                <div>
                    <label for="periodo filtro">Período</label>
                    <select name="periodio_filtro" id="periodo_filtro">
                        <?php
                        $sql = "SELECT * FROM periodo ORDER BY id_periodo  DESC";

                        $resultado = $conexion->query($sql);

                        while ($periodo = $resultado->fetch_assoc()) { ?>

                            <option value="<?= $periodo['id_periodo'] ?>">
                                <?= $periodo['periodo'] ?>
                            </option>

                        <?php } ?>
                    </select>
                </div>

            </div>

            <hr>

            <!--Modal para insertar grupo nuevo-->
            <div class="modal fade" id="modalNuevoGrupo" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar un nuevo grupo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- FORMULARIO PARA INSERTAR un nuevo grupo -->
                        <form action="../php/crud-grupos/insertar-grupo.php" method="post">
                            <div class="modal-body">

                                <input type="text" name="id_complementaria" value="<?= $p['id_complementaria'] ?>" hidden>

                                <label for="">Perído</label>
                                <select name="id_periodo" id="id_periodo" class="form-select">
                                    <?php
                                    $sql = "SELECT * FROM periodo ORDER BY id_periodo  DESC";

                                    $resultado = $conexion->query($sql);

                                    while ($periodo = $resultado->fetch_assoc()) { ?>

                                        <option value="<?= $periodo['id_periodo'] ?>">
                                            <?= $periodo['periodo'] ?>
                                        </option>

                                    <?php } ?>
                                </select>

                                <label for="" class="form-label mt-2">Nombre del grupo</label>
                                <input type="text" class="form-control" name="nombre" placeholder="Ejemplo: <?= $p['nombre'] ?>  1" required>

                                <label for="" class="form-label mt-2">Profesor</label>
                                <select class="form-select" name="id_profesor">
                                    <option selected value="">Selecciona un profesor</option>
                                    <?php
                                    $sql = "SELECT id_profesor, nombre, apellido_paterno, apellido_materno FROM profesores;";
                                    $resultado = $conexion->query($sql);

                                    while ($profesor = $resultado->fetch_assoc()) { ?>

                                        <option value="<?= $profesor['id_profesor'] ?>">
                                            <?= $profesor['nombre'] ?>
                                            <?= $profesor['apellido_paterno'] ?>
                                            <?= $profesor['apellido_materno'] ?>
                                        </option>

                                    <?php } ?>
                                </select>

                                <label for="" class="form-label mt-2">Creditos</label>
                                <select class="form-select" name="creditos" required>
                                    <option value="1" selected>1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>

                                <label for="" class="form-label mt-2">Cupos disponibles</label>
                                <input type="number" min="1" max="100" class="form-control" name="cupos" required>

                                <label for="" class="form-label mt-2 ">Día</label>
                                <select class="form-select" name="id_dia1" required>
                                    <option selected value="">Selecciona un dia de la semana</option>
                                    <option value="1">Lunes</option>
                                    <option value="2">Martes</option>
                                    <option value="3">Miércoles</option>
                                    <option value="4">Jueves</option>
                                    <option value="5">Viernes</option>
                                    <option value="6">Sábado</option>
                                </select>

                                <label for="" class="form-label mt-2 ">Hora de inicio</label>
                                <select name="hora_inicio1" id="hora_inicio1" class="form-select"
                                    onchange="actualizarHoraFin(1); validarHoras('1')" required>

                                    <option value="07:00">7:00 am</option>
                                    <option value="08:00">8:00 am</option>
                                    <option value="09:00">9:00 am</option>
                                    <option value="10:00">10:00 am</option>
                                    <option value="11:00">11:00 am</option>
                                    <option value="12:00">12:00 pm</option>
                                    <option value="13:00">1:00 pm</option>
                                    <option value="14:00">2:00 pm</option>
                                    <option value="15:00">3:00 pm</option>
                                    <option value="16:00">4:00 pm</option>
                                    <option value="17:00">5:00 pm</option>
                                    <option value="18:00">6:00 pm</option>
                                    <option value="19:00">7:00 pm</option>
                                    <option value="20:00">8:00 pm</option>
                                    <option value="21:00">9:00 pm</option>
                                </select>

                                <label for="" class="form-label mt-2 ">Hora de termino</label>
                                <select name="hora_fin1" id="hora_fin1" class="form-select"
                                    onchange="validarHoras('1')" required>
                                    <option value="08:00">8:00 am</option>
                                    <option value="09:00">9:00 am</option>
                                    <option value="10:00">10:00 am</option>
                                    <option value="11:00">11:00 am</option>
                                    <option value="12:00">12:00 pm</option>
                                    <option value="13:00">1:00 pm</option>
                                    <option value="14:00">2:00 pm</option>
                                    <option value="15:00">3:00 pm</option>
                                    <option value="16:00">4:00 pm</option>
                                    <option value="17:00">5:00 pm</option>
                                    <option value="18:00">6:00 pm</option>
                                    <option value="19:00">7:00 pm</option>
                                    <option value="20:00">8:00 pm</option>
                                    <option value="21:00">9:00 pm</option>
                                    <option value="22:00">10:00 pm</option>
                                </select>

                                <br>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="tiene_segundo_dia"
                                        name="tiene_segundo_dia" value="1" onchange="mostrarCampos()">
                                    <label class="form-check-label" for="tiene_segundo_dia">
                                        Agregar otro dia extra
                                    </label>
                                </div>

                                <div id="campos-ocultos" style="display:none;">
                                    <hr>
                                    <label for="" class="form-label mt-2">Día</label>
                                    <select class="form-select" name="dia2">
                                        <option selected value="">Selecciona un dia de la semana</option>
                                        <option value="1">Lunes</option>
                                        <option value="2">Martes</option>
                                        <option value="3">Miércoles</option>
                                        <option value="4">Jueves</option>
                                        <option value="5">Viernes</option>
                                        <option value="6">Sábado</option>
                                    </select>

                                    <label for="" class="form-label mt-2">Hora de inicio</label>
                                    <select id="hora_inicio2" name="hora_inicio2" class="form-select"
                                        onchange="actualizarHoraFin('2'); validarHoras('2')">
                                        <option value="">Selecciona hora</option>
                                        <option value="07:00">7:00 am</option>
                                        <option value="08:00">8:00 am</option>
                                        <option value="09:00">9:00 am</option>
                                        <option value="10:00">10:00 am</option>
                                        <option value="11:00">11:00 am</option>
                                        <option value="12:00">12:00 pm</option>
                                        <option value="13:00">1:00 pm</option>
                                        <option value="14:00">2:00 pm</option>
                                        <option value="15:00">3:00 pm</option>
                                        <option value="16:00">4:00 pm</option>
                                        <option value="17:00">5:00 pm</option>
                                        <option value="18:00">6:00 pm</option>
                                        <option value="19:00">7:00 pm</option>
                                        <option value="20:00">8:00 pm</option>
                                        <option value="21:00">9:00 pm</option>
                                    </select>

                                    <label for="" class="form-label mt-2">Hora de termino</label>
                                    <select name="hora_fin2" id="hora_fin2" class="form-select"
                                        onchange="validarHoras('2')">
                                        <option value="">Selecciona hora</option>
                                        <option value="08:00">8:00 am</option>
                                        <option value="09:00">9:00 am</option>
                                        <option value="10:00">10:00 am</option>
                                        <option value="11:00">11:00 am</option>
                                        <option value="12:00">12:00 pm</option>
                                        <option value="13:00">1:00 pm</option>
                                        <option value="14:00">2:00 pm</option>
                                        <option value="15:00">3:00 pm</option>
                                        <option value="16:00">4:00 pm</option>
                                        <option value="17:00">5:00 pm</option>
                                        <option value="18:00">6:00 pm</option>
                                        <option value="19:00">7:00 pm</option>
                                        <option value="20:00">8:00 pm</option>
                                        <option value="21:00">9:00 pm</option>
                                        <option value="22:00">10:00 pm</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <input type="submit" value="Crear nuevo grupo" class="btn btn-secondary mt-2">
                            </div>
                        </form>

                        <script>
                            function mostrarCampos() {
                                var checkbox = document.getElementById('tiene_segundo_dia');
                                var campos = document.getElementById('campos-ocultos');
                                if (checkbox.checked) {
                                    campos.style.display = 'block';
                                    // Hacer requeridos los campos del segundo día
                                    campos.querySelector('[name="dia2"]').required = true;
                                    campos.querySelector('[name="hora_inicio2"]').required = true;
                                    campos.querySelector('[name="hora_fin2"]').required = true;
                                } else {
                                    campos.style.display = 'none';
                                    // Quitar requerido si no se marca
                                    campos.querySelector('[name="dia2"]').required = false;
                                    campos.querySelector('[name="hora_inicio2"]').required = false;
                                    campos.querySelector('[name="hora_fin2"]').required = false;
                                }
                            }
                        </script>
                    </div>
                </div>
            </div><!--fin de la targeta modal-->


            <!--Mensajes de alerta -->
            <?php
            if (isset($_GET['mensaje'])) {
                $alert_class = "";
                $alert_title = "";
                $alert_message = "";
                $dismissible = true;

                switch ($_GET['mensaje']) {
                    case "duplicado":
                        $alert_class = "danger";
                        $alert_title = "Error";
                        $alert_message = "Ya existe un grupo con ese nombre. Por favor, use un nombre diferente.";
                        break;

                    case "eliminado":

                        $alert_class = "success";
                        $alert_title = "¡Éxito!";
                        $alert_message = "Grupo eliminado exitosamente";
                        break;

                    case "exitoso":
                        $alert_class = "success";
                        $alert_title = "¡Éxito!";
                        $alert_message = "Grupo creado correctamente.";
                        break;

                    case "error_campos":
                        $alert_class = "danger";
                        $alert_title = "Error";
                        $alert_message = "Faltan campos obligatorios. Por favor, complete todos los campos requeridos.";
                        break;

                    case "error_horas":
                        $alert_class = "warning";
                        $alert_title = "Validación de horario";
                        $alert_message = "La hora de inicio debe ser anterior a la hora de término para el primer día.";
                        break;

                    case "error_horas2":
                        $alert_class = "warning";
                        $alert_title = "Validación de horario";
                        $alert_message = "La hora de inicio debe ser anterior a la hora de término para el segundo día.";
                        break;

                    case "error_db":
                        $alert_class = "danger";
                        $alert_title = "Error del sistema";
                        $alert_message = "Ha ocurrido un problema al guardar los datos. Intente nuevamente.";
                        break;

                    case "desconocido":
                        $alert_class = "danger";
                        $alert_title = "Error inesperado";
                        $alert_message = "Ha ocurrido un error inesperado. Por favor, contacte al administrador.";
                        break;

                    default:
                        $alert_class = "info";
                        $alert_title = "Información";
                        $alert_message = "Estado del proceso: " . htmlspecialchars($_GET['mensaje']);
                        break;
                }

                if ($dismissible) {
                    echo "<div class='alert alert-{$alert_class} alert-dismissible fade show' role='alert'>
                <strong>{$alert_title}:</strong> {$alert_message}
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
                } else {
                    echo "<div class='alert alert-{$alert_class}' role='alert'>
                <strong>{$alert_title}:</strong> {$alert_message}
              </div>";
                }
            }
            ?>

            <?php
            require("../php/crud-grupos/ver-grupos.php");
            // Llamamos a la función que trae todos los datos

            $resultado = consultar_grupos($_GET['ID']);

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
                        <th>Acciones</th>
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

                            <!-- Botones -->
                            <td>
                                <button
                                    class="btn btn-success btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEditarGrupo"

                                    data-id="<?= $id ?>"
                                    data-nombre="<?= $g['nombre_grupo'] ?>"
                                    data-profesor="<?= $g['profesor'] ?>"
                                    data-creditos="<?= $g['creditos'] ?>"
                                    data-cupos="<?= $g['cupos'] ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <a href="../php/crud-grupos/eliminar-grupo.php?id_complementaria=<?php echo $_GET['ID']; ?>&id_grupo=<?= $g['id_grupo'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>


    <!--MODAL CON FORMULARIO EDITAR COMPLEMENTARIA-->
    <div class="modal fade" id="modalEditarGrupo" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="../php/crud-grupos/editar-grupo.php" method="post">

                    <div class="modal-header">
                        <h5 class="modal-title">Editar grupo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <!-- ID del grupo -->
                        <input type="hidden" name="id_grupo" id="edit_id_grupo">

                        <label class="form-label">Nombre del grupo</label>
                        <input type="text" class="form-control" name="nombre" id="edit_nombre" required>

                        <label class="form-label mt-2">Profesor</label>
                        <select class="form-select" name="id_profesor" id="edit_profesor" required>
                            <?php
                            $sql = "SELECT id_profesor, nombre, apellido_paterno, apellido_materno FROM profesores";
                            $res = $conexion->query($sql);
                            while ($prof = $res->fetch_assoc()) {
                                echo "<option value='{$prof['id_profesor']}'>
                                {$prof['nombre']} {$prof['apellido_paterno']} {$prof['apellido_materno']}
                            </option>";
                            }
                            ?>
                        </select>

                        <label class="form-label mt-2">Créditos</label>
                        <select class="form-select" name="creditos" id="edit_creditos">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>

                        <label class="form-label mt-2">Cupos</label>
                        <input type="number" class="form-control" name="cupos" id="edit_cupos" min="1" max="100" required>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <br><br>
    <br><br><br><br><br>
    <!-- FOOTER -->
    <footer class="bg-light py-3 mt-5">
        <div class="container text-center">
            <small>&copy; InovaCode</small>
        </div>
    </footer>

    <script>
        function mostrarCampos() {
            const contenedor = document.getElementById("campos-ocultos");

            const check = document.getElementById("tiene_segundo_dia");

            if (check.checked === false) {
                contenedor.style.display = "none";
            }
            if (check.checked) {
                contenedor.style.display = "block";
            }
        }
    </script>

    <script>
        function actualizarHoraFin(numeroDia) {
            const inicioSelect = document.getElementById("hora_inicio" + numeroDia);
            const finSelect = document.getElementById("hora_fin" + numeroDia);

            // Obtener el valor seleccionado
            const inicio = inicioSelect.value;

            // Si no hay valor seleccionado, salir
            if (!inicio || inicio === "") {
                return;
            }

            // Convertir la hora a número y sumar 1 hora
            const [horaStr, minutoStr] = inicio.split(":");
            let hora = parseInt(horaStr);

            // Sumar 1 hora
            hora += 1;

            // Formatear a 2 dígitos
            const horaFin = hora.toString().padStart(2, '0');
            const nuevaHoraFin = horaFin + ":" + minutoStr;

            // Buscar y seleccionar la opción correspondiente en hora_fin
            for (let i = 0; i < finSelect.options.length; i++) {
                if (finSelect.options[i].value === nuevaHoraFin) {
                    finSelect.selectedIndex = i;
                    break;
                }
            }
        }

        function mostrarCampos() {
            const contenedor = document.getElementById("campos-ocultos");
            const check = document.getElementById("tiene_segundo_dia");

            contenedor.style.display = check.checked ? "block" : "none";
        }

        // Inicializar campos ocultos como ocultos al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById("campos-ocultos").style.display = "none";
        });
    </script>

    <script>
        function validarHoras(numeroDia) {
            const inicio = document.getElementById("hora_inicio" + numeroDia);
            const fin = document.getElementById("hora_fin" + numeroDia);

            if (!inicio.value || !fin.value) return;

            const inicioMin = convertirAMinutos(inicio.value);
            const finMin = convertirAMinutos(fin.value);

            if (finMin <= inicioMin) {
                alert("La hora de término debe ser mayor a la hora de inicio");
                fin.value = "";
            }
        }

        function convertirAMinutos(hora) {
            const [h, m] = hora.split(":").map(Number);
            return h * 60 + m;
        }
    </script>




    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>