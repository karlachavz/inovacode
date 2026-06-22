<?php
require "../php/conexion.php";

function consultar($control){

    $C = conectar();

    

    

    // Consultar grupos
    $stmt = $C->prepare("SELECT grupos.id_grupo as id_grupo, grupos.nombre 
    as nombre_grupo, profesores.nombre as nombre, apellido_paterno, apellido_materno, hora_inicio, hora_fin, dia
    FROM grupo_alumno 
    INNER JOIN grupos
    ON grupo_alumno.id_grupo = grupos.id_grupo
    INNER JOIN profesores
    ON grupos.id_profesor = profesores.id_profesor
    LEFT JOIN horarios 
    ON grupos.id_grupo = horarios.id_grupo
    LEFT JOIN dia
    ON horarios.id_dia = dia.id_dia
    
    WHERE id_alumno = ? ORDER BY id_grupo_alumno DESC");

    $stmt->bind_param("i", $control);

    $stmt->execute();

    $res = $stmt->get_result();

    $stmt->close();

    $C->close();

    return $res;
}
?>