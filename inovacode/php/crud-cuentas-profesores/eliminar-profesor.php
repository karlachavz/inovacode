<?php

require "../conexion.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (!isset($_GET['id_u'])) {

    header("Location:../../administrador/administrar-profesores.php?mensaje=denegado");
    exit();
}

$C = conectar();

$id_usuario = $_GET['id_u'];
$id_profesor = $_GET['id_p'];

//try {


   $stmt_grupo = $C->prepare("UPDATE GRUPOS SET id_profesor= null where id_profesor = ?");
   $stmt_grupo->bind_param("i",$id_profesor);
   $stmt_grupo->execute();
   $stmt_grupo->close();

    $stmt = $C->prepare("
        DELETE FROM usuarios 
        WHERE id_usuario = ?
    ");

    $stmt->bind_param("i", $id_usuario);

    $stmt->execute();

    $stmt->close();
    $C->close();

    //header("Location:../../administrador/administrar-profesores.php?mensaje=eliminado");
    //exit();

/*} catch (mysqli_sql_exception $e) {

    $C->close();

    header("Location:../../administrador/administrar-profesores.php?mensaje=error");
    exit();
}*/