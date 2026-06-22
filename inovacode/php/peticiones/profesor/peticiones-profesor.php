<?php
require "../php/conexion.php";



//funcion para obtener los datos del profesor
function obtener_datos_profesor($id_usuario)
{
    $C = conectar();

    // Buscar el id_profesor usando el id_usuario
    $stmtProfesor = $C->prepare("SELECT id_profesor FROM profesores WHERE id_usuario = ?");

    $stmtProfesor->bind_param("i", $id_usuario);

    $stmtProfesor->execute();

    $resultadoProfesor = $stmtProfesor->get_result();

    // Verificar si existe el profesor
    if ($resultadoProfesor->num_rows == 0) {

        $stmtProfesor->close();
        $C->close();

        return false;
    }

    // Obtener datos
    $profesor = $resultadoProfesor->fetch_assoc();

    $id_profesor = $profesor['id_profesor'];

    $stmtProfesor->close();

    //consultar datos del profesor

    $stmt = $C->prepare("SELECT * FROM profesores WHERE id_profesor = ?");

    $stmt->bind_param("i", $id_profesor);

    $stmt->execute();

    $res = $stmt->get_result();

    $stmt->close();

    $C->close();

    return $res;   
}





//funcion para obtener los datos de los grupos del profesor
function obtener_grupos($id_usuario)
{

    $C = conectar();

    // Buscar el id_profesor usando el id_usuario
    $stmtProfesor = $C->prepare("SELECT id_profesor FROM profesores WHERE id_usuario = ?");

    $stmtProfesor->bind_param("i", $id_usuario);

    $stmtProfesor->execute();

    $resultadoProfesor = $stmtProfesor->get_result();

    // Verificar si existe el profesor
    if ($resultadoProfesor->num_rows == 0) {

        $stmtProfesor->close();
        $C->close();

        return false;
    }

    // Obtener datos
    $profesor = $resultadoProfesor->fetch_assoc();

    $id_profesor = $profesor['id_profesor'];

    $stmtProfesor->close();

    // Consultar grupos
    $stmt = $C->prepare("SELECT grupos.id_grupo, grupos.nombre, horarios.hora_inicio, horarios.hora_fin, dia.dia 
    FROM grupos  
    LEFT JOIN horarios
    ON grupos.id_grupo = horarios.id_grupo
    LEFT JOIN dia
    ON horarios.id_dia = dia.id_dia
    WHERE id_profesor = ? ");

    $stmt->bind_param("i", $id_profesor);

    $stmt->execute();

    $res = $stmt->get_result();

    $stmt->close();

    $C->close();

    return $res;
}



//funcion para obtener la lista de alumnos de la base de datos
function obtener_lista_alumnos ($id_grupo){
     $C = conectar();
      // consulta para obtener la lista de alumno
    $stmt = $C->prepare("SELECT nombre, apellido_paterno, apellido_materno, numero_control 
        FROM grupo_alumno 
        INNER JOIN alumnos 
        ON grupo_alumno.id_alumno=alumnos.numero_control 
        WHERE id_grupo = ? ");

    $stmt->bind_param("i", $id_grupo);

    $stmt->execute();

    $res = $stmt->get_result();

    return $res;

}



// funcion para obtener el nombre del grupo

function obtener_nombre_grupo($id_grupo){
    $C = conectar();
      // consulta para obtener la lista de alumno
    $stmt = $C->prepare("SELECT nombre FROM grupos  
        WHERE id_grupo = ? ");

    $stmt->bind_param("i", $id_grupo);

    $stmt->execute();

    $res = $stmt->get_result();

    return $res;

}
