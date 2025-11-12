<?php 


require "conexion.php";
$CON =conectar();

$control=$_POST['id'];
$nom=$_POST['n'];
$ap1=$_POST['ap1'];
$ap2=$_POST['ap2'];
$carrera=$_POST['c'];
$correo=$_POST['e'];
$pass=$_POST['p'];

$consulta= "UPDATE alumno set Nombre = '".$nom."', apellido_paterno = '".$ap1."', apellido_materno = '".$ap2."',  carrera = '".$carrera."', correo = '".$correo."' , contrasena = '".$pass."' WHERE Control =".$control;
echo $consulta;


$CON->query($consulta);
$CON->close();
header("Location:../paginas/administrar-alumnos.php");


  

?>