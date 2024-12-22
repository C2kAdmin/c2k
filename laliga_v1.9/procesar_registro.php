<?php
session_start();
require_once 'connection/connection.php';
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Respuesta inicial
$response = [
    "status" => "error",
    "message" => "Ocurrió un error inesperado."
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir y sanitizar los datos
    $nombre_usuario = trim($_POST['username']);
    $correo = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $telefono = trim($_POST['telefono']);
    $pais = trim($_POST['pais']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $generacion = trim($_POST['generacion']);
    $plataforma = trim($_POST['plataforma']);
    $pos1 = trim($_POST['pos1']);
    $pos2 = trim($_POST['pos2']);
    $pos3 = trim($_POST['pos3']);
    $foto_perfil = $_FILES['foto_perfil'];

    // Validaciones básicas
    if (
        empty($nombre_usuario) || empty($correo) || empty($telefono) || empty($pais) || 
        empty($password) || empty($confirm_password) || empty($generacion) || empty($plataforma) || 
        empty($pos1) || empty($pos2) || empty($pos3)
    ) {
        $response["message"] = "Todos los campos son obligatorios.";
        echo json_encode($response);
        exit;
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $response["message"] = "Correo electrónico inválido.";
        echo json_encode($response);
        exit;
    }

    if ($password !== $confirm_password) {
        $response["message"] = "Las contraseñas no coinciden.";
        echo json_encode($response);
        exit;
    }

    if ($pos1 === $pos2 || $pos1 === $pos3 || $pos2 === $pos3) {
        $response["message"] = "Las posiciones seleccionadas deben ser distintas.";
        echo json_encode($response);
        exit;
    }

    try {
        // Verificar si el correo, nombre de usuario o teléfono ya están registrados
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE correo = :correo OR nombre_usuario = :nombre_usuario OR telefono = :telefono");
        $stmt->execute([
            'correo' => $correo,
            'nombre_usuario' => $nombre_usuario,
            'telefono' => $telefono
        ]);
        if ($stmt->fetch()) {
            $response["message"] = "El correo, nombre de usuario o teléfono ya están registrados.";
            echo json_encode($response);
            exit;
        }

        // Encriptar la contraseña
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Manejo del archivo de imagen
        $ruta_foto = null;
        if ($foto_perfil['error'] === UPLOAD_ERR_OK) {
            $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
            $extension = strtolower(pathinfo($foto_perfil['name'], PATHINFO_EXTENSION));

            if (in_array($extension, $extensiones_permitidas)) {
                $nombre_archivo = uniqid('perfil_') . '.' . $extension;
                $ruta_foto = 'uploads/' . $nombre_archivo;

                if (!move_uploaded_file($foto_perfil['tmp_name'], $ruta_foto)) {
                    $response["message"] = "Error al subir la imagen.";
                    echo json_encode($response);
                    exit;
                }
            } else {
                $response["message"] = "Solo se permiten archivos de imagen: " . implode(', ', $extensiones_permitidas);
                echo json_encode($response);
                exit;
            }
        }

        // Generar token de verificación
        $token = bin2hex(random_bytes(16)); // Token de 32 caracteres

        // Insertar los datos en la base de datos
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre_usuario, correo, telefono, pais, contrasena, generacion, plataforma, pos1, pos2, pos3, imagen_perfil, token_verificacion) VALUES (:nombre_usuario, :correo, :telefono, :pais, :password, :generacion, :plataforma, :pos1, :pos2, :pos3, :imagen_perfil, :token_verificacion)");
        $stmt->execute([
            'nombre_usuario' => $nombre_usuario,
            'correo' => $correo,
            'telefono' => $telefono,
            'pais' => $pais,
            'password' => $password_hash,
            'generacion' => $generacion,
            'plataforma' => $plataforma,
            'pos1' => $pos1,
            'pos2' => $pos2,
            'pos3' => $pos3,
            'imagen_perfil' => $ruta_foto,
            'token_verificacion' => $token,
        ]);

        // Configurar PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'mail.c2k.cl';
            $mail->SMTPAuth = true;
            $mail->Username = 'laliga@c2k.cl';
            $mail->Password = '112233Kdoki.';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('laliga@c2k.cl', 'La Liga');
            $mail->addAddress($correo);
            $mail->isHTML(true);
            $mail->Subject = 'Verifica tu correo electrónico';
            $mail->Body = "<p>Hola <strong>$nombre_usuario</strong>,</p>
                <p>Gracias por registrarte en nuestra plataforma. Por favor, verifica tu correo electrónico haciendo clic en el siguiente enlace:</p>
                <p><a href='https://c2k.cl/laliga_v2.1/verificar_email.php?token=$token'>Verificar mi correo</a></p>
                <p>Si no solicitaste este registro, ignora este mensaje.</p>";

            $mail->send();
            $response["status"] = "success";
            $response["message"] = "Registro exitoso. Por favor, revisa tu correo para verificar tu cuenta.";
        } catch (Exception $e) {
            $response["message"] = "Registro completado, pero no se pudo enviar el correo de verificación. Error: {$mail->ErrorInfo}";
        }
    } catch (PDOException $e) {
        $response["message"] = "Error al registrar al usuario: " . $e->getMessage();
    }
} else {
    $response["message"] = "Método de solicitud no permitido.";
}

echo json_encode($response);
