<?php
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

// Verificar si el token es válido
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $sql = "SELECT * FROM recuperaciones WHERE token = ? AND expira > NOW()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$token]);
    $recuperacion = $stmt->fetch();

    if ($recuperacion) {
        // Mostrar el formulario para restablecer la contraseña
        echo '
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Restablecer Contraseña</title>
            <link rel="stylesheet" href="../../styles.css">
        </head>
        <body>
            <div class="modulo-restablecer">
                <h2>Restablecer Contraseña</h2>
                <form action="procesar_restablecer.php" method="POST">
                    <input type="hidden" name="token" value="' . htmlspecialchars($token) . '">
                    <div class="form-grupo">
                        <input type="password" name="password" placeholder="Nueva Contraseña" required>
                    </div>
                    <div class="form-grupo">
                        <input type="password" name="confirm_password" placeholder="Confirmar Contraseña" required>
                    </div>
                    <div class="form-grupo-boton">
                        <button type="submit">Restablecer Contraseña</button>
                    </div>
                </form>
            </div>
        </body>
        </html>';
    } else {
        echo 'El enlace de recuperación no es válido o ha expirado.';
    }
} else {
    echo 'No se proporcionó un token de recuperación.';
}
?>
