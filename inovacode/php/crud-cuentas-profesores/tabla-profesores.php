<?php

require "../php/conexion.php";

function consultar_tabla_profesores(){
    $C=conectar();
    // creacion de consulta SQL

    $consulta="select * from profesores";
    //$res almacena el resultado
    $res=$C->query($consulta);
    $C->close();
    return $res;

}
