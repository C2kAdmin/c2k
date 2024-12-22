<?php
session_start();

// Verificar si hay una sesión activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // Destruir todas las variables de sesión
    session_unset();

    // Destruir la sesión
    session_destroy();
}

// Redirigir al usuario a la página principal
header("Location: index.php");
exit();
?>
