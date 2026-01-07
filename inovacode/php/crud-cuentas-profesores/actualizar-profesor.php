
<?php 
require "../conexion.php";
$CON =conectar();

$id=$_POST['id'];
$user=$_POST['u'];
$nom=$_POST['n'];
$ap1=$_POST['ap1'];
$ap2=$_POST['ap2'];
$correo=$_POST['e'];
$pass=$_POST['p'];

$consulta= "UPDATE profesores set Nombre = '".$nom."', usuario = '".$user."', apellido_paterno = '".$ap1."', apellido_materno = '".$ap2."',  correo = '".$correo."' , contrasena = '".$pass."' WHERE id_profesor =".$id;
echo $consulta;


$CON->query($consulta);
$CON->close();
header("Location:../../administrador/administrar-profesores.php");
