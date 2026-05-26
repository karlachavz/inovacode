<?php

require "../conexion.php";

$C = conectar();

if (
    !isset(
        $_POST['n'],
        $_POST['ap1'],
        $_POST['ap2'],
        $_POST['id-admin'],
        $_POST['id-user'],
        $_POST['u'],
        $_POST['e']
    )
) {
    header("Location:../../administrador/administrar-administradores.php?mensaje=campos");
    exit();
}

$id_u = $_POST['id-user'];
$id_a = $_POST['id-admin'];

$n = $_POST['n'];
$ap1 = $_POST['ap1'];
$ap2 = $_POST['ap2'];

$u = $_POST['u'];
$e = $_POST['e'];



try {

    // SI QUIERE CAMBIAR CONTRASEÑA
    if (isset($_POST['cambiar_pass'])) {

        if (empty($_POST['p'])) {
            header("Location:../../administrador/administrar-administradores.php?mensaje=campos");
            exit();
        }

        $p = $_POST['p'];
        $ph = password_hash($p, PASSWORD_BCRYPT);

        $stmt_usuario = $C->prepare("
            UPDATE usuarios 
            SET usuario = ?, contrasena = ?
            WHERE id_usuario = ?
        ");

        $stmt_usuario->bind_param("ssi", $u, $ph, $id_u);

    } else {

        // SOLO ACTUALIZA USUARIO
        $stmt_usuario = $C->prepare("
            UPDATE usuarios 
            SET usuario = ?
            WHERE id_usuario = ?
        ");

        $stmt_usuario->bind_param("si", $u, $id_u);
    }

    $stmt_usuario->execute();

    // TABLA ADMINISTRADOR
    $stmt_admin = $C->prepare("
        UPDATE administrador 
        SET nombre = ?, 
            apellido_paterno = ?, 
            apellido_materno = ?, 
            correo = ?
        WHERE id_administrador = ?
    ");

    $stmt_admin->bind_param(
        "ssssi",
        $n,
        $ap1,
        $ap2,
        $e,
        $id_a
    );

    $stmt_admin->execute();

    $stmt_usuario->close();
    $stmt_admin->close();
    $C->close();

    header("Location:../../administrador/administrar-administradores.php?mensaje=editado");
    exit();

} catch (mysqli_sql_exception $e) {

    if ($e->getCode() == 1062) {

        header("Location:../../administrador/administrar-administradores.php?mensaje=duplicado");

    } else {

        header("Location:../../administrador/administrar-administradores.php?mensaje=desconocido");
    }

    exit();
}