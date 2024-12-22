<?php
// Activar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir archivo de conexión
require $_SERVER['DOCUMENT_ROOT'] . '/system_v7.0_laliga/connection/connection.php';

// Verificar el token
if (isset($_GET['token'])) {
    $token = trim($_GET['token']);

    try {
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE token = :token AND email_verified = 0");
        $stmt->execute(['token' => $token]);

        if ($stmt->rowCount() > 0) {
            // Verificar el email
            $stmt = $pdo->prepare("UPDATE usuarios SET email_verified = 1, token = NULL WHERE token = :token");
            $stmt->execute(['token' => $token]);
            echo "Correo verificado exitosamente. Ahora puedes iniciar sesión.";
        } else {
            echo "El token es inválido o ya fue utilizado.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No se proporcionó un token válido.";
}
?>
