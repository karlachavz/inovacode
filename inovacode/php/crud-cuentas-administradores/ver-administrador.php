<?php

require "../php/conexion.php";

function conectando(){
    $C=conectar();
    // creacion de consulta SQL

    $consulta="SELECT * FROM administrador 
    INNER JOIN usuarios 
    ON administrador.id_usuario = usuarios.id_usuario";
    //$res almacena el resultado
    $res=$C->query($consulta);
    // Cerrar conexión
    
    $C->close();
    return $res;


}
?>