<?php
require "../conexion.php";
$CON = conectar();

// Verificar que todos los campos requeridos estén presentes
if (!isset(
    $_POST['nombre'],
    $_POST['id_profesor'],
    $_POST['creditos'],
    $_POST['id_dia1'],
    $_POST['hora_inicio1'],
    $_POST['hora_fin1'],
    $_POST['cupos'],
    $_POST['id_complementaria'],
    $_POST['id_periodo']
)) {
    header("Location: ../../administrador/ver-complementarias.php?mensaje=error_campos&ID=" . $_POST['id_complementaria']);
    exit;
}

// Obtener variables del método POST

//variables para dar de alta complementaria
$id_complementaria = $_POST['id_complementaria'];
$nombre = $_POST['nombre'];
$cupos = $_POST['cupos'];
$creditos = $_POST['creditos'];
$id_profesor = $_POST['id_profesor'];
$id_periodo = $_POST['id_periodo'];


//variables para establecer el horario del dia 1
$id_dia1 = $_POST['id_dia1'];
$hora_inicio1 = $_POST['hora_inicio1'];
$hora_fin1 = $_POST['hora_fin1'];



// Validar horas
if ($hora_inicio1 >= $hora_fin1) {
     // redirige a página de ver-complemetarias y lanza error de horas
     header("Location: ../../administrador/ver-complementarias.php?mensaje=error_horas&ID=$id_complementaria");
     exit;
}

// Consulta para insertar grupos 
$consulta = "INSERT INTO grupos (id_complementaria, nombre, cupos_disponibles, creditos, id_profesor,id_periodo,id_estado) 
             VALUES ($id_complementaria, '$nombre', $cupos, $creditos, $id_profesor,$id_periodo, 3)";

try {
    //insertar grupo nuevo
    $CON->query($consulta);
    
    // Obtener el ID del grupo recién insertado
    $id_grupo = $CON->insert_id;

    // Insertar primer horario  
    //INSERT INTO `horarios` (`id_horario`, `id_dia`, `hora_inicio`, `hora_fin`, `id_grupo`) VALUES (NULL, '1', '7:00 am', '8: 00 pm', '45');
    $consulta_horario1 = "INSERT INTO horarios (id_dia,hora_inicio, hora_fin, id_grupo) 
                         VALUES ( $id_dia1, '$hora_inicio1', '$hora_fin1',$id_grupo)";
                         echo $consulta_horario1;

    $CON->query($consulta_horario1);

    // Verificar si hay segundo día (usando el checkbox y los campos)
    if (
        isset($_POST['tiene_segundo_dia']) && $_POST['tiene_segundo_dia'] == '1' &&
        isset($_POST['dia2']) && !empty($_POST['dia2']) &&
        isset($_POST['hora_inicio2']) && !empty($_POST['hora_inicio2']) &&
        isset($_POST['hora_fin2']) && !empty($_POST['hora_fin2'])
    ) {

        $dia2 = $_POST['dia2'];
        $hora_inicio2 = $_POST['hora_inicio2'];
        $hora_fin2 = $_POST['hora_fin2'];

        // Validar horas del segundo día
        if ($hora_inicio2 >= $hora_fin2) {
            header("Location: ../../administrador/ver-complementarias.php?mensaje=error_horas2&ID=$id_complementaria");
            exit;
        }

        // Insertar segundo horario
        $consulta_horario2 = "INSERT INTO horarios (id_dia,hora_inicio, hora_fin, id_grupo) 
                             VALUES ( $dia2, '$hora_inicio2', '$hora_fin2',$id_grupo)";
        $CON->query($consulta_horario2);
    }

    $CON->close();
    header("Location: ../../administrador/ver-complementarias.php?mensaje=exitoso&ID=$id_complementaria");
    exit;
} catch (mysqli_sql_exception $e) {
    // Si el error es de duplicado (código 1062)
   if ($e->getCode() == 1062) {
      header("Location: ../../administrador/ver-complementarias.php?mensaje=duplicado&ID=$id_complementaria");
   } else {
        // Mostrar el error para depuración (en desarrollo)
        // En producción, redirigir con mensaje genérico
        
       error_log("Error al insertar grupo: " . $e->getMessage());
       header("Location: ../../administrador/ver-complementarias.php?mensaje=error_db&ID=$id_complementaria");
   }
    exit;
}
