<?php

require "../php/conexion.php";

function conectando(){
    $C=conectar();
    // creacion de consulta SQL

    /*$consulta="SELECT profesores.id_usuario as id_u, usuario, id_profesor, nombre, apellido_paterno, apellido_materno,correo FROM profesores 
    INNER JOIN usuarios 
    ON profesores.id_usuario = usuarios.id_usuario";*/
    $consulta = "
        SELECT 
            profesores.id_profesor,
            profesores.nombre,
            profesores.apellido_paterno,
            profesores.apellido_materno,
            profesores.correo,
            usuarios.id_usuario,
            usuarios.usuario
        FROM profesores
        INNER JOIN usuarios
        ON profesores.id_usuario = usuarios.id_usuario
    ";
    //$res almacena el resultado
    $res=$C->query($consulta);
    // Cerrar conexión
    
    $C->close();
    return $res;


}
?>


