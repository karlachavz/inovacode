<?php

require "conexion.php";

function conectando(){
    $C=conectar();
    // creacion de consulta SQL

    $consulta="select * from alumno";
    //$res almacena el resultado
    $res=$C->query($consulta);
    return $res;

}
?>