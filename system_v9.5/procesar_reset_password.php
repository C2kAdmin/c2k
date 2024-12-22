<?php
session_start();
require_once 'connection/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reset_token = trim($_POST['reset_token']);
    $nueva_contrasena = trim($_POST['nueva_contrasena']);
    $confirmar_contrasena = trim($_POST['confirmar_contrasena']);

    if (empty($reset_token) || empty($nueva_contrasena) || empty($confirmar_contrasena)) {
        $_SESSION['reset_error'] = "Todos los campos son obligatorios.";
        header("Location: index.php");
        exit;
    }

    if ($nueva_contrasena !== $confirmar_contrasena) {
        $_SESSION['reset_error'] = "Las contraseñas no coinciden.";
        header("Location: index.php");
        exit;
    }

    try {
        $stmt = $pdo->prepare("
            SELECT r.usuario_id
            FROM recuperaciones r
            WHERE r.token = :reset_token
        ");
        $stmt->execute(['reset_token' => $reset_token]);
        $recuperacion = $stmt->fetch();

        if (!$recuperacion) {
            $_SESSION['reset_error'] = "El token no es válido o ya fue usado.";
            header("Location: index.php");
            exit;
        }

        $password_hash = password_hash($nueva_contrasena, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("UPDATE usuarios SET contrasena = :contrasena WHERE id = :usuario_id");
        $stmt->execute([
            'contrasena' => $password_hash,
            'usuario_id' => $recuperacion['usuario_id'],
        ]);

        $stmt = $pdo->prepare("DELETE FROM recuperaciones WHERE token = :reset_token");
        $stmt->execute(['reset_token' => $reset_token]);

        $_SESSION['reset_success'] = "Contraseña restablecida correctamente. Ahora puedes iniciar sesión.";
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['reset_error'] = "Error al procesar la solicitud.";
        header("Location: index.php");
        exit;
    }
}

header("Location: index.php");
exit;
