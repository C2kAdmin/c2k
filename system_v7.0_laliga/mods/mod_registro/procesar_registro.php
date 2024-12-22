<?php
require '/home/ckcl/public_html/system_v7.0_laliga/connection/connection.php';

$response = [];
try {
    // Obtener datos enviados desde el formulario
    $username = $_POST['user_input'] ?? null;
    $email = $_POST['email'] ?? null;
    $telefono = $_POST['telefono'] ?? null;
    $pais = $_POST['pais'] ?? 'Chile'; // Valor por defecto
    $password = $_POST['password'] ?? null;
    $generacion = $_POST['generacion'] ?? null;
    $plataforma = $_POST['plataforma'] ?? null;
    $pos1 = $_POST['pos1'] ?? null;
    $pos2 = $_POST['pos2'] ?? null;
    $pos3 = $_POST['pos3'] ?? null;

    // Validar que todos los campos requeridos estén completos
    if (!$username || !$email || !$telefono || !$password || !$generacion || !$plataforma || !$pos1 || !$pos2 || !$pos3) {
        throw new Exception('Todos los campos obligatorios deben estar completos.');
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $token_verificacion = bin2hex(random_bytes(32));

    // Insertar datos en la base de datos
    $stmt = $pdo->prepare("INSERT INTO usuarios (username, email, telefono, pais, generacion, plataforma, pos1, pos2, pos3, password, email_verified, token_verificacion) VALUES (:username, :email, :telefono, :pais, :generacion, :plataforma, :pos1, :pos2, :pos3, :password, 0, :token)");
    $stmt->execute([
        'username' => $username,
        'email' => $email,
        'telefono' => $telefono,
        'pais' => $pais,
        'generacion' => $generacion,
        'plataforma' => $plataforma,
        'pos1' => $pos1,
        'pos2' => $pos2,
        'pos3' => $pos3,
        'password' => $hashed_password,
        'token' => $token_verificacion
    ]);

    // Respuesta de éxito
    $response['status'] = 'success';
    $response['message'] = 'Usuario registrado exitosamente.';
    $response['username'] = $username;
    $response['email'] = $email;
    $response['token'] = $token_verificacion;
} catch (Exception $e) {
    $response['status'] = 'error';
    $response['message'] = $e->getMessage();
}

// Mostrar la respuesta para confirmar
header('Content-Type: application/json');
echo json_encode($response);
?>
