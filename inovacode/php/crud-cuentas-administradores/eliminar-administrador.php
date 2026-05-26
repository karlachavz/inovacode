<?php

require "../conexion.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (!isset($_GET['id'])) {
    header("Location:../../administrador/administrar-administradores.php?mensaje=denegado");
    exit();
}

$C = conectar();

$id = $_GET['id'];

try {

    $stmt = $C->prepare("DELETE FROM usuarios WHERE id_usuario = ?");

    $stmt->bind_param("i", $id);

    $stmt->execute();

    $stmt->close();
    $C->close();

    header("Location:../../administrador/administrar-administradores.php?mensaje=eliminado");
    exit();

} catch (mysqli_sql_exception $e) {

    $C->close();

    header("Location:../../administrador/administrar-administradores.php?mensaje=error");
    exit();
}