<?php 

require "conexion.php";
$CON =conectar();
$id=$_POST['id'];
$user=$_POST['u'];
$email=$_POST['e'];
$pass=$_POST['p'];


$consulta= "UPDATE administrador set usuario = '".$user."', correo = '".$email."', contrasena = '".$pass."' WHERE id_admin =".$id;
echo $consulta;

$CON->query($consulta);
$CON->close();
header("Location:../paginas/administrar-administradores.php");

?>