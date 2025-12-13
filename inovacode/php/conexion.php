<?php


function conectar(){
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




?>