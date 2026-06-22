<?php

require "../conexion.php";

$C = conectar();

$n = $_POST['n'];
$ap1 = $_POST['ap1'];
$ap2 = $_POST['ap2'];
$u = $_POST['u'];
$e = $_POST['e'];
$p = $_POST['p'];

// Encriptar contraseña
$ph = password_hash($p, PASSWORD_BCRYPT);

try {

    // Iniciar transacción
    $C->begin_transaction();

    // Insertar en usuarios
    // id_tipo_usuario = 2 -> Profesor
    $stmt_usuario = $C->prepare("
        INSERT INTO usuarios (id_tipo_usuario, usuario, contrasena) 
        VALUES (2, ?, ?)
    ");

    $stmt_usuario->bind_param("ss", $u, $ph);
    $stmt_usuario->execute();

    $id_usuario = $C->insert_id;

    // Insertar en profesores
    $stmt_profesor = $C->prepare("
        INSERT INTO profesores 
        (id_usuario, nombre, apellido_paterno, apellido_materno, correo) 
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt_profesor->bind_param(
        "issss",
        $id_usuario,
        $n,
        $ap1,
        $ap2,
        $e
    );

    $stmt_profesor->execute();

    // Confirmar transacción
    $C->commit();

    $stmt_usuario->close();
    $stmt_profesor->close();
    $C->close();

    header("Location:../../administrador/administrar-profesores.php?mensaje=exito");
    exit();

} catch (mysqli_sql_exception $e) {

    $C->rollback();

    if ($e->getCode() == 1062) {

        header("Location:../../administrador/administrar-profesores.php?mensaje=duplicado");

    } else {

        header("Location:../../administrador/administrar-profesores.php?mensaje=desconocido");
    }

    exit();
}