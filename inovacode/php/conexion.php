<?php
/*function conectar(){
    //credenciales para conectar la base de datos
    $TIPO = "LOCALHOST";
    $USER = "root";
    $PWD = "";
    $BD = "complementarias";
    //crea el objeto con
    $con = new mysqli($TIPO,$USER,$PWD,$BD) or die ('Conexion fallida');
    //regresa el objeto con
    return $con;
}
*/

function conectar() {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "complementarias";
    
    $conexion = new mysqli($host, $user, $pass, $db);
    
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    
    // Configurar para soportar UTF-8 y JSON
    $conexion->set_charset("utf8mb4");
    
    return $conexion;
}
?>


