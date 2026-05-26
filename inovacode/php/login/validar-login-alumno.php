<?php 
/*
require "../conexion.php";

$no_control=$_POST['no_control'];
$contrasena=$_POST['contrasena'];

    //objeto conexion
    $C=conectar();
    $consulta ="SELECT * FROM usuarios WHERE usuario =".$no_control." AND contrasena ='".$contrasena."' AND id_tipo_usuario = 1";
    //el resultado se crea como un arreglo
    $resultado = $C ->query($consulta);
    
    
    
        if ($resultado->num_rows > 0) {
        // Usuario válido → redirige a la página principal
        header("Location:../../alumno/menu-alumno.php");
        exit(); // Importante para detener el script después de redirigir
    } else {
        // Usuario o contraseña incorrectos → redirige al index
        header("Location:../../alumno/login-alumno.php?error=incorrecto");
        exit();
    }

    // Cerrar conexión
    $stmt->close();
    $C->close();
*/

require "../conexion.php";

$no_control = $_POST['no_control'];
$contrasena = $_POST['contrasena'];

$C = conectar();

try {
    // Usar prepared statement
    $stmt = $C->prepare("SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ? AND id_tipo_usuario = 1");
    $stmt->bind_param("ss", $no_control, $contrasena);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows > 0) {
        header("Location:../../alumno/menu-alumno.php");
        exit();
    } else {
        header("Location:../../alumno/login-alumno.php?error=incorrecto");
        exit();
    }
    
    $stmt->close();
    $C->close();
    
} catch (mysqli_sql_exception $e) {
    $C->close();
    header("Location:../../alumno/login-alumno.php?error=bd");
    exit();
}
?>

