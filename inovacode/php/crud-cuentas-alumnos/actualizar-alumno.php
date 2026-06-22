<?php

require "../conexion.php";

$C = conectar();

if (
    !isset(
        $_POST['nc'],
        $_POST['n'],
        $_POST['ap1'],
        $_POST['ap2'],
        $_POST['id-d'],
        $_POST['id-u'],
        $_POST['e']
    )
) {

    header("Location:../../administrador/administrar-alumnos.php?mensaje=campos");
    exit();
}

$id_u = $_POST['id-u'];

$nc = $_POST['nc'];
$n = $_POST['n'];
$ap1 = $_POST['ap1'];
$ap2 = $_POST['ap2'];
$d = $_POST['id-d'];
$e = $_POST['e'];



try {

    // SI QUIERE CAMBIAR CONTRASEÑA
    if (isset($_POST['cambiar_pass'])) {

        if (empty($_POST['p'])) {

            header("Location:../../administrador/administrar-alumnos.php?mensaje=campos");
            exit();
        }

        $p = $_POST['p'];

        $ph = password_hash($p, PASSWORD_BCRYPT);
//$ph=$p;

        $stmt_usuario = $C->prepare("
            UPDATE usuarios
            SET usuario = ?, contrasena = ?
            WHERE id_usuario = ?
        ");

        $stmt_usuario->bind_param("ssi", $nc, $ph, $id_u);

    } else {

        // SOLO ACTUALIZA USUARIO
        $stmt_usuario = $C->prepare("
            UPDATE usuarios
            SET usuario = ?
            WHERE id_usuario = ?
        ");

        $stmt_usuario->bind_param("si", $nc, $id_u);
    }

    $stmt_usuario->execute();

    // ACTUALIZAR ALUMNO
    $stmt_alumno = $C->prepare("
        UPDATE alumnos
        SET numero_control = ?,
            nombre = ?,
            apellido_paterno = ?,
            apellido_materno = ?,
            id_division = ?,
            correo = ?
        WHERE id_usuario = ?
    ");

    $stmt_alumno->bind_param(
        "isssisi",
        $nc,
        $n,
        $ap1,
        $ap2,
        $d,
        $e,
        $id_u
    );

    $stmt_alumno->execute();

    $stmt_usuario->close();
    $stmt_alumno->close();

    $C->close();

   header ("Location:../../administrador/administrar-alumnos.php?mensaje=editado");
    exit();

} catch (mysqli_sql_exception $e) {

    $C->close();

    
    if ($e->getCode() == 1062) {

        header("Location:../../administrador/administrar-alumnos.php?mensaje=duplicado");

    } else {

        header("Location:../../administrador/administrar-alumnos.php?mensaje=desconocido");
    }

    exit();
}
?>