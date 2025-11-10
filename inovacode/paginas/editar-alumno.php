<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro Alumno</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {

      height: 100vh;

    }

    

    .card {
      background: #fff;
      border: none;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      width: 350px;
      text-align: center;

    }

    
    .card h2 {
      color: #1d2671;
      font-weight: bold;
      margin-bottom: 1rem;
    }

    .btn-custom {
      background-color: #1d2671;
      color: white;

      transition: 0.3s;
    }

    .btn-custom:hover {
      background-color: #c33764;
      transform: scale(1.05);
    }
  </style>
</head>

<body>
  <!--Nav bar-->
  <nav class="navbar navbar-expand-lg bg-body-tertiary ">
        <div class="container-fluid">


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
                            <li><a class="dropdown-item " href="crear-nuevo-administrador.html">Nuevo administrativo</a>
                            </li>
                            <li><a class="dropdown-item" href="crear-nuevo-alumno.html">Nuevo alumno</a></li>
                            <li><a class="dropdown-item" href="administrar-administradores.php">Administrar administrativos</a>
                            </li>
                            <li><a class="dropdown-item" href="administrar-alumnos.php">Administrar alumnos</a></li>
                        </ul>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Descarga</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Actividades complementarias
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item " href="menu-administrador.html">Editar complementaria</a></li>
                            <li><a class="dropdown-item" href="#">Agregar complementaria</a></li>
                            <li><a class="dropdown-item" href="#">Eliminar complemetaria</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.html">Cerrar sesión</a>
                    </li>
                </ul>

                <a class=" d-flex flex-column p-0 " aria-disabled="true"><img src="../img/perfil.png" alt="Logo" width="30"
                        height="30" class="d-inline-block align-text-end d-none d-md-block">Administrador</a>
            </div>
        </div>
    </nav>


  <div class="container d-flex justify-content-center mt-5">

    <div class="card p-4">
      <h2>Editar alumno</h2>
       <?php
     
     $v=$_GET['ID'];
     //$valores=llenar_campos($v);
     //echo $valores


     require ("../acciones/conexion.php");
     $C =conectar();
     $consulta="select * from alumno where control = ".$v." ";
     
      $res=$C->query($consulta);

     while($p=$res->fetch_assoc()){
    ?>
      <form action="../acciones/actualizar-alumno.php" method="POST">

      <input  name="id" value="<?php echo $p['control'];  ?>" type="text" >
      

        

        <div class="mb-3 text-start">
          <label for="nom" class="form-label fw-bold">Nombre</label>
          <input value="<?php echo $p['nombre'];  ?>" type="text" class="form-control" id="nom" placeholder="Ej. 20231234" name="n" required>
        </div>

        <div class="mb-3 text-start">
          <label for="nom" class="form-label fw-bold">Carrera</label>
          <input value="<?php echo $p['carrera'];  ?>" type="text" class="form-control" id="nom" placeholder="TICS" name="c" required>
        </div>

        <div class="mb-3 text-start">
          <label for="nom" class="form-label fw-bold">Correo</label>
          <input value="<?php echo $p['correo'];  ?>" type="email" class="form-control" id="nom" placeholder="example@gmil.com" name="e" required>
        </div>

        <div class="mb-3 text-start">
          <label for="password" class="form-label fw-bold">Contraseña</label>
          <input value="<?php echo $p['contrasena'];  ?>" type="password" class="form-control" id="password"  name ="p" placeholder="********" required>
        </div>
        <button type="submit" class="btn btn-custom w-100">Guardar cambios</button>
        <div class="mt-3">

        </div>

        <?php } ?> 
      </form>
      
    </div>

  </div>

  <br><br><br><br><br>


  <!--PIE DE PÁGINA-->

  <footer class="fixed-bottom bg-light py-3">
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