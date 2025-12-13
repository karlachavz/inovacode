<?php
require "../php/conexion.php";

function consultar(){
    $C=conectar();
    // creacion de consulta SQL

    $consulta="select * from complementarias";
    //$res almacena el resultado
    $res=$C->query($consulta);
    $C->close();
    return $res;

}
?>