<?php

require "conexion.php";
$CON =conectar();

$control=$_POST['no_control'];
$nom=$_POST['n'];
$carrera=$_POST['c'];
$correo=$_POST['e'];
$pass=$_POST['p'];

$consulta= "insert into alumno (control, nombre, carrera, correo, contrasena) values ("
.$control.",'".$nom."','".$carrera."','".$correo."','".$pass."')";

echo $consulta;

$CON->query($consulta);
$CON->close();
header("Location:../paginas/administrar-alumnos.php");


?>