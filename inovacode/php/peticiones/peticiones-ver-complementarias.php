<?php

//Obtener periodos
function obtener_periodos()
{
    $C = conectar();
    $sql = "SELECT * FROM periodo ORDER BY id_periodo  DESC";
    $resultado_periodo = $C->query($sql);
    $C->close();
    return $resultado_periodo;
}

//Obtener profesores
function obtener_profesores()
{
    $C = conectar();
    $sql = "SELECT id_profesor, nombre, apellido_paterno, apellido_materno FROM profesores;";
    $resultado = $C->query($sql);
    $C->close();
    return $resultado;
}

//obtener nombre y id complementaria

function obtener_complementaria($id_complementaria)
{
    $id = $id_complementaria;
    $C = conectar();
    $sql = "SELECT nombre, id_complementaria FROM complementarias WHERE id_complementaria = $id";
    $resultado = $C->query($sql);
    $C->close();
    return $resultado;
}
