<?php 

require "../conexion.php";

$CON = conectar();

$v=$_GET['ID'];

$sentencia ="DELETE FROM  profesores WHERE id_profesor=".$v;
$CON->query($sentencia);
$CON->close();
header("Location:../../administrador/administrar-profesores.php");
?>