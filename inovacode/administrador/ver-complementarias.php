<?php

//Verificar que el usuario haya iniciado session para acceder a la página
session_start();

// Verificar que el usuario haya iniciado sesión
if (!isset($_SESSION['admin_usuario'])) {
    header("Location: ../alumno/login-alumno.php");
    exit();
}

// Obtener el ID de usuario de la sesión
$id_usuario =  $_SESSION['id_usuario'];
$usuario = $_SESSION['admin_usuario'];
?>

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

    .filtro-periodo {
        width: 15rem;
    }

    .filtro-periodo div {
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin-right: 5px;
    }
</style>

<body>

    <!-- NAVBAR -->
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
                            <li><a class="dropdown-item" href="administrar-administradores.php">Cuentas
                                    administrativas</a></li>
                            <li><a class="dropdown-item" href="administrar-alumnos.php">Cuentas de
                                    alumnos</a></li>
                            <li><a class="dropdown-item" href="administrar-profesores.php">Cuentas de
                                    profesores</a></li>
                        </ul>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Estadisticas</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="menu-administrador.php">Actividades
                            complementarias</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../php/login/cerrar-sesion.php">Cerrar sesión</a>
                    </li>
                </ul>

                <a class=" d-flex flex-column p-0 " aria-disabled="true"><img src="../img/perfil.png" alt="Logo"
                        width="30" height="30" class="d-inline-block align-text-end d-none d-md-block"><?php echo $usuario; ?></a>
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
        //ruta a archivo con peticiones php que requiere esta página 
        require "../php/peticiones/peticiones-ver-complementarias.php";

        //llarmar la funcion para consultar el nombre de la actividd complementaria
        $complementarias = obtener_complementaria($id);

        if ($complementarias->num_rows == 0) {
            echo "<div class='alert alert-warning'>No se encontró la complementaria</div>";
            exit;
        }
        $p = $complementarias->fetch_assoc();
        ?>


        <!--Seccion con Btn agregar nuevo grupo y filtro por periodo-->
        <div class="">
            <h4 class="text-center mb-4">Grupos de <?= $p['nombre']; ?></h4>


            <div class="acciones">
                <button class="btn btn-custom" data-bs-toggle="modal"
                    data-bs-target="#modalNuevoGrupo">
                    <i class="bi bi-plus-square"></i> Agregar nuevo grupo
                </button>

                <div class="filtro-periodo d-flex ">
                    <div>
                        <label for="periodo_filtro">Período</label>
                    </div>

                    <select name="periodo_filtro" id="periodo_filtro"
                        class="form-select"
                        onchange="recargar_tabla(this.value, <?php echo $id ?>)"

                        <?php
                        //si esta periodo en url añadir el dato del periodo a el select
                        if (isset($_GET['periodo'])) {
                        ?>
                        data-periodo-seleccionado="<?php echo $_GET['periodo'] ?>">
                    <?php } else {
                    ?>
                        data-periodo-seleccionado="0">
                    <?php } ?>
                    <option value="0" id="option_periodo0">Todos</option>
                    <?php
                    // llamamos a la funcion para obtener periodos
                    $periodos = obtener_periodos();

                    while ($periodo = $periodos->fetch_assoc()) { ?>

                        <option value="<?= $periodo['id_periodo'] ?>"
                            id="option_periodo<?= $periodo['id_periodo'] ?>">
                            <?= $periodo['periodo'] ?>
                        </option>
                    <?php } ?>
                    </select>
                    <script>
                        const selectPeriodo = document.getElementById('periodo_filtro');

                        const periodo_seleccionado = selectPeriodo.getAttribute('data-periodo-seleccionado');

                        if (periodo_seleccionado) {
                            const opcion = document.getElementById('option_periodo' + periodo_seleccionado);

                            if (opcion) {
                                opcion.selected = true;
                            }
                        }
                    </script>
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
                                    // llamar a funcion para obtener periodos y guardarlos en variable $periodos
                                    $periodos = obtener_periodos();

                                    while ($periodo = $periodos->fetch_assoc()) { ?>

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

                                    $profesores = obtener_profesores();
                                    while ($profesor = $profesores->fetch_assoc()) { ?>

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

            // si esta periodo en el url mostrar solo los registros de ese periodo
            if (isset($_GET['periodo'])) {
                $resultado = consultar_grupos_con_periodo($id, $_GET['periodo']);
                // sino mostrar todos los resultrados  
            } else {
                $resultado = consultar_grupos($_GET['ID']);
            }



            // Arreglo donde vamos a agrupar los datos por grupo
            $grupos = [];

            // Recorremos cada fila devuelta por la BD
            while ($fila = $resultado->fetch_assoc()) {

                // Guardamos el id del grupo actual
                $id_grupo = $fila['id_grupo'];



                // Si el grupo NO existe aún en el arreglo, lo creamos
                if (!isset($grupos[$id])) {

                    $grupos[$id_grupo] = [
                        // Datos del grupo
                        'id_grupo' => $fila['id_grupo'],
                        'nombre_grupo' => $fila['nombre_grupo'],


                        'id_profesor' => $fila['id_profesor'],
                        // Concatenamos el nombre completo del profesor
                        'profesor' => $fila['nombre_profesor'] . ' ' .
                            $fila['apellido_paterno'] . ' ' .
                            $fila['apellido_materno'],


                        'cupos' => $fila['cupos_disponibles'],
                        'creditos' => $fila['creditos'],
                        'id_periodo' => $fila['id_periodo'],
                        'periodo' => $fila['periodo'],



                        // Aquí guardaremos TODOS los horarios del grupo
                        'horarios' => []
                    ];
                }

                // Agregamos el horario actual al grupo correspondiente
                $grupos[$id_grupo]['horarios'][] =

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
                        <th>Período</th>
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

                            <!-- Cupos -->
                            <td><?= $g['periodo']; ?></td>

                            <!-- Botones de editar y eliminar -->
                            <td>
                                <!--botón para editar complementaria-->
                                <button
                                    class="btn btn-success btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEditarGrupo"
                                    

                                    data-id-grupo="<?= $g['id_grupo'] ?>"
                                    
                                    data-nombre="<?= $g['nombre_grupo'] ?>"
                                    data-profesor="<?= $g['id_profesor'] ?>"
                                    data-creditos="<?= $g['creditos'] ?>"
                                    data-cupos="<?= $g['cupos']  ?>"
                                    data-periodo="<?= $g['id_periodo'] ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <!--botón para eliminar complementaria-->
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
                        <input type="text" name="id_grupo" id="edit_id_grupo">

                        <!--ID complementaria-->
                        <input type="text" name="id_complementaria" id="edit_id_complementaria" value="<?php echo $id ?>">

                        <label for="edit_periodo">Perído</label>
                        <select name="edit_periodo" class="form-select" id="edit_periodo">
                            <?php
                            //llama a funcion para obtener periodos de la base de datos
                            $periodos = obtener_periodos();

                            while ($periodo = $periodos->fetch_assoc()) { ?>

                                <option value="<?= $periodo['id_periodo'] ?>">
                                    <?= $periodo['periodo'] ?>
                                </option>

                            <?php } ?>
                        </select>

                        <label class="form-label" for="edit_nombre">Nombre del grupo</label>
                        <input type="text" class="form-control" name="edit_nombre" id="edit_nombre" required>

                        <label for="edit_profesor" class="form-label mt-2">Profesor</label>
                        <select class="form-select" name="edit_profesor" id="edit_profesor">
                            <option selected value="">Selecciona un profesor</option>
                            <?php

                            $profesores = obtener_profesores();
                            while ($profesor = $profesores->fetch_assoc()) { ?>

                                <option value="<?= $profesor['id_profesor'] ?>">
                                    <?= $profesor['nombre'] ?>
                                    <?= $profesor['apellido_paterno'] ?>
                                    <?= $profesor['apellido_materno'] ?>
                                </option>
                            <?php } ?>
                        </select>

                        <label class="form-label mt-2" for="edit_creditos">Créditos</label>
                        <select class="form-select" name="edit_creditos" id="edit_creditos">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>

                        <label class="form-label mt-2" for="edit_cupos">Cupos</label>
                        <input type="number" class="form-control" name="edit_cupos" id="edit_cupos" min="1" max="100" required>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>

                </form>

            </div>
        </div>
        <script>
            document
                .getElementById("modalEditarGrupo")
                .addEventListener("show.bs.modal", function(event) {

                    const button = event.relatedTarget;

                    document.getElementById("edit_id_grupo").value =
                        button.getAttribute("data-id-grupo");
                    
                    

                    document.getElementById("edit_nombre").value =
                        button.getAttribute("data-nombre");

                    document.getElementById("edit_profesor").value =
                        button.getAttribute("data-profesor");

                    document.getElementById("edit_creditos").value =
                        button.getAttribute("data-creditos");

                    document.getElementById("edit_cupos").value =
                        button.getAttribute("data-cupos");

                    document.getElementById("edit_periodo").value =
                        button.getAttribute("data-periodo");
                });
        </script>
    </div>

    <br><br>
    <br><br><br><br><br>
    <!-- FOOTER -->
    <footer class="bg-light py-3 mt-5">
        <div class="container text-center">
            <small>&copy; InovaCode</small>
        </div>
    </footer>

    <script src="../js/administrador/peticiones/ver-complementarias.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>