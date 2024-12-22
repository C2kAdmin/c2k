<?php
session_start();
require_once 'connection/connection.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    http_response_code(403); // No autorizado
    echo json_encode(["status" => "error", "message" => "No autorizado"]);
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("
        SELECT 
            correo, telefono, generacion, plataforma, pos1, pos2, pos3, imagen_perfil 
        FROM 
            usuarios 
        WHERE 
            id = :user_id
    ");
    $stmt->execute(['user_id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verificar si hay una imagen de perfil
        if (!empty($user['imagen_perfil'])) {
            $user['imagen_perfil_url'] = '/uploads/' . $user['imagen_perfil']; // Ruta completa de la imagen
        } else {
            $user['imagen_perfil_url'] = null; // Sin imagen
        }
        echo json_encode($user); // Devolver los datos del usuario como JSON
    } else {
        http_response_code(404); // Usuario no encontrado
        echo json_encode(["status" => "error", "message" => "Usuario no encontrado"]);
    }
} catch (PDOException $e) {
    http_response_code(500); // Error interno del servidor
    echo json_encode(["status" => "error", "message" => "Error al obtener los datos del usuario"]);
}
