<?php
require "../conexion.php";

session_start();

if (!isset($_POST['usuario'], $_POST['contrasena'])) {
    header("Location:../../profesor/login.php?error=campos");
    exit();
}

$usuario = trim($_POST['usuario']);
$contrasena = $_POST['contrasena'];

$C = conectar();

try {

    // Buscar usuario
    $stmt = $C->prepare("
        SELECT * 
        FROM usuarios 
        WHERE usuario = ? 
        AND id_tipo_usuario = 2
    ");

    $stmt->bind_param("s", $usuario);

    $stmt->execute();

    $resultado = $stmt->get_result();

    // Verificar si existe
    if ($resultado->num_rows > 0) {

        $fila = $resultado->fetch_assoc();

        // Verificar contraseña encriptada
        if (password_verify($contrasena, $fila['contrasena'])) {

            // Crear sesión
            $_SESSION['profesor_usuario'] = $fila['usuario'];
            $_SESSION['admin_tipo'] = 3;
            $_SESSION['id_usuario_profesor'] = $fila['id_usuario'];

            header("Location:../../profesor/menu-profesor.php");
            exit();

        } else {

            // Contraseña incorrecta
            header("Location:../../profesor/login.php?error=incorrecto");
            exit();
        }

    } else {

        // Usuario no existe
        header("Location:../../profesor/login.php?error=incorrecto");
        exit();
    }

    $stmt->close();
    $C->close();

} catch (mysqli_sql_exception $e) {

    $C->close();

    header("Location:../../administrador/login.php?error=bd");
    exit();
}