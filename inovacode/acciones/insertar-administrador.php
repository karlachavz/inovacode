<?php

require "conexion.php";
$CON =conectar();

$user=$_POST['u'];
$email=$_POST['e'];
$pass=$_POST['p'];

$consulta= "insert into administrador (usuario, correo, contrasena) values ('"
.$user."','".$email."','".$pass."')";

echo $consulta;

$CON->query($consulta);
$CON->close();
header("Location:../paginas/administrar-administradores.php");


?>