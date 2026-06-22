<?php

require "../conexion.php";

$C = conectar();

if (
    !isset(
        $_POST['n'],
        $_POST['ap1'],
        $_POST['ap2'],
        $_POST['id-profesor'],
        $_POST['id-user'],
        $_POST['u'],
        $_POST['e']
    )
) {

    header("Location:../../administrador/administrar-profesores.php?mensaje=campos");
    exit();
}

$id_u = $_POST['id-user'];
$id_p = $_POST['id-profesor'];

$n = $_POST['n'];
$ap1 = $_POST['ap1'];
$ap2 = $_POST['ap2'];

$u = $_POST['u'];
$e = $_POST['e'];

try {

    // CAMBIAR CONTRASEÑA
    if (isset($_POST['cambiar_pass'])) {

        if (empty($_POST['p'])) {

            header("Location:../../administrador/administrar-profesores.php?mensaje=campos");
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

        // SOLO USUARIO
        $stmt_usuario = $C->prepare("
            UPDATE usuarios 
            SET usuario = ?
            WHERE id_usuario = ?
        ");

        $stmt_usuario->bind_param("si", $u, $id_u);
    }

    $stmt_usuario->execute();

    // TABLA PROFESORES
    $stmt_profesor = $C->prepare("
        UPDATE profesores
        SET nombre = ?,
            apellido_paterno = ?,
            apellido_materno = ?,
            correo = ?
        WHERE id_profesor = ?
    ");

    $stmt_profesor->bind_param(
        "ssssi",
        $n,
        $ap1,
        $ap2,
        $e,
        $id_p
    );

    $stmt_profesor->execute();

    $stmt_usuario->close();
    $stmt_profesor->close();

    $C->close();

    header("Location:../../administrador/administrar-profesores.php?mensaje=editado");
    exit();

} catch (mysqli_sql_exception $e) {

    if ($e->getCode() == 1062) {

        header("Location:../../administrador/administrar-profesores.php?mensaje=duplicado");

    } else {

        header("Location:../../administrador/administrar-profesores.php?mensaje=desconocido");
    }

    exit();
}