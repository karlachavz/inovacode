<?php 


require "conexion.php";
$CON =conectar();

$control=$_POST['id'];
$nom=$_POST['n'];
$carrera=$_POST['c'];
$correo=$_POST['e'];
$pass=$_POST['p'];

$consulta= "UPDATE alumno set Nombre = '".$nom."', carrera = '".$carrera."', correo = '".$correo."' , contrasena = '".$pass."' WHERE Control =".$control;
echo $consulta;

$CON->query($consulta);
$CON->close();
header("Location:../paginas/administrar-alumnos.php");


  

?>