<?php
require_once '../../connection/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $plataforma = $_POST['plataforma'];
    $fotoPerfil = null;

    if (!empty($_FILES['foto_perfil']['name'])) {
        $uploadDir = '../../user_imgs/';
        $uploadFile = $uploadDir . basename($_FILES['foto_perfil']['name']);

        if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $uploadFile)) {
            $fotoPerfil = 'user_imgs/' . basename($_FILES['foto_perfil']['name']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error al subir la imagen.']);
            exit;
        }
    }

    try {
        $stmt = $conn->prepare("INSERT INTO usuarios (username, email, telefono, password, plataforma, foto_perfil) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$username, $email, $telefono, $password, $plataforma, $fotoPerfil]);
        echo json_encode(['success' => true, 'message' => 'Registro exitoso.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
}
?>
