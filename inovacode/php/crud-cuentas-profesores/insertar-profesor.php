<?php

require "../conexion.php";
$CON =conectar();


$user=$_POST['u'];
$nom=$_POST['n'];
$ap1=$_POST['ap1'];
$ap2=$_POST['ap2'];
$correo=$_POST['e'];
$pass=$_POST['p'];

$consulta = "INSERT INTO profesores (nombre, apellido_paterno, apellido_materno,usuario,correo, contrasena) 
VALUES ( '$nom', '$ap1', '$ap2', '$user', '$correo', '$pass')";


try {
    $CON->query($consulta);
    $CON->close();
    header("Location: ../../administrador/administrar-profesores.php?mensaje=exitoso");
    exit;
} 
catch (mysqli_sql_exception $e) {

    // Si el error es de duplicado (código 1062)
    if ($e->getCode() == 1062) {
        header("Location: ../../administrador/administrar-profesores.php?mensaje=duplicado");
    } else {
        header("Location: ../../administrador/administrar-profesores.php?mensaje=desconocido");
    }

    exit;
}

