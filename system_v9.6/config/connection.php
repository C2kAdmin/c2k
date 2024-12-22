<?php
// Archivo: /connection/connection.php
// Configuración de conexión a la base de datos

$host = 'localhost';
$dbname = 'ckcl_laliga';
$user = 'ckcl_admin';
$password = '112233Kdoki.';

try {
    // Crear conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}
