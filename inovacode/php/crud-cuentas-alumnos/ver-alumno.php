<?php

require "../php/conexion.php";

function consultar_tabla_alumnos(){
    $C=conectar();
    // creacion de consulta SQL

    $consulta="SELECT usuarios.id_usuario as id_u ,numero_control, nombre, apellido_paterno, apellido_materno, divisiones.id_division as id_d , division, correo FROM alumnos INNER JOIN usuarios ON usuarios.id_usuario = alumnos.id_usuario INNER JOIN divisiones ON alumnos.id_division = divisiones.id_division";
    //$res almacena el resultado
    $res=$C->query($consulta);
    $C->close();
    return $res;

}
