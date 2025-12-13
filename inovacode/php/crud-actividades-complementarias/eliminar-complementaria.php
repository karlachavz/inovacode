<?php 

require "../conexion.php";

$CON = conectar();

$v=$_GET['ID'];

$sentencia ="DELETE FROM  complementarias WHERE id_complementaria=".$v;
$CON->query($sentencia);
$CON->close();
header("Location:../../administrador/menu-administrador.php?mensaje=eliminado");
?>