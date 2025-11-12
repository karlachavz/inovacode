<?php

require "conexion.php";

function consultar_tabla_alumnos(){
    $C=conectar();
    // creacion de consulta SQL

    $consulta="select * from alumno";
    //$res almacena el resultado
    $res=$C->query($consulta);
    $C->close();
    return $res;

}
?>