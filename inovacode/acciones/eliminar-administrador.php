<?php 

require "conexion.php";

$CON = conectar();

$v=$_GET['ID'];

$sentencia ="DELETE FROM  administrador WHERE id_admin=".$v;
$CON->query($sentencia);
$CON->close();
header("Location:../paginas/administrar-administradores.php");
?>