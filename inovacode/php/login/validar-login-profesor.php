<?php
require "../conexion.php";

if (!isset($_POST['usuario'], $_POST['contrasena'])) {
    header("Location:../../profesor/login.php?error=campos");
    exit();
}

$C = conectar();

try {
    // Aunque sea para texto plano, usar prepared statement
    $stmt = $C->prepare("SELECT * FROM usuarios WHERE usuario = ? AND contrasena = ? AND id_tipo_usuario = 2");
    $stmt->bind_param("ss", $_POST['usuario'], $_POST['contrasena']);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows > 0) {
        session_start();
        $_SESSION['usuario'] = $_POST['usuario'];
        $stmt->close();
        $C->close();
        header("Location:../../profesor/menu-profesor.php");
        exit();
    }
    
    $stmt->close();
    $C->close();
    header("Location:../../profesor/login.php?error=incorrecto");
    exit();
    
} catch (mysqli_sql_exception $e) {
    $C->close();
    header("Location:../../profesor/login.php?error=bd");
    exit();
}
?>


