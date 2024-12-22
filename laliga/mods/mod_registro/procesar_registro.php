<?php
// Conexión a la base de datos
$host = 'localhost';
$dbname = 'ckcl_laliga';
$user = 'ckcl_admin';
$pass = '112233Kdoki.';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}

// Procesar formulario de registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $telefono = $_POST['telefono'];
    $plataforma = $_POST['plataforma'];
    $foto_perfil = '';

    // Verificar que las contraseñas coincidan
    if ($password !== $confirm_password) {
        echo json_encode(['success' => false, 'message' => 'Las contraseñas no coinciden.']);
        exit;
    }

    // Verificar que el nombre de usuario no esté ya registrado
    $sql = "SELECT COUNT(*) FROM usuarios WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $usuarioExistente = $stmt->fetchColumn();

    if ($usuarioExistente > 0) {
        echo json_encode(['success' => false, 'message' => 'El nombre de usuario ya está registrado.']);
        exit;
    }

    // Procesar imagen de perfil
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
                echo json_encode(['success' => false, 'message' => 'Error al mover el archivo a la carpeta de destino. Verifica los permisos.']);
                exit;
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'El archivo subido no es una imagen válida.']);
            exit;
        }
    } elseif ($_FILES['foto_perfil']['error'] !== UPLOAD_ERR_NO_FILE) {
        echo json_encode(['success' => false, 'message' => 'Error al subir la imagen.']);
        exit;
    }

    // Insertar en la base de datos
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (username, email, password, telefono, plataforma, foto_perfil) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([$username, $email, $passwordHash, $telefono, $plataforma, $foto_perfil]);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            echo json_encode(['success' => false, 'message' => 'El correo electrónico ya está registrado.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al conectar a la base de datos: ' . $e->getMessage()]);
        }
    }
}
?>
