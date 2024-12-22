<?php
require_once 'connection/connection.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Buscar al usuario con el token
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE token_verificacion = :token AND email_verified = 0");
    $stmt->execute(['token' => $token]);
    $usuario = $stmt->fetch();

    if ($usuario) {
        // Marcar el correo como verificado
        $stmt = $pdo->prepare("UPDATE usuarios SET email_verified = 1, token_verificacion = NULL WHERE id = :id");
        $stmt->execute(['id' => $usuario['id']]);
        echo "¡Tu correo ha sido verificado exitosamente! Ahora puedes iniciar sesión.";
    } else {
        echo "El enlace de verificación no es válido o ha expirado.";
    }
} else {
    echo "Token de verificación no proporcionado.";
}
