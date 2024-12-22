<?php
session_start();
require_once 'connection/connection.php'; // Asegúrate de que el path sea correcto.

$response = ["status" => "error", "message" => "Acceso no autorizado."];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    // Recibir y sanitizar el nombre de usuario
    $username = htmlspecialchars($_POST['username']);
    
    // Iniciar variables para imagen
    $ruta_foto = isset($_SESSION['imagen_perfil']) ? $_SESSION['imagen_perfil'] : null;

    // Cargar imagen de perfil si está presente y es válida
    if (!empty($_FILES['foto_perfil']['name'])) {
        $foto = $_FILES['foto_perfil'];
        $nombre_foto = $foto['name'];
        $tipo_foto = $foto['type'];
        $tamano_foto = $foto['size'];
        
        // Validar el tipo de archivo
        if (($tipo_foto == "image/jpg" || $tipo_foto == "image/jpeg" || $tipo_foto == "image/png") && $tamano_foto <= 5000000) {
            $ruta_foto = 'uploads/' . time() . '_' . $nombre_foto; // Crear un nombre único para la foto
            move_uploaded_file($foto['tmp_name'], $ruta_foto);
        } else {
            $response = ["status" => "error", "message" => "Formato de imagen no válido o tamaño demasiado grande."];
            echo json_encode($response);
            exit;
        }
    }

    // Actualización de la base de datos
    $stmt = $pdo->prepare("UPDATE usuarios SET nombre_usuario=?, imagen_perfil=? WHERE id=?");
    $stmt->execute([$username, $ruta_foto, $_SESSION['user_id']]);

    if ($stmt->rowCount()) {
        // Actualizar la sesión con la nueva imagen de perfil
        $_SESSION['imagen_perfil'] = $ruta_foto;

        $response = ["status" => "success", "message" => "Perfil actualizado correctamente."];
    } else {
        $response = ["status" => "error", "message" => "No se pudo actualizar el perfil."];
    }
}

echo json_encode($response);
?>
