<?php
session_start();

// Conexión a la base de datos
$host = 'localhost';
$dbname = 'ckcl_laliga';
$user = 'ckcl_admin';
$pass = '112233Kdoki.';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['success' => false, 'message' => 'Error al conectar a la base de datos: ' . $e->getMessage()]));
}

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    die(json_encode(['success' => false, 'message' => 'No estás autorizado para realizar esta acción.']));
}

// Obtener el id del usuario autenticado
$usuarioId = $_SESSION['usuario_id'];

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $telefono = $_POST['telefono'];
    $pais = $_POST['pais'];
    $foto_perfil = '';

    // Procesar imagen de perfil si se sube una nueva
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
                die(json_encode(['success' => false, 'message' => 'Error al mover el archivo de la imagen.']));
            }
        } else {
            die(json_encode(['success' => false, 'message' => 'El archivo subido no es una imagen válida.']));
        }
    }

    // Actualizar la información del perfil en la base de datos
    $sql = "UPDATE usuarios SET username = ?, telefono = ?, pais = ?" . ($foto_perfil ? ", foto_perfil = ?" : "") . " WHERE id = ?";
    $params = [$username, $telefono, $pais];
    
    if ($foto_perfil) {
        $params[] = $foto_perfil;
    }
    
    $params[] = $usuarioId;

    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute($params);
        $respuesta = ['success' => true, 'username' => $username];

        if ($foto_perfil) {
            $respuesta['foto_perfil'] = $foto_perfil;
        }

        echo json_encode($respuesta);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el perfil: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>
