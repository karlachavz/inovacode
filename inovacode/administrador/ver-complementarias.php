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
</style>

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
            echo "<div class='alert alert-danger'>ID no proporcionado</div>";
            exit;
        }
        //Guardar el id en una variable
        $id = intval($_GET['ID']);
        // conexion.php contiene la conexion a la base de datos
        require "../php/conexion.php";
        $conexion = conectar();

        $sql = "SELECT * FROM complementarias WHERE id_complementaria = $id";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows == 0) {
            echo "<div class='alert alert-warning'>No se encontró la complementaria</div>";
            exit;
        }

        $p = $resultado->fetch_assoc();


        ?>

        <!-- TÍTULO -->
        <h3 class="text-center mb-4"><?= $p['nombre']; ?></h3>

        <hr>

        <!-- FORMULARIO -->
        <form action="" method="post">
            <div class="card">
                <div class="card-body">

                    <input type="hidden" name="id" value="<?= $p['id_complementaria']; ?>">

                    <label class="form-label">Nombre de la complementaria</label>
                    <input type="text" class="form-control mb-3"
                        name="nombre"
                        value="<?= $p['nombre']; ?>"
                        disabled>

                    <label class="form-label">Descripción</label>
                    <input type="text" class="form-control mb-3"
                        name="descripcion"
                        value="<?= $p['descripcion']; ?>"
                        disabled>

                    <label class="form-label">Imagen (link)</label>
                    <input type="text" class="form-control"
                        name="imagen"
                        value="<?= $p['imagen']; ?>"
                        disabled>

                </div>
            </div>
        </form>

        <hr>

        <!-- TABLA DE GRUPOS -->
        <div class="mt-5">
            <h4 class="text-center mb-4">Grupos de la complementaria</h4>


            <div class="">
                <button class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modalNuevoGrupo">
                    <i class="bi bi-plus-square"></i> Agregar nuevo grupo
                </button>
            </div>

            <!--Modal para agregar un grupo nuevo-->
            <div class="modal fade" id="modalNuevoGrupo" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar un nuevo grupo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <!-- FORMULARIO PARA INSERTAR NUEVA COMPLEMENTARIA-->
                        <form action="../php/crud-grupos/insertar-grupo.php" method="post">
                            <div class="modal-body">
                                <input type="text" name="id_complementaria" value="<?= $p['id_complementaria'] ?>" hidden>

                                <label for="" class="form-label">Nombre del grupo</label>
                                <input type="text" class="form-control" name="nombre" required>

                                <label for="" class="form-label mt-2">Profesor</label>
                                <select class="form-select" name="id_profesor">
                                    <option selected value="">Selecciona un profesor</option>
                                    <?php
                                    $sql = "SELECT id_profesor, nombre, apellido_paterno, apellido_materno FROM profesores;";
                                    $resultado = $conexion->query($sql);
                                    while ($p = $resultado->fetch_assoc()) { ?>
                                        <option value="<?= $p['id_profesor'] ?>">
                                            <?= $p['nombre'] ?> <?= $p['apellido_paterno'] ?> <?= $p['apellido_materno'] ?>
                                        </option>
                                    <?php }
                                    ?>

                                </select>


                                <label for="" class="form-label mt-2">Creditos</label>
                                <input type="number" min="1" max="5" class="form-control" name="creditos" required>

                                <label for="" class="form-label mt-2">Cupos disponibles</label>
                                <input type="number" min="1" max="100" class="form-control" name="cupos" required>

                                <label for="" class="form-label mt-2">Día</label>
                                <select class="form-select" name="dia1" required>
                                    <option selected value="">Selecciona un dia de la semana</option>
                                    <option value="1">Lunes</option>
                                    <option value="2">Martes</option>
                                    <option value="3">Miércoles</option>
                                    <option value="4">Jueves</option>
                                    <option value="5">Viernes</option>
                                    <option value="6">Sábado</option>
                                </select>

                                <label for="" class="form-label mt-2">Hora de inicio</label>
                                <select name="hora_inicio1" id="hora_inicio1" class="form-select"
                                    onchange="actualizarHoraFin(1); validarHoras('1')" required>
                                    <option selected value="">hora de inicio</option>
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

                    case "exitoso":
                        $alert_class = "success";
                        $alert_title = "¡Éxito!";
                        $alert_message = "Grupo creado correctamente.";
                        break;

                    case "error":
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
                        $alert_message = "Ha ocurrido un pro    blema    al guardar los datos. Intente nuevamente.";
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

            <table class="table table-bordered mt-3 ">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Profesor</th>
                        <th>Día</th>
                        <th>Horario</th>
                        <th>Cupos</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- Ejemplo estático (luego lo hacemos dinámico) -->
                    <?php require("../php/crud-grupos/ver-grupos.php");
                    <?php
// Llamamos a la función que trae todos los datos
$resultado = consultar_grupos();

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

                    ?>

                    


                    <?php
                    
                    $valores_grupo = consultar_grupos();
                   
                    while ($p = $valore_grupo->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?= $p['nombre_grupo']; ?></td>
                            <td><?= $p['nombre_profesor']; ?> <?= $p['apellido_paterno']; ?> <?= $p['apellido_materno']; ?></td>
                            <td>
                            <?php $valores_horario = consultar_horario($p['id_grupo']);
                            while ($h = $valores_horario->fetch_assoc()){ ?>
                            echo $p['dia'];
                            echo " ";
                            echo $p['hora_inicio'];
                            echo $p['hora_fin'];
                                <hr>
                             } ?> </td>

                            <td><?= $p['creditos'];  ?></td>
                            <td><?= $p['cupos_disponibles'];  ?></td>
                            <td>
                                <button class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-danger btn-sm"> <i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    <?php } ?>


                </tbody>
            </table>
        </div>

    </div>

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