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
    $correo = filter_var(trim($_POST['correo']), FILTER_SANITIZE_EMAIL);

    if (empty($correo)) {
        $response["message"] = "El campo de correo electrónico es obligatorio.";
        echo json_encode($response);
        exit;
    }

    try {
        // Verificar si el correo existe en la base de datos
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE correo = :correo");
        $stmt->execute(['correo' => $correo]);
        $usuario = $stmt->fetch();

        if (!$usuario) {
            $response["message"] = "El correo electrónico no está registrado.";
            echo json_encode($response);
            exit;
        }

        // Generar un token único y almacenarlo
        $token = bin2hex(random_bytes(16));
        $stmt = $pdo->prepare("
            INSERT INTO recuperaciones (usuario_id, token, created_at) 
            VALUES (:usuario_id, :token, NOW())
        ");
        $stmt->execute([
            'usuario_id' => $usuario['id'],
            'token' => $token
        ]);

        // Configurar PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'mail.c2k.cl'; // Servidor SMTP correcto
            $mail->SMTPAuth = true;
            $mail->Username = 'laliga@c2k.cl'; // Correo del servidor
            $mail->Password = '112233Kdoki.'; // Contraseña del servidor
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Usar SMTPS para el puerto 465
            $mail->Port = 465; // Puerto para SSL/TLS

            // Configuración del correo
            $mail->setFrom('laliga@c2k.cl', 'La Liga');
            $mail->addAddress($correo); // Dirección del destinatario
            $mail->isHTML(true);
            $mail->Subject = '=?UTF-8?B?'.base64_encode('Recuperación de contraseña').'?=';
            $mail->Body = "
                <p>Hola,</p>
                <p>Hemos recibido una solicitud para restablecer tu contraseña.</p>
                <p>Haz clic en el siguiente enlace para crear una nueva contraseña:</p>
                <p><a href='https://c2k.cl/laliga_v2.1/index.php?reset_token=$token'>Restablecer contraseña</a></p>
                <p>Si no solicitaste este cambio, ignora este correo.</p>
            ";

            $mail->send();

            $response["status"] = "success";
            $response["message"] = "Se ha enviado un enlace de recuperación a tu correo.";
        } catch (Exception $e) {
            // Registro de errores de PHPMailer
            error_log("Error al enviar el correo: " . $mail->ErrorInfo);
            $response["message"] = "Error al enviar el correo. Intenta nuevamente más tarde.";
        }
    } catch (Exception $e) {
        // Registro de errores de la base de datos
        error_log("Error al procesar la solicitud: " . $e->getMessage());
        $response["message"] = "Error al procesar la solicitud. Intenta nuevamente más tarde.";
    }
} else {
    $response["message"] = "Método de solicitud no permitido.";
}

// Responder con JSON
echo json_encode($response);