<?php

require "../conexion.php";

// Mostrar errores MYSQLI como excepciones
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Verificar que exista el id
if (!isset($_GET['id'])) {

    header("Location:../../administrador/administrar-alumnos.php?mensaje=desconocido");
    exit();
}

$C = conectar();

$id = $_GET['id'];

try {

    // Prepared Statement para evitar inyección SQL
    $stmt = $C->prepare("
        DELETE FROM usuarios 
        WHERE id_usuario = ?
    ");

    $stmt->bind_param("i", $id);

    $stmt->execute();

    $stmt->close();
    $C->close();

    header("Location:../../administrador/administrar-alumnos.php?mensaje=eliminado");
    exit();

} catch (mysqli_sql_exception $e) {

    $C->close();

    header("Location:../../administrador/administrar-alumnos.php?mensaje=desconocido");
    exit();
}
?>