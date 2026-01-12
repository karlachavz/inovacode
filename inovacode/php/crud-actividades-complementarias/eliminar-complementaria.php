<?php 

require "../conexion.php";

$CON = conectar();

$v=$_GET['ID'];

try{
    $sentencia ="DELETE FROM  complementarias WHERE id_complementaria=".$v;
$CON->query($sentencia);
$CON->close();
header("Location:../../administrador/menu-administrador.php?mensaje=eliminado");
}catch(mysqli_sql_exception $e){ 
error_log("Error al eliminar grupo: " . $e->getMessage());
    header("Location:../../administrador/menu-administrador.php?mensaje=error_db&ID=$id_complementaria");

} 
