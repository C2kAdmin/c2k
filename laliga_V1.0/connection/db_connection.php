<?php
// connection/db_connection.php

// Datos de conexión a la base de datos
$host = 'localhost';
$dbname = 'ckcl_laliga';
$user = 'ckcl_admin';
$password_db = '112233Kdoki.';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Error de conexión a la base de datos: ' . $e->getMessage());
}
?>
