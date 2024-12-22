<?php
// Conexión a la base de datos
require_once '../db.php'; // Ajusta la ruta si db.php está en otra carpeta

$response = [
    "success" => false,
    "message" => "Error desconocido."
];

try {
    // Obtener datos del formulario
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $pais = trim($_POST['pais']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validaciones del servidor
    if (empty($username) || empty($email) || empty($telefono) || empty($pais) || empty($password) || empty($confirm_password)) {
        $response["message"] = "Todos los campos son obligatorios.";
        echo json_encode($response);
        exit;
    }

    if ($password !== $confirm_password) {
        $response["message"] = "Las contraseñas no coinciden.";
        echo json_encode($response);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["message"] = "El correo electrónico no es válido.";
        echo json_encode($response);
        exit;
    }

    // Verificar duplicados en la base de datos
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE username = :username OR email = :email OR telefono = :telefono");
    $stmt->execute([
        'username' => $username,
        'email' => $email,
        'telefono' => $telefono
    ]);

    if ($stmt->fetch()) {
        $response["message"] = "El nombre de usuario, correo electrónico o teléfono ya está registrado.";
        echo json_encode($response);
        exit;
    }

    // Hash de la contraseña
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Insertar el usuario en la base de datos
    $stmt = $pdo->prepare("INSERT INTO usuarios (username, email, telefono, pais, password, email_verified, created_at, token_verificacion) 
                           VALUES (:username, :email, :telefono, :pais, :password, 0, NOW(), :token)");
    $token = bin2hex(random_bytes(32)); // Token único para verificación de correo

    $stmt->execute([
        'username' => $username,
        'email' => $email,
        'telefono' => $telefono,
        'pais' => $pais,
        'password' => $password_hash,
        'token' => $token
    ]);

    // Enviar respuesta de éxito
    $response["success"] = true;
    $response["message"] = "Usuario registrado con éxito. Verifica tu correo.";
    echo json_encode($response);

    // Opcional: Enviar correo de verificación aquí usando PHPMailer

} catch (Exception $e) {
    $response["message"] = "Error: " . $e->getMessage();
    echo json_encode($response);
}
?>
