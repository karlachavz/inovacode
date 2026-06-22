<?php
require "../conexion.php";
$C = conectar();

$control = $_POST['no_control'];
$nom = $_POST['n'];
$ap1 = $_POST['ap1'];
$ap2 = $_POST['ap2'];
$id_division = $_POST['id_d'];
$correo = $_POST['e'];
$pass = $_POST['p'];
//encriptar el password
$ph = password_hash($pass, PASSWORD_BCRYPT);

try {
    
    // 2. Iniciar transacción
    $C->begin_transaction();
    
    // 3. Insertar en tabla usuarios (autenticación)
    $stmt_usuario = $C->prepare("INSERT INTO usuarios (id_tipo_usuario, usuario, contrasena) VALUES (1, ?, ?)");
    $stmt_usuario->bind_param("ss", $control, $ph);
    $stmt_usuario->execute();
    $id_usuario = $C->insert_id;
    
    // 4. Insertar en tabla alumnos
    $stmt_alumno = $C->prepare("INSERT INTO alumnos (numero_control, nombre, apellido_paterno, apellido_materno, id_division, correo, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt_alumno->bind_param("isssisi", $control, $nom, $ap1, $ap2, $id_division, $correo, $id_usuario);
    $stmt_alumno->execute();
    
    // 5. Confirmar transacción
    $C->commit();
    $stmt_usuario->close();
    $stmt_alumno->close();
    $C->close();
    
    header("Location: ../../alumno/crear-cuenta-nueva-alumno.php?mensaje=exito");
    exit;
    
} catch (mysqli_sql_exception $e) {
    $C->rollback();
    
    // Error 1062 = duplicado (número de control ya existe)
    if ($e->getCode() == 1062) {
        header("Location: ../../alumno/crear-cuenta-nueva-alumno.php?error=duplicado");
   } else {
       header("Location: ../../alumno/crear-cuenta-nueva-alumno.php?error=desconocido");
    }
   exit;
}
