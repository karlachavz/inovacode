<?php

require "conexion.php";
$CON =conectar();

$u = $_POST['u'];
$e = $_POST['e'];
$p = $_POST['p'];


$sql = "SELECT COUNT(*) as total FROM administrador WHERE usuario = '$u'";
$result = $CON->query($sql);
$row = $result->fetch_assoc();

if ($row['total'] > 0) {// si hay un duplicado
    header("Location: ../paginas/administrar-administradores.php?mensaje=duplicado");
    ?>
    <script>
        alert('Usurio ya existente ');
        window.location.href='../paginas/administrar-administradores.php';
    </script>
    <?php

    exit;
}


// si no existe el usuario 
$sql_query = "INSERT INTO administrador (usuario, correo, contrasena) VALUES ('$u', '$e', '$p')";

if ($CON->query($sql_query)) {
     header("Location: ../paginas/administrar-administradores.php?mensaje=exitoso");
    ?>
     <script>
            alert('Datos agregados correctamente');
            window.location.href='../paginas/administrar-administradores.php';
        </script>    
        <?php   
        exit;
} else {
    header("Location: ../paginas/administrar-administradores.php?mensaje=desconosido");
    ?>
    <script>
            alert('Datos no agregados correctamente');
            window.location.href='../paginas/administrar-administradores.php';
        </script> 
    <?php
    exit;
}

?>