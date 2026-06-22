<?php

function esta_inscrito($numero_control, $id_complementaria) {
    $C = conectar();
    
    $sql = "SELECT COUNT(*) as total FROM grupo_alumno
    INNER JOIN grupos
    ON grupo_alumno.id_grupo = grupos.id_grupo
    WHERE id_complementaria = ? AND id_alumno = ?";
    $stmt = $C->prepare($sql);
    $stmt->bind_param("ii", $id_complementaria, $numero_control);
    $stmt->execute();
    $stmt->bind_result($total);
    $stmt->fetch();
    
    $stmt->close();
    $C->close();
    
    return $total > 0;
}