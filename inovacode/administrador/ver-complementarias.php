<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <title>Detalle de Complementaria</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

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
// Validar ID
if (!isset($_GET['ID'])) {
    echo "<div class='alert alert-danger'>ID no proporcionado</div>";
    exit;
}

$id = intval($_GET['ID']);

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
<form action="../php/crud-actividades-complementarias/actualizar-complementaria.php" method="post">
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

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Profesor</th>
                <th>Día</th>
                <th>Horario</th>
                <th>Cupos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

            <!-- Ejemplo estático (luego lo hacemos dinámico) -->
            <tr>
                <td>Grupo 1</td>
                <td>José Juan Santa Ana</td>
                <td>Viernes</td>
                <td>6:00 PM</td>
                <td>30</td>
                <td>
                    <button class="btn btn-success btn-sm">Editar</button>
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </td>
            </tr>

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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
