<?php
require "../conexion.php";


$C = conectar();

if(!isset($_GET['id_grupo']) || !isset($_GET['ID']) || !isset($_GET['nombre'])){
    header("Location:../../alumno/grupos-disponibles.php?mensaje=denegado");
    exit();
}

$control = $_GET['control'];
$id_grupo = $_GET['id_grupo'];

//---verificar cuantos creditos tiene el alumno  si tiene  5 o mas creditos no puede inscribirse a ningun grupo 
//el alumno consigue creditos aprobando la complementaria

$stmt_creditos = $C->prepare("SELECT creditos FROM alumnos WHERE numero_control = ?");
$stmt_creditos->bind_param("i", $control);
$stmt_creditos->execute();
$result_creditos =$stmt_creditos->get_result();
$row_creditos = $result_creditos->fetch_assoc();




//verificar a cuantas complementarias esta escrito el alumno este periodo

$stmt_complementarias = $C->prepare("SELECT COUNT(*) AS total FROM grupo_alumno WHERE id_alumno = ?  AND id_estado_grupo_alumno= 1");
$stmt_complementarias->bind_param("i",$control);
$stmt_complementarias->execute();
$result_complementarias=$stmt_complementarias->get_result();
$row_complementarias = $result_complementarias->fetch_assoc();


echo $row_creditos['creditos']+$row_complementarias['total'];

if ( $row_creditos['creditos']+$row_complementarias['total']>=5){
 header("Location:../../alumno/grupos-disponibles.php?ID=".$_GET['ID']."&nombre=".$_GET['nombre']."&mensaje=limite");
    exit();
}





// ---verificar cuantos cupos diponibles hay ---
$stmt_cupos = $C->prepare("SELECT cupos_disponibles FROM grupos WHERE id_grupo = ?");
$stmt_cupos->bind_param("i", $id_grupo);
$stmt_cupos->execute();
$result_cupos = $stmt_cupos->get_result();
$row_cupos = $result_cupos->fetch_assoc();// guarda el resultado 


if($row_cupos['cupos_disponibles'] <= 0){
    header("Location:../../alumno/grupos-disponibles.php?ID=".$_GET['ID']."&nombre=".$_GET['nombre']."&mensaje=sincupos");
    exit();
}

// --verificar si el alumno ya esta inscrito en ese grupo--
$stmt_verificar = $C->prepare("SELECT COUNT(*) as total FROM grupo_alumno WHERE id_alumno = ? AND id_grupo = ?");
$stmt_verificar->bind_param("ii", $control, $id_grupo);
$stmt_verificar->execute();
$result_verificar = $stmt_verificar->get_result();
$row_verificar = $result_verificar->fetch_assoc();

if($row_verificar['total'] > 0){
    header("Location:../../alumno/grupos-disponibles.php?ID=".$_GET['ID']."&nombre=".$_GET['nombre']."&mensaje=yainscrito");
    exit();
}

//inscribir al alumno 
$stmt_insert = $C->prepare("INSERT INTO grupo_alumno (id_alumno, id_grupo) VALUES (?, ?)");
$stmt_insert->bind_param("ii", $control, $id_grupo);

if($stmt_insert->execute()){
    // Actualizar cupos disponibles
    $nuevos_cupos = $row_cupos['cupos_disponibles'] - 1;
    $stmt_update = $C->prepare("UPDATE grupos SET cupos_disponibles = ? WHERE id_grupo = ?");
    $stmt_update->bind_param("ii", $nuevos_cupos, $id_grupo);
    $stmt_update->execute();
    
    header("Location:../../alumno/historial-avance.php?ID=".$id_grupo."&mensaje=inscrito");
} else {
    header("Location:../../alumno/grupos-disponibles.php?ID=".$_GET['ID']."&nombre=".$_GET['nombre']."&mensaje=errorinscripcion");
}

exit();
?>