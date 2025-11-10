<?php 

require "conexion.php";

$no_control=$_POST['no_control'];
$contrasena=$_POST['contrasena'];








    //objeto conexion
    $C=conectar();
    $consulta ="SELECT * FROM alumno WHERE Control =".$no_control." AND contrasena ='".$contrasena."'";
    //el resultado se crea como un arreglo
    $resultado = $C ->query($consulta);
    
    
    
        if ($resultado->num_rows > 0) {
        // Usuario válido → redirige a la página principal
        header("Location:../paginas/menu-alumno.html");
        exit(); // Importante para detener el script después de redirigir
    } else {
        // Usuario o contraseña incorrectos → redirige al index
        header("Location:../paginas/login-alumno.html");
        exit();
    }

    // Cerrar conexión
    $stmt->close();
    $C->close();


?>
