<?php
// mods/mod_crear_club/mod_crear_club.php

// Conexión a la base de datos
$host = 'localhost';
$dbname = 'ckcl_laliga';
$user = 'ckcl_admin';
$pass = '112233Kdoki.';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}

// Verificar si el usuario está autenticado y si ya tiene un club
session_start();
if (!isset($_SESSION['usuario_id'])) {
    echo "<p>Error: No has iniciado sesión.</p>";
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT * FROM clubes WHERE creador_id = :creador_id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':creador_id' => $creador_id]);
$club = $stmt->fetch(PDO::FETCH_ASSOC);

if ($club) {
    echo "<p>Error: Ya has creado un club.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Club</title>
    <link rel="stylesheet" href="../../styles.css">
</head>
<body>
    <div class="modulo-crear-club">
        <h2>Crear un Club</h2>
        <form id="crearClubForm" action="procesar_crear_club.php" method="POST" enctype="multipart/form-data">
            <div class="form-grupo">
                <label for="nombre_club">Nombre del Club</label>
                <input type="text" id="nombre_club" name="nombre_club" placeholder="Nombre del Club" required>
            </div>
            <div class="form-grupo">
                <label for="escudo_club">Escudo del Club</label>
                <input type="file" id="escudo_club" name="escudo_club" accept="image/*" required>
            </div>
            <div class="form-grupo-boton">
                <button type="submit">Crear Club</button>
            </div>
        </form>
    </div>
</body>
</html>
