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

$consulta= "insert into alumno (control, nombre, apellido_paterno, apellido_materno, carrera, correo, contrasena) values ("
.$control.",'".$nom."','".$ap1."','".$ap2."','".$carrera."','".$correo."','".$pass."')";

echo $consulta;

$CON->query($consulta);
$CON->close();
header("Location:../paginas/login-alumno.html");



?>