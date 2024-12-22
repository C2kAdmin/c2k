<?php
session_start(); // Iniciar sesión para gestionar el registro
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar PHPMailer desde la ruta correcta
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

// Configuración de la base de datos
$host = 'localhost';
$dbname = 'ckcl_laliga';
$user = 'ckcl_admin';
$password = '112233Kdoki.';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Liga - Plataforma</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="animations.css">
    <script src="animations.js" defer></script>
    <script src="modal.js" defer></script>
</head>
<body>
    <header class="header">
        <h1>Bienvenido a La Liga</h1>
        <?php include 'mod_menu.php'; ?>
    </header>

    <main class="container_ppal">
        <div class="center-column_ppal">
            <a id="contenido_ancla"></a>
            <div id="contenido_dinamico">
                <?php include 'mods/mod_1/mod_1.php'; ?>
            </div>
        </div>
        <div class="right-column_ppal">
            <!-- Columna Derecha (contenido adicional) -->
        </div>
    </main>

    <footer class="section-footer">
        <p>&copy; 2024 La Liga - Todos los derechos reservados.</p>
    </footer>

    <!-- Botones o Enlaces para cargar contenido dinámico -->
    <nav>
        <ul>
            <li><a href="#" onclick="cargarFormulario('mods/mod_registro.php'); return false;">Registrarse</a></li>
            <li><a href="#" onclick="cargarFormulario('mods/mod_login.php'); return false;">Iniciar Sesión</a></li>
        </ul>
    </nav>
</body>
</html>
