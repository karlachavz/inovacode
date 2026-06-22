<?php
session_start(); // ¡Importante! Iniciar la sesión

require "../conexion.php";

$no_control = $_POST['no_control'];
$contrasena = $_POST['contrasena'];

$C = conectar();

try {

    // Buscar usuario - Incluimos id_usuario en la consulta
    $stmt = $C->prepare("
        SELECT usuarios.id_usuario, usuario, contrasena, nombre, apellido_paterno, apellido_materno 
        FROM usuarios 
        INNER JOIN alumnos ON usuarios.id_usuario = alumnos.id_usuario
        WHERE usuario = ? 
        AND id_tipo_usuario = 1
    ");

    $stmt->bind_param("s", $no_control);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si existe usuario
    if ($resultado->num_rows > 0) {

        $usuario = $resultado->fetch_assoc();

        // Verificar contraseña hash
        if (password_verify($contrasena, $usuario['contrasena'])) {

            // Guardar datos en sesión
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['usuario'] = $usuario['usuario'];
            $_SESSION['tipo_usuario'] = 1; // Alumno
            $_SESSION['nombre']=$usuario['nombre'];
            $_SESSION['apellido1']=$usuario['apellido_paterno'];
            $_SESSION['apellido2']=$usuario['apellido_materno'];


           
           

            header("Location:../../alumno/menu-alumno.php");
            exit();
        } else {

            header("Location:../../alumno/login-alumno.php?error=incorrecto");
            exit();
        }
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
