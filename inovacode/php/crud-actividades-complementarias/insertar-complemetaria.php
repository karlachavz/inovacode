<?php

require "../conexion.php";
$CON =conectar();

$nombre=$_POST['nombre'];
$descripcion=$_POST['descripcion'];
$imagen=$_POST['img'];

$consulta = "INSERT INTO complementarias (nombre, descripcion, imagen) 
VALUES ('".$nombre."','".$descripcion."','".$imagen."')";


try {
    $CON->query($consulta);
    $CON->close();
    header("Location: ../../administrador/menu-administrador.php?mensaje=exitoso");
    exit;
} 
catch (mysqli_sql_exception $e) {

    // Si el error es de duplicado (código 1062)
    if ($e->getCode() == 1062) {
        header("Location: ../../administrador/menu-administrador.php?mensaje=duplicado");
    } else {
        header("Location: ../../administrador/menu-administrador.php?mensaje=desconocido");
    }

    exit;
}

?>