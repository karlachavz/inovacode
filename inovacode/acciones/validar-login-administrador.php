<?php 

require "conexion.php";

$usuario=$_POST['usuario'];
$contrasena=$_POST['contrasena'];








    //objeto conexion
    $C=conectar();
    $consulta ="SELECT * FROM administrador WHERE usuario ='".$usuario."' AND contrasena ='".$contrasena."'";
    //el resultado se crea como un arreglo
    $resultado = $C ->query($consulta);
    
    
    
        if ($resultado->num_rows > 0) {
        // Usuario válido → redirige a la página principal
        header("Location:../paginas/menu-administrador.html");
        exit(); // Importante para detener el script después de redirigir
    } else {
        // Usuario o contraseña incorrectos → redirige al index
        header("Location:../paginas/login-administrador.html");
        exit();
    }

    // Cerrar conexión
    $stmt->close();
    $C->close();


?>