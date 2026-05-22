<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <title>Login Administrador</title>
  <link rel="stylesheet" href="../css/estilos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
  <!--NAVBAR-->
  <nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center">
        <img src="../img/logo.jpeg" alt="Logo" width="50" height="50" class="d-inline-block align-text-top me-2">
        <div class="d-flex flex-column">
          <span class="fw-bold">INNOVACODE</span>
          <small>Actividades complementarias</small>
        </div>
      </a>

      <a class="btn btn-secondary ms-auto me-1" href="../index.html" role="button">Regresar</a>

      <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Menú principal
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="../alumno/login-alumno.php">Alumno</a></li>
          <li><a class="dropdown-item" href="login-administrador.php">Administrador</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!--FORMULARIO LOGIN-->
  <div class="container mt-5 text-center d-flex justify-content-center align-items-center">
    <div class="card mb-3 shadow-lg border-0" style="max-width: 1000px;">
      <div class="row g-0">
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">Administrativo</h5>

            <div class="row mt-5">
              <div class="col">
                <h6>Modo de ingreso</h6>
              </div>
              <div class="col form-check">
                <input class="form-check-input" type="radio" name="modo" id="modoPass" checked>
                <label class="form-check-label" for="modoPass">Contraseña</label>
              </div>
              <div class="col form-check">
                <input class="form-check-input" type="radio" name="modo" id="modoFace">
                <label class="form-check-label" for="modoFace">Reconocimiento facial</label>
              </div>

              <?php
              if (isset($_GET['error'])) {
                if ($_GET['error'] == "incorrecto") {
                  echo "<div class='alert alert-danger mt-3' role='alert'>Usuario o contraseña incorrecta</div>";
                }
              }
              ?>
            </div>

            <!-- Formulario para contraseña -->
            <form id="formPass" action="../php/login/validar-login-administrador.php" method="post" class="mt-3 text-center">
              <label for="usuario" class="form-label mt-1">Usuario</label>
              <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingresa tu usuario" required>

              <label for="contrasena" class="form-label mt-2">Contraseña</label>
              <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Ingresa tu contraseña" required>

              <div class="text-center mt-2">
                <input type="submit" class="btn btn-primary" value="Iniciar sesión">
              </div>
            </form>

            <!-- Reconocimiento facial -->
            <div id="facialLogin" class="mt-4" style="display:none;">
              <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Asegúrate de tener buena iluminación y mirar directamente a la cámara.
              </div>
              <video id="video" width="320" height="240" autoplay class="border rounded"></video>
              <canvas id="canvas" style="display:none;"></canvas>
              <div class="mt-3">
                <button class="btn btn-success" onclick="loginFacial()">
                  <i class="fas fa-user-check"></i> Iniciar con rostro
                </button>
                <div id="loading" class="mt-2" style="display:none;">
                  <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Procesando...</span>
                  </div>
                  <p class="mt-2">Analizando rostro...</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 d-none d-md-block">
          <img src="../img/imgadmin.jpg" class="img-fluid rounded-start" alt="..." style="height: 100%; object-fit: cover;">
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="footer mt-auto py-4 bg-light">
    <div class="container text-center">
      <h3>Informes</h3>
      <p>Departamento de Educación Continua</p>
      <p>Tel: (55) 5864 3170 Ext. 405</p>
      <p>Horario: 9:00 a 18:00 horas</p>

      <div class="footer-links mt-3">
        <a href="https://tesci.edomex.gob.mx/actividades_complementarias" target="_blank" class="btn btn-outline-secondary btn-sm mx-1">
          <i class="fa-solid fa-globe"></i> Página oficial
        </a>
        <a href="https://www.facebook.com/share/1F2RGeKUMw/" target="_blank" class="btn btn-outline-primary btn-sm mx-1">
          <i class="fa-brands fa-facebook"></i> Facebook
        </a>
        <a href="https://www.instagram.com/comunidad.tesci?igsh=ZGtna2drbmMzNGx2" target="_blank" class="btn btn-outline-danger btn-sm mx-1">
          <i class="fa-brands fa-instagram"></i> Instagram
        </a>
      </div>

      <div class="footer-bottom mt-4">
        <p class="text-muted">&copy; 2025 TESCI | Todos los derechos reservados</p>
      </div>
    </div>
  </footer>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>

  <!-- FaceAPI.js -->
  <script src="https://cdn.jsdelivr.net/npm/@vladmandic/face-api@1.7.14/dist/face-api.min.js"></script>

  <script>
    // Variables globales
    let faceDescriptor = null;
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const formPass = document.getElementById('formPass');
    const facialDiv = document.getElementById('facialLogin');
    const modoPass = document.getElementById('modoPass');
    const modoFace = document.getElementById('modoFace');
    const loading = document.getElementById('loading');

    // Cambiar entre modos de login
    modoPass.addEventListener('change', () => {
      formPass.style.display = 'block';
      facialDiv.style.display = 'none';
      detenerCamara();
    });

    modoFace.addEventListener('change', () => {
      formPass.style.display = 'none';
      facialDiv.style.display = 'block';
      iniciarCamara();
    });

    // Iniciar cámara

    async function iniciarCamara() {
      try {
        console.log('Cargando modelos de FaceAPI...');

        // Cargar modelos con rutas correctas
        const modelPath = '../models';
        await faceapi.nets.ssdMobilenetv1.loadFromUri(modelPath);
        await faceapi.nets.faceLandmark68Net.loadFromUri(modelPath);
        await faceapi.nets.faceRecognitionNet.loadFromUri(modelPath);

        console.log('Modelos cargados, accediendo a cámara...');

        // Verificar si getUserMedia está disponible
        if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
          throw new Error('getUserMedia no está soportado en este navegador');
        }

        // Intentar con diferentes configuraciones de cámara
        const constraints = {
          video: {
            width: {
              ideal: 640
            },
            height: {
              ideal: 480
            },
            facingMode: 'user', // Usar cámara frontal
            frameRate: {
              ideal: 30
            }
          },
          audio: false
        };

        const stream = await navigator.mediaDevices.getUserMedia(constraints);

        if (!stream) {
          throw new Error('No se obtuvo stream de la cámara');
        }

        video.srcObject = stream;

        // Esperar a que el video esté listo
        return new Promise((resolve) => {
          video.onloadedmetadata = () => {
            video.play();
            console.log('Cámara iniciada correctamente');
            resolve(true);
          };

          video.onerror = (error) => {
            console.error('Error en elemento video:', error);
            resolve(false);
          };
        });

      } catch (error) {
        console.error('Error detallado al acceder a la cámara:', error);

        // Mensajes de error más específicos
        let mensajeError = 'No se pudo acceder a la cámara. ';

        if (error.name === 'NotAllowedError' || error.name === 'PermissionDeniedError') {
          mensajeError += 'Permiso denegado. Por favor, permite el acceso a la cámara en la configuración de tu navegador.';
        } else if (error.name === 'NotFoundError' || error.name === 'DevicesNotFoundError') {
          mensajeError += 'No se encontró ninguna cámara disponible.';
        } else if (error.name === 'NotSupportedError') {
          mensajeError += 'Tu navegador no soporta acceso a la cámara.';
        } else if (error.name === 'NotReadableError' || error.name === 'TrackStartError') {
          mensajeError += 'La cámara está siendo usada por otra aplicación.';
        } else {
          mensajeError += `Error: ${error.message}`;
        }

        alert(mensajeError);
        return false;
      }
    }

    // Detener cámara
    function detenerCamara() {
      if (video.srcObject) {
        const stream = video.srcObject;
        const tracks = stream.getTracks();
        tracks.forEach(track => track.stop());
        video.srcObject = null;
      }
    }

    // Login facial
    async function loginFacial() {
      try {
        loading.style.display = 'block';

        // Detectar rostro
        const detection = await faceapi
          .detectSingleFace(video)
          .withFaceLandmarks()
          .withFaceDescriptor();

        if (!detection) {
          alert("No se detectó ningún rostro. Por favor, colócate frente a la cámara.");
          loading.style.display = 'none';
          return;
        }

        // Obtener descriptor
        const descriptor = Array.from(detection.descriptor);

        // Enviar al servidor
        const response = await fetch('../php/login/login-facial-admin.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            descriptor: descriptor
          })
        });

        const data = await response.json();
        loading.style.display = 'none';

        if (data.acceso) {
          alert('¡Acceso concedido!');
          window.location.href = 'menu-administrador.php';
        } else {
          alert('Rostro no reconocido. Por favor, intenta nuevamente.');
        }

      } catch (error) {
        console.error('Error en login facial:', error);
        loading.style.display = 'none';
        alert('Error al procesar el rostro. Por favor, intenta nuevamente.');
      }
    }

    // Inicializar
    document.addEventListener('DOMContentLoaded', () => {
      // Si está seleccionado el modo facial al cargar
      if (modoFace.checked) {
        formPass.style.display = 'none';
        facialDiv.style.display = 'block';
        iniciarCamara();
      }
    });





    // Función para mostrar errores de cámara
    function mostrarErrorCamara(mensaje) {
      const errorDiv = document.getElementById('cameraError');
      const errorMsg = document.getElementById('errorMessage');
      const cameraContainer = document.getElementById('cameraContainer');

      errorMsg.textContent = mensaje;
      errorDiv.style.display = 'block';
      cameraContainer.style.display = 'none';

      // Detener cámara si está activa
      detenerCamara();
    }

    // Función para ocultar errores
    function ocultarErrorCamara() {
      const errorDiv = document.getElementById('cameraError');
      const cameraContainer = document.getElementById('cameraContainer');

      errorDiv.style.display = 'none';
      cameraContainer.style.display = 'block';
    }

    // Función para reintentar
    async function reintentarCamara() {
      ocultarErrorCamara();
      const iniciado = await iniciarCamara();

      if (!iniciado) {
        mostrarErrorCamara('No se pudo reiniciar la cámara. Verifica los permisos.');
      }
    }

    // Función mejorada para detener cámara
    function detenerCamara() {
      if (video.srcObject) {
        const tracks = video.srcObject.getTracks();
        tracks.forEach(track => {
          track.stop();
          console.log('Track detenido:', track.kind);
        });
        video.srcObject = null;
        console.log('Cámara detenida');
      }
    }









    // Detener cámara al salir de la página
    window.addEventListener('beforeunload', detenerCamara);
  </script>
</body>

</html>