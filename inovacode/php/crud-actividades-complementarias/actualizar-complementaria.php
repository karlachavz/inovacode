<?php 

require "../conexion.php";
$CON =conectar();
$id=$_POST['id'];
$nombre=$_POST['nombre'];
$descripcion=$_POST['descripcion'];
$imagen=$_POST['imagen'];


$consulta= "UPDATE complementarias set nombre = '".$nombre."', descripcion = '".$descripcion."', imagen = '".$imagen."' WHERE id_complementaria =".$id;
echo $consulta;
try{
    $CON->query($consulta);
    $CON->close();
    header("Location:../../administrador/menu-administrador.php");
    exit;
}catch (mysqli_sql_exception $e) {

    // Si el error es de duplicado (código 1062)
    if ($e->getCode() == 1062) {
        header("Location: ../../administrador/menu-administrador.php?mensaje=duplicado");
    } else {
        header("Location: ../../administrador/menu-administrador.php?mensaje=desconocido");
    }
    exit;
}



?>