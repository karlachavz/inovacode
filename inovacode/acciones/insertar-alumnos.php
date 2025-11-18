<?php

require "conexion.php";
$CON =conectar();

$control=$_POST['no_control'];
$nom=$_POST['n'];
$ap1=$_POST['ap1'];
$ap2=$_POST['ap2'];
$carrera=$_POST['c'];
$correo=$_POST['e'];
$pass=$_POST['p'];

$consulta = "INSERT INTO alumno (control, nombre, apellido_paterno, apellido_materno, carrera, correo, contrasena) 
VALUES ($control, '$nom', '$ap1', '$ap2', '$carrera', '$correo', '$pass')";

try {
    $CON->query($consulta);
    $CON->close();
    header("Location: ../paginas/administrar-alumnos.php?mensaje=exitoso");
    exit;
} 
catch (mysqli_sql_exception $e) {

    // Si el error es de duplicado (código 1062)
    if ($e->getCode() == 1062) {
        header("Location: ../paginas/administrar-alumnos.php?mensaje=duplicado");
    } else {
        header("Location: ../paginas/administrar-alumnos.php?mensaje=desconocido");
    }

    exit;
}

?>