<?php
// Conexión a la base de datos
$host = 'localhost';
$dbname = 'ckcl_laliga';
$user = 'ckcl_admin';
$pass = '112233Kdoki.';

session_start();
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'Debes iniciar sesión para actualizar tu perfil.']);
    exit();
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error al conectar a la base de datos.']);
    exit();
}

// Actualizar los datos del usuario
$username = $_POST['username'];
$telefono = $_POST['telefono'];
$usuario_id = $_SESSION['usuario_id'];
$foto_perfil = '';

// Procesar imagen de perfil (si se sube una nueva)
if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
    $nombreArchivo = $_FILES['foto_perfil']['name'];
    $nombreTmpArchivo = $_FILES['foto_perfil']['tmp_name'];
    $carpetaDestino = $_SERVER['DOCUMENT_ROOT'] . '/laliga/mods/mod_registro/upload/';

    // Verificar si el archivo es una imagen
    $infoArchivo = getimagesize($nombreTmpArchivo);
    if ($infoArchivo !== false) {
        // Generar un nombre único para la imagen y moverla a la carpeta de destino
        $nuevoNombreArchivo = uniqid() . '-' . basename($nombreArchivo);
        $rutaCompleta = $carpetaDestino . $nuevoNombreArchivo;

        if (move_uploaded_file($nombreTmpArchivo, $rutaCompleta)) {
            $foto_perfil = 'mods/mod_registro/upload/' . $nuevoNombreArchivo;
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al mover el archivo a la carpeta de destino.']);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'El archivo subido no es una imagen válida.']);
        exit();
    }
}

// Preparar la consulta de actualización
$sql = "UPDATE usuarios SET username = ?, telefono = ?" . ($foto_perfil ? ", foto_perfil = ?" : "") . " WHERE id = ?";
$stmt = $pdo->prepare($sql);

// Ejecutar la consulta
$params = [$username, $telefono];
if ($foto_perfil) {
    $params[] = $foto_perfil;
}
$params[] = $usuario_id;

try {
    $stmt->execute($params);
    echo json_encode(['success' => true, 'message' => 'Perfil actualizado correctamente.']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar el perfil.']);
}
?>
