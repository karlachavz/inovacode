<?php
require "../conexion.php";

$CON = conectar();


// Validar campos obligatorios
if (!isset(
    $_POST['id_complementaria'],
    $_POST['id_grupo'],
    $_POST['edit_nombre'],
    $_POST['edit_profesor'],
    $_POST['edit_creditos'],
    $_POST['edit_cupos'],
    $_POST['edit_periodo']
)) {

    header("Location: ../../administrador/ver-complementarias.php?mensaje=error_campos");
    exit;
}


// Recibir datos
$id_complementaria =$_POST['id_complementaria'];
$id_grupo = $_POST['id_grupo'];
$nombre = $_POST['edit_nombre'];
$id_profesor = $_POST['edit_profesor'];
$creditos = $_POST['edit_creditos'];
$cupos = $_POST['edit_cupos'];
$id_periodo = $_POST['edit_periodo'];


// Validar valores

if (empty($id_profesor)) {

    header("Location: ../../administrador/ver-complementarias.php?ID=".$id_complementaria."&mensaje=error_profesor");
    exit;
}


try {


    // Actualizar grupo

    $sql = "UPDATE grupos SET
            nombre = '$nombre',
            cupos_disponibles = $cupos,
            creditos = $creditos,
            id_profesor = $id_profesor,
            id_periodo = $id_periodo
            WHERE id_grupo = $id_grupo";


    $CON->query($sql);



    $CON->close();


    header("Location: ../../administrador/ver-complementarias.php?ID=".$id_complementaria."&mensaje=editado");
    exit;



} catch(mysqli_sql_exception $e){


    error_log("Error al editar grupo: ".$e->getMessage());


    header("Location: ../../administrador/ver-complementarias.php?ID=".$id_complementaria."&mensaje=error_db");
    exit;

}

?>