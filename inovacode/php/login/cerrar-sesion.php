<?php
session_start();

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir al login o página principal
header("Location: ../../index.html"); 
exit();
?>