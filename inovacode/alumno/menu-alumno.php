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
$nombre =$_SESSION['nombre'];
$apellido1=$_SESSION['apellido1'];
$apellido2=$_SESSION['apellido2'];
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
            <a class="nav-link active" aria-current="page" href="#">Actividades</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="historial-avance.php">Historial de avance</a>
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



  <!-- CARROUSEL -->

  <div class="container mt-5 mb-5">
    <h2 class="text-center mb-4 fw-bold">Actividades Complementarias</h2>
    <?php require("../php/crud-actividades-complementarias/ver-complementarias.php"); ?>


    <div id="carouselActividades" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">



        <?php
        $valores = consultar();
        $contador = 0;
        $slideAbierto = false;

        while ($p = $valores->fetch_assoc()) {

          // Abrir un nuevo slide cada 3 cards
          if ($contador % 3 == 0) {

            // Cerrar slide anterior si existe
            if ($slideAbierto) {
              echo '</div></div>';
            }

            // Primer slide = active
            $active = ($contador == 0) ? 'active' : '';

            echo '
        <div class="carousel-item ' . $active . '">
            <div class="row justify-content-center">
        ';

            $slideAbierto = true;
          }
        ?>
          <!-- CARD -->
          <div class="col-md-4">
            <div class="card shadow-sm">
              <img src="<?= $p['imagen']; ?>" class="card-img-top" alt="Complementaria" style="height: 300px;">
              <div class="card-body text-center">
                <h5 class="card-title"><?= $p['nombre']; ?></h5><br>
                <button class="btn btn-primary"
                  data-bs-toggle="modal"
                  data-bs-target="#modal<?= $p['id_complementaria']; ?>">
                  Ver más
                </button>
              </div>
            </div>
          </div>

          <!-- MODAL -->
          <div class="modal fade" id="modal<?= $p['id_complementaria']; ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title"><?= $p['nombre']; ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                  <img src="<?= $p['imagen']; ?>" class="img-fluid rounded mb-3">
                  <p><?= $p['descripcion']; ?></p>


                </div>
                <div class="modal-footer">
                  <p><strong>CUPOS DISPONIBLES:</strong></p>
                  <a href="grupos-disponibles.php?ID=<?= $p['id_complementaria']; ?>&nombre=<?= $p['nombre']; ?>" class="btn btn-custom">Ver grupos disponibles</a>
                </div>
              </div>
            </div>
          </div>

        <?php
          $contador++;
        }

        // Cerrar último slide
        if ($slideAbierto) {
          echo '</div></div>';
        }
        ?>

      </div>

      <!-- CONTROLES -->
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselActividades" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselActividades" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
      </button>
    </div>
  </div>



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