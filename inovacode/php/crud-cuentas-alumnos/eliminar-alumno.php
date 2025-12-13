<?php 

require "../conexion.php";

$CON = conectar();

$v=$_GET['ID'];

$sentencia ="DELETE FROM  alumno WHERE control=".$v;
$CON->query($sentencia);
$CON->close();
header("Location:../../administrador/administrar-alumnos.php");
?>