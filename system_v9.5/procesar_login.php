<?php
session_start();
require_once 'connection/connection.php';

$response = [
    "status" => "error",
    "message" => "Ocurrió un error inesperado."
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);
    $contrasena = trim($_POST['contrasena']);

    if (empty($correo) || empty($contrasena)) {
        $response["message"] = "Correo y contraseña son obligatorios.";
        echo json_encode($response);
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT id, contrasena, nombre_usuario, email_verified, imagen_perfil, telefono, pos1, pos2, pos3 FROM usuarios WHERE correo = :correo");
        $stmt->execute(['correo' => $correo]);
        $usuario = $stmt->fetch();

        if (!$usuario) {
            $response["message"] = "Credenciales inválidas.";
            echo json_encode($response);
            exit;
        }

        if ($usuario['email_verified'] == 0) {
            $response["message"] = "Tu correo no está verificado.";
            echo json_encode($response);
            exit;
        }

        if (!password_verify($contrasena, $usuario['contrasena'])) {
            $response["message"] = "Contraseña incorrecta.";
            echo json_encode($response);
            exit;
        }

        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_name'] = $usuario['nombre_usuario'];
        $_SESSION['user_email'] = $correo; // Asegúrate de que el correo se almacene en sesión si es necesario.
        $_SESSION['imagen_perfil'] = $usuario['imagen_perfil'];
        $_SESSION['user_phone'] = $usuario['telefono']; // Almacena el teléfono completo con código de país
        $_SESSION['user_pos1'] = $usuario['pos1'];
        $_SESSION['user_pos2'] = $usuario['pos2'];
        $_SESSION['user_pos3'] = $usuario['pos3'];

        $response["status"] = "success";
        $response["message"] = "Inicio de sesión exitoso. Bienvenido, " . htmlspecialchars($usuario['nombre_usuario']) . ".";
    } catch (PDOException $e) {
        $response["message"] = "Error al iniciar sesión: " . $e->getMessage();
    }
    echo json_encode($response);
}
?>
