<?php
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
  <title>Administrar alumnos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/estilos.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
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

  <!--CONTENIDO-->
  <div class="container  justify-content-center mt-5 mb-5">

    <!-- FORMULARIO NUEVO ALUMNO -->
    <div class="text-center ">
      <h2>Crear nuevo alumno</h2>

      <?php
      if (isset($_GET['mensaje'])) {

        if ($_GET['mensaje'] == "duplicado") {
          echo "<div class='alert alert-danger' role='alert'>El número de control ya existe.</div>";
        }

        if ($_GET['mensaje'] == "exito") {
          echo "<div class='alert alert-success' role='alert'>Se ha creado su cuenta exitosamente.</div>";
        }

        if ($_GET['mensaje'] == "desconocido") {
          echo "<div class='alert alert-danger' role='alert'>Ha ocurrido un error inesperado.</div>";
        }

        if ($_GET['mensaje'] == "eliminado") {
          echo "<div class='alert alert-danger' role='alert'>El alumno ha sido eliminado</div>";
        }
      }
      ?>

      <form action="../php/crud-cuentas-alumnos/insertar-alumnos.php" method="post">
        <div class="row">
          <div class="mb-3 text-start col-12 col-md-6  col-lg-4">
            <label for="control" class="form-label fw-bold">No. de control</label>
            <input type="text" class="form-control" id="control" name="no_control"
              placeholder="Ej. 20231234" required pattern="[0-9]{9}" title="Debe contener exactamente 9 dígitos numéricos">
          </div>

          <div class="mb-3 text-start col-12 col-md-6  col-lg-4">
            <label for="nom" class="form-label fw-bold">Nombre</label>
            <input type="text" class="form-control" id="nom" name="n"
              placeholder="" required pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$"
              minlength="3" maxlength="50" title="Solo se permiten letras y espacios">
          </div>

          <div class="mb-3 text-start col-12 col-md-6  col-lg-4">
            <label for="ap1" class="form-label fw-bold">Primer apellido</label>
            <input type="text" class="form-control" id="ap1" name="ap1"
              placeholder="" required pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$"
              minlength="3" maxlength="50" title="Solo se permiten letras y espacios">
          </div>

          <div class="mb-3 text-start col-12 col-md-6  col-lg-4">
            <label for="ap2" class="form-label fw-bold">Segundo apellido</label>
            <input type="text" class="form-control" id="ap2" name="ap2"
              placeholder="" required pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$"
              minlength="3" maxlength="50" title="Solo se permiten letras y espacios">
          </div>

          <div class="mb-3 text-start col-12 col-md-6 col-lg-4">
            <label for="carrera" class="form-label fw-bold">Carrera</label>
            <select name="id_d" id="carrera" class="form-select" required>
              <option value="1">Ingeniería en Sistemas Computacionales</option>
              <option value="2">Ingeniería en Gestión Empresarial</option>
              <option value="3">Ingeniería Química</option>
              <option value="4">Contador Público</option>
              <option value="5">Ingeniería Industrial</option>
              <option value="6">Ingeniería Lógistica </option>
              <option value="7">Ingeniería Mecatrónica</option>
            </select>
          </div>


          <div class="mb-3 text-start col-12 col-md-6  col-lg-4">
            <label for="correo" class="form-label fw-bold">Correo electrónico</label>
            <input type="email" class="form-control" id="correo" name="e"
              placeholder="example@gmail.com" required>
          </div>

          <div class="mb-3 text-start col-12 col-md-6  col-lg-4">
            <label for="password" class="form-label fw-bold">Contraseña</label>
            <input type="password" class="form-control" id="password" name="p"
              placeholder="********" required minlength="6" maxlength="20"
              title="Debe tener entre 6 y 20 caracteres">
          </div>

          <div class="mt-4 text-start col-12 col-md-6  col-lg-4">
            <button type="submit" class="btn btn-custom">Crear cuenta</button>
          </div>
        </div>
      </form><!--fin del formulario-->
    </div>

    <hr>

    <!-- buscar alumno -->

    <h3 class="mt-5">Buscar alumnos</h3>
    <form action="../php/busqueda/buscar-alumno.php" method="POST">
      <div class="row  mb-5">
        <div class="col-6">
          <label for="division" class="form-label fw-bold">Carrera</label>
          <select name="id_d" id="division" class="form-select" required>
            <option value="1">Ingeniería en Sistemas Computacionales</option>
            <option value="2">Ingeniería en Gestión Empresarial</option>
            <option value="3">Ingeniería Química</option>
            <option value="4">Contador Público</option>
            <option value="5">Ingeniería Industrial</option>
            <option value="6">Ingeniería Lógistica </option>
            <option value="7">Ingeniería Mecatrónica</option>
          </select>
        </div>

        <div class="col-4">
          <label for="buscar" class="form-label fw-bold">Número de control</label>
          <input type="text" placeholder="ej. 223107402" class="form-control" id="buscar" name="control">
        </div>

        <div class="col-2 ">
          <input type="submit">
        </div>

      </div>
    </form>


    <!-- TABLA DE ALUMNOS -->
    <div class="table-responsive mb-5 text-center ">

      <?php require("../php/crud-cuentas-alumnos/ver-alumno.php"); ?>

      <table class="table table-bordered ">
        <thead class="table-dark">
          <tr>
            <th>Control</th>
            <th>Nombre</th>
            <th>Carrera</th>
            <th>Correo</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $valores = consultar_tabla_alumnos();
          while ($p = $valores->fetch_assoc()) {
          ?>
            <tr>
              <td><?= $p['numero_control']; ?></td>
              <td><?= $p['nombre']; ?> <?= $p['apellido_paterno']; ?> <?= $p['apellido_materno']; ?></td>
              <td><?= $p['division']; ?></td>
              <td><?= $p['correo']; ?></td>
              <td class=" table-success">
                <div class="d-flex">
                  <button class="btn btn-primary btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#modalEditar"
                    data-control="<?= $p['numero_control']; ?>"
                    data-id-usuario="<?= $p['id_u']; ?>"
                    data-nombre="<?= $p['nombre']; ?>"
                    data-ap1="<?= $p['apellido_paterno']; ?>"
                    data-ap2="<?= $p['apellido_materno']; ?>"
                    data-id-division="<?= $p['id_d']; ?>"
                    data-correo="<?= $p['correo']; ?>"
                    title="Editar">
                    <i class="bi bi-pencil-square"></i>
                  </button>

                  <a href="../php/crud-cuentas-alumnos/eliminar-alumno.php?id=<?= $p['id_u']; ?>"
                    class="btn btn-danger btn-sm" title="Eliminar"><i class="bi bi-trash"></i></a>
                </div>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>


  </div>


  <!-- MODAL EDITAR -->
  <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content p-3">
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="modalEditarLabel">Editar alumno</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <form action="../php/crud-cuentas-alumnos/actualizar-alumno.php" method="POST">
          <div class="modal-body">

            <input type="hidden" name="nc" id="editControl">
            <input type="hidden" name="id-u" id="editUsuario">

            <div class="mb-3">
              <label class="form-label fw-bold">Nombre</label>
              <input type="text" class="form-control" id="editNombre" name="n" required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold">Pirmer apellido</label>
              <input type="text" class="form-control" id="editAp1" name="ap1" required>
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold">Segundo apellido</label>
              <input type="text" class="form-control" id="editAp2" name="ap2" required>
            </div>

            <div class="mb-3">
              <label for="division" class="form-label fw-bold">Carrera</label>
              <select name="id-d" id="editDivision" class="form-select" required>
                <option value="1">Ingeniería en Sistemas Computacionales</option>
                <option value="2">Ingeniería en Gestión Empresarial</option>
                <option value="3">Ingeniería Química</option>
                <option value="4">Contador Público</option>
                <option value="5">Ingeniería Industrial</option>
                <option value="6">Ingeniería Lógistica </option>
                <option value="7">Ingeniería Mecatrónica</option>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold">Correo</label>
              <input type="email" class="form-control" id="editCorreo" name="e" required>
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
            <button type="submit" class="btn btn-custom">Guardar cambios</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <br><br><br><br><br>

  <!-- FOOTER -->
  <footer class="fixed-bottom footer mt-auto ">
    <div class="container text-center">
      <small>Copyright &copy; InovaCode</small>
    </div>
  </footer>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Cuando se abre el modal, rellenamos los campos con los datos del alumno
    const modalEditar = document.getElementById('modalEditar');
    modalEditar.addEventListener('show.bs.modal', event => {
      const button = event.relatedTarget;
      document.getElementById('editUsuario').value = button.getAttribute('data-id-usuario');
      document.getElementById('editControl').value = button.getAttribute('data-control');
      document.getElementById('editNombre').value = button.getAttribute('data-nombre');
      document.getElementById('editAp1').value = button.getAttribute('data-ap1');
      document.getElementById('editAp2').value = button.getAttribute('data-ap2');
      document.getElementById('editDivision').value = button.getAttribute('data-id-division');
      document.getElementById('editCorreo').value = button.getAttribute('data-correo');

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

</body>

</html>