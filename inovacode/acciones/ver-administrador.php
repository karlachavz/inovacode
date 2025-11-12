<?php

require "conexion.php";

function conectando(){
    $C=conectar();
    // creacion de consulta SQL

    $consulta="select * from administrador";
    //$res almacena el resultado
    $res=$C->query($consulta);
    // Cerrar conexión
    
    $C->close();
    return $res;


}
?>