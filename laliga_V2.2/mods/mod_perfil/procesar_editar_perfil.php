<?php
session_start();
require_once '../../connection/connection.php';

$response = ["status" => "error", "message" => "Ocurrió un error."];

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    http_response_code(403); // No autorizado
    echo json_encode(["status" => "error", "message" => "No autorizado"]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['user_id'];
    $nombre_usuario = trim($_POST['nombre_usuario']);
    $correo = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $telefono = trim($_POST['telefono']);
    $generacion = trim($_POST['generacion']);
    $plataforma = trim($_POST['plataforma']);
    $pos1 = trim($_POST['pos1']);
    $pos2 = trim($_POST['pos2']);
    $pos3 = trim($_POST['pos3']);
    $imagen_perfil = $_FILES['imagen_perfil'] ?? null;

    // Validar que las posiciones sean diferentes
    if ($pos1 === $pos2 || $pos1 === $pos3 || $pos2 === $pos3) {
        $response["message"] = "Las posiciones deben ser diferentes.";
        echo json_encode($response);
        exit;
    }

    try {
        $pdo->beginTransaction();

        // Actualizar datos del usuario
        $stmt = $pdo->prepare("UPDATE usuarios SET nombre_usuario = :nombre_usuario, correo = :correo, telefono = :telefono, generacion = :generacion, plataforma = :plataforma, pos1 = :pos1, pos2 = :pos2, pos3 = :pos3 WHERE id = :id");
        $stmt->execute([
            'nombre_usuario' => $nombre_usuario,
            'correo' => $correo,
            'telefono' => $telefono,
            'generacion' => $generacion,
            'plataforma' => $plataforma,
            'pos1' => $pos1,
            'pos2' => $pos2,
            'pos3' => $pos3,
            'id' => $id
        ]);

        // Manejar la imagen de perfil
        if ($imagen_perfil && $imagen_perfil['error'] === UPLOAD_ERR_OK) {
            $nombre_archivo = uniqid('perfil_') . '.' . pathinfo($imagen_perfil['name'], PATHINFO_EXTENSION);
            $ruta_destino = '../../uploads/' . $nombre_archivo;
            if (move_uploaded_file($imagen_perfil['tmp_name'], $ruta_destino)) {
                // Actualizar el campo de imagen_perfil
                $stmt = $pdo->prepare("UPDATE usuarios SET imagen_perfil = :imagen WHERE id = :id");
                $stmt->execute(['imagen' => $nombre_archivo, 'id' => $id]);
            } else {
                throw new Exception("Error al guardar la imagen de perfil.");
            }
        }

        $pdo->commit();
        $response["status"] = "success";
        $response["message"] = "Perfil actualizado correctamente.";
    } catch (Exception $e) {
        $pdo->rollBack();
        $response["message"] = "Error al actualizar: " . $e->getMessage();
    }
}

echo json_encode($response);
