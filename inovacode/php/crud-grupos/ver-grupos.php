<?php
// FUNCIÓN: consultar_grupos
// Obtiene todos los grupos junto con:
// - profesor
// - día
// - horario
// - cupos y créditos
// OJO: un grupo puede aparecer varias veces (una por cada horario)
function consultar_grupos()
{
    // Abrimos conexión a la BD
    $C = conectar();

    // Consulta SQL con JOIN
    $consulta = "
        SELECT 
            grupos.id_grupo,
            grupos.nombre AS nombre_grupo,

            profesores.nombre AS nombre_profesor,
            profesores.apellido_paterno,
            profesores.apellido_materno,

            grupos.cupos_disponibles,
            grupos.creditos,

            dia.dia,
            horarios.hora_inicio,
            horarios.hora_fin

        FROM grupos
        INNER JOIN profesores 
            ON grupos.id_profesor = profesores.id_profesor

        INNER JOIN horarios 
            ON grupos.id_grupo = horarios.id_grupo

        INNER JOIN dia 
            ON horarios.id_dia = dia.id_dia

        ORDER BY grupos.id_grupo
    ";

    // Ejecutamos la consulta
    $res = $C->query($consulta);

    // Cerramos conexión
    $C->close();

    // Retornamos el resultado
    return $res;
}
