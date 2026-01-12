<?php

require "../conexion.php";

$CON = conectar();

$id_grupo = $_GET['id_grupo'];
$id_complementaria = $_GET['id_complementaria'];


$sentencia = "DELETE FROM  grupos WHERE id_grupo= $id_grupo";
try {
    $CON->query($sentencia);
    $CON->close();
    header("Location:../../administrador/ver-complementarias.php?ID=$id_complementaria&mensaje=eliminado");
} catch (mysqli_sql_exception $e) {
    error_log("Error al eliminar grupo: " . $e->getMessage());
    header("Location: ../../administrador/ver-complementarias.php?mensaje=error_db&ID=$id_complementaria");
}
