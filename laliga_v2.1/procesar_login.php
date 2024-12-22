<?php
session_start();
require_once 'connection/connection.php';

// Respuesta inicial
$response = [
    "status" => "error",
    "message" => "Ocurrió un error inesperado."
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir y sanitizar los datos
    $correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);
    $contrasena = trim($_POST['contrasena']);

    if (empty($correo) || empty($contrasena)) {
        $response["message"] = "Correo y contraseña son obligatorios.";
        echo json_encode($response);
        exit;
    }

    try {
        // Verificar si el usuario existe
        $stmt = $pdo->prepare("
            SELECT id, contrasena, nombre_usuario, email_verified 
            FROM usuarios 
            WHERE correo = :correo
        ");
        $stmt->execute(['correo' => $correo]);
        $usuario = $stmt->fetch();

        if (!$usuario) {
            $response["message"] = "Credenciales inválidas.";
            echo json_encode($response);
            exit;
        }

        // Verificar si el correo está verificado
        if ($usuario['email_verified'] == 0) {
            $response["message"] = "Tu correo no está verificado. Por favor, verifica tu correo para iniciar sesión.";
            echo json_encode($response);
            exit;
        }

        // Verificar la contraseña
        if (!password_verify($contrasena, $usuario['contrasena'])) {
            $response["message"] = "Credenciales inválidas.";
            echo json_encode($response);
            exit;
        }

        // Iniciar sesión
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_name'] = $usuario['nombre_usuario'];
        $response["status"] = "success";
        $response["message"] = "Inicio de sesión exitoso. Bienvenido, " . htmlspecialchars($usuario['nombre_usuario']) . ".";
    } catch (PDOException $e) {
        $response["message"] = "Error al iniciar sesión: " . $e->getMessage();
    }
} else {
    $response["message"] = "Método de solicitud no permitido.";
}

echo json_encode($response);
