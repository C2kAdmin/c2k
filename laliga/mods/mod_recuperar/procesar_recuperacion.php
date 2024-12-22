<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer-master/src/Exception.php';
require '../../PHPMailer-master/src/PHPMailer.php';
require '../../PHPMailer-master/src/SMTP.php';

// Configuración de la conexión a la base de datos
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

// Procesar el formulario de recuperación de contraseña
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Verificar si el correo electrónico está registrado
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario) {
        // Crear un token para la recuperación
        $token = bin2hex(random_bytes(16));
        $token_expira = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Guardar el token en la base de datos
        $sql = "INSERT INTO recuperaciones (email, token, expira) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $token, $token_expira]);

        // Enviar correo con el enlace de recuperación
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'mail.c2k.cl';  // Servidor de correo saliente (SMTP)
            $mail->SMTPAuth = true;
            $mail->Username = 'laliga@c2k.cl'; // Tu dirección de correo
            $mail->Password = '112233Kdoki.'; // La contraseña del correo
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Seguridad SSL/TLS
            $mail->Port = 465; // Puerto de salida según la configuración

            // Remitente y destinatario
            $mail->setFrom('laliga@c2k.cl', 'Liga FC25');
            $mail->addAddress($email);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de contraseña - Liga FC25';
            $mail->Body = "Hola, has solicitado restablecer tu contraseña. Haz clic en el siguiente enlace para restablecerla: <br><br>
                           <a href='https://c2k.cl/laliga/mods/mod_recuperar/restablecer_contrase%C3%B1a.php?token=$token'>Restablecer Contraseña</a><br><br>
                           Este enlace expirará en una hora.";

            $mail->send();
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Error al enviar el correo electrónico. Inténtalo de nuevo más tarde.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'El correo electrónico no está registrado.']);
    }
}
?>
