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
                            <li><a class="dropdown-item" href="administrar-administradores.php">Administrar cuentas
                                    administrativas</a></li>
                            <li><a class="dropdown-item" href="administrar-alumnos.php">Administrar cuentas de
                                    alumnos</a></li>
                        </ul>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Descarga</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="menu-administrador.php">Actividades
                            complementarias</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../index.html">Cerrar sesión</a>
                    </li>
                </ul>

                <a class=" d-flex flex-column p-0 " aria-disabled="true"><img src="../img/perfil.png" alt="Logo"
                        width="30" height="30" class="d-inline-block align-text-end d-none d-md-block">Administrador</a>
            </div>
        </div>
    </nav>

    <!-- tagetas de Actividades Complementarias-->


    


    <div class="container mt-5">

        <div class="text-center">
            <h3 class="">Actividades complementarias</h3>
            <?php
            if (isset($_GET['mensaje'])) {

                if ($_GET['mensaje'] == "duplicado") {
                    echo "<div class='alert alert-danger' role='alert'>Ya existe una complementaria con ese nombre.</div>";
                }

                if ($_GET['mensaje'] == "exitoso") {
                    echo "<div class='alert alert-success' role='alert'>Nueva complementaria creada exitosamente.</div>";
                }

                if ($_GET['mensaje'] == "desconocido") {
                   echo "<div class='alert alert-danger' role='alert'>Ha ocurrido un error inesperado al reg.</div>";
                }

                if ($_GET['mensaje'] == "eliminado") {
                   echo "<div class='alert alert-info' role='alert'>Actividad complementaria eliminada</div>";
                }
            }
          ?>
        </div>


        <div class="row p-0">


            <!--Tarjeta de agragar nueva complementaria href="nueva-complementaria.html"-->
            <div class=" col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
                <div class="card">
                    <img src="../img/agregar.png" class="card-img-top" alt="..." style="height: 250px;">
                    <div class="card-body d-flex flex-row">
                        <a class="btn btn-secondary  ms-auto" role="button" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">NUEVA
                            COMPLEMENTARIA</a>
                    </div>
                </div>
            </div>


            <!--Modal con formulario para agregar nueva complementaria-->

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar nueva complementaria</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="../php/crud-actividades-complementarias/insertar-complemetaria.php" method="post">
                            <div class="modal-body">

                                <label for="" class="form-label">Nombre de la complementaria</label>
                                <input type="text" class="form-control" name="nombre"
                                    pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" minlength="3" maxlength="200"
                                    title="Solo se permiten letras y espacios" required>

                                <label for="" class="form-label mt-2" minlength="3" maxlength="500">Descripcion
                                    de la
                                    complementaria</label>
                                <input type="text" class="form-control" name="descripcion" required>

                                <label for="" class="form-label mt-2">Imagen de la complementaria (link) </label>
                                <input type="text" name="img" class="form-control " minlength="3" maxlength="500">
                                <div id="imghelp" class="form-text ">Ingresa el link a la imagen que quieres mostrar.
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <input type="submit" value="Agregar complementaria" class="btn btn-secondary mt-2">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!---Cards de las complementarias-->
            <?php require("../php/crud-actividades-complementarias/ver-complementarias.php"); ?>

            <?php 
            $valores = consultar();
            while($p = $valores->fetch_assoc()){ 
            ?>
            

            <div class=" col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
                <div class="card">
                    <img src="<?= $p['imagen']; ?>" class="card-img-top" alt="..." style="height:250px" >

                    <div class="card-body d-flex flex-row flex-wrap justify-content-center">
                        <p class="card-text "><?= $p['nombre']; ?></p>
                        <a class="btn btn-info ms-auto" title="ver" href="ver-complementarias.php?ID=<?php echo $p['id_complementaria']; ?>" role="button"><i class="bi bi-eye"></i></a>
                        <a 
                            class="btn btn-success ms-auto editarBtn" 
                            title="editar" role="button" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modaleditarcomplementaria"
                            data-id="<?php echo $p['id_complementaria']; ?>"
                            data-nombre="<?php echo $p['nombre']; ?>"
                            data-descripcion="<?php echo $p['descripcion']; ?>"
                            data-imagen="<?php echo $p['imagen']; ?>"
                            ><i class="bi bi-pencil"></i>
                        </a>
                        
                        <a class="btn btn-danger ms-auto" title="eliminar" href="../php/crud-actividades-complementarias/eliminar-complementaria.php?ID=<?php echo $p['id_complementaria']; ?>" role="button"><i class="bi bi-trash"></i></a>
                    </div>
                </div>
            </div>


            <?php } ?>


            <!--Modal con formulario de editar complementaria--->

            <div class="modal fade" id="modaleditarcomplementaria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Editar complementaria</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="../php/crud-actividades-complementarias/actualizar-complementaria.php" method="post">
                            <div class="modal-body">

                                <input type="hidden" name="id" id="edit-id">

                                <label for="" class="form-label">Nombre de la complementaria</label>
                                <input type="text" class="form-control" name="nombre" id="edit-nombre"
                                    pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" minlength="3" maxlength="200"
                                    title="Solo se permiten letras y espacios" required>

                                <label for="" class="form-label mt-2" minlength="3" maxlength="500">Descripcion
                                    de la
                                    complementaria</label>
                                <input type="text" class="form-control" name="descripcion"  id="edit-descripcion" required>

                                <label for="" class="form-label mt-2">Imagen de la complementaria (link) </label>
                                <input type="text" name="imagen" class="form-control " minlength="3" maxlength="500" id="edit-imagen">
                                <div id="imghelp" class="form-text ">Ingresa el link a la imagen que quieres mostrar.
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <input type="submit" value="Guardar cambios" class="btn btn-secondary mt-2">
                            </div>
                        </form>
                
                    </div>
                </div>
            </div>

            <!--fin de modal editar complementaria-->


            <!-- SCRIPT PARA LLENAR EL MODAL -->

            <script>
            document.addEventListener("DOMContentLoaded", function () {
                const editarBtns = document.querySelectorAll(".editarBtn");

                editarBtns.forEach(btn => {
                    btn.addEventListener("click", function () {
                        // Tomar datos del botón
                        const id = this.getAttribute("data-id");
                        const nombre = this.getAttribute("data-nombre");
                        const descripcion = this.getAttribute("data-descripcion");
                        const imagen = this.getAttribute("data-imagen");

                        // Cargar datos al modal
                        document.getElementById("edit-id").value = id;
                        document.getElementById("edit-nombre").value = nombre;
                        document.getElementById("edit-descripcion").value = descripcion;
                        document.getElementById("edit-imagen").value = imagen;
                    });
                });
            });
            </script>



            

           

        </div>

        <!--Aqui van a ir las cards con las actividades complementarias-->

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