<?php
// Datos de conexión a la base de datos
$db_host = 'localhost';
$db_name = 'ckcl_laliga'; // Nombre de la base de datos
$db_user = 'ckcl_admin';  // Usuario de la base de datos
$db_password = '112233Kdoki.'; // Contraseña de la base de datos

try {
    // Crear conexión usando PDO
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En caso de error, detener la ejecución y mostrar el mensaje
    die("Error de conexión: " . $e->getMessage());
}
?>
