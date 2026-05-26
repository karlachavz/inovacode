<?php

require "../conexion.php";
$C = conectar();

$n = $_POST['n'];
$ap1 = $_POST['ap1'];
$ap2 = $_POST['ap2'];
$u = $_POST['u'];
$e = $_POST['e'];
$p = $_POST['p'];

//encriptar la contraseña con hashing password

$ph = password_hash($p,PASSWORD_BCRYPT);


try{

// Iniciar transacción
$C->begin_transaction();

// Insertar en la tabla usuarios
$stmt_usuario = $C->prepare("INSERT INTO usuarios (id_tipo_usuario, usuario, contrasena) VALUES (3, ?, ?)");
$stmt_usuario->bind_param("ss", $u, $ph);
$stmt_usuario->execute();
$id_usuario = $C->insert_id;

//Insertar en la tabla administradores
$stamt_administrador = $C->prepare("INSERT INTO administrador (id_usuario,nombre,apellido_paterno,apellido_materno,correo) VALUES (?, ?, ?,?,?)");
$stamt_administrador->bind_param("issss", $id_usuario, $n, $ap1, $ap2, $e);
$stamt_administrador->execute();

//Confirmar transacción
$C->commit();
$stmt_usuario->close();
$stamt_administrador->close();
$C->close();

header("Location:../../administrador/administrar-administradores.php?mensaje=exito");
exit;

} catch (mysqli_sql_exception $e) {
    $C->rollback();
    
    // Error 1062 = duplicado (usuario ya existe)
    if ($e->getCode() == 1062) {
        header("Location: ../../administrador/administrar-administradores.php?mensaje=duplicado"); 
    } else {
        header("Location: ../../administrador/administrar-administradores.php?mensaje=desconocido"); 
    }
    exit;
}