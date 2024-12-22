<?php
require '../../utilidades/phpmailer/class.phpmailer.php';
require '../../utilidades/phpmailer/class.smtp.php';

// Check for empty fields
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['message']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "message" => "No arguments Provided!"]);
    return false;
}

$name = $_POST['name'];
$email_address = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// Create the email and send the message
$email_user = "admin@c2k.cl";
$email_password = "1973906090Kdoki";
$the_subject = "Contacto desde la web";
$address_to = "info@c2k.cl";
$from_name = $name;
$phpmailer = new PHPMailer();

// Datos de la cuenta de Gmail
$phpmailer->Username = $email_user;
$phpmailer->Password = $email_password; 
$phpmailer->SMTPSecure = 'ssl';
$phpmailer->Host = "mail.c2k.cl";
$phpmailer->Port = 465;
$phpmailer->IsSMTP();
$phpmailer->SMTPAuth = true;

$phpmailer->setFrom($phpmailer->Username, $from_name);
$phpmailer->AddAddress($address_to);

$phpmailer->From = $email_address;
$phpmailer->Subject = $the_subject;

// Asegurarse de que el contenido sea UTF-8
$phpmailer->CharSet = 'UTF-8';
$phpmailer->Encoding = 'base64';

// Formato del mensaje con márgenes y ajustes
$phpmailer->Body = "<div style='padding: 20px; font-family: Arial, sans-serif;'>
                        <h2 style='color:#3498db; font-style: italic;'>Contacto desde la web</h2>
                        <p style='margin-bottom: 5px;'><strong style='color: #3498db;'>Nombre:</strong> <em>".$name."</em></p>
                        <p style='margin-bottom: 5px;'><strong style='color: #3498db;'>Email:</strong> <em>".$email_address."</em></p>
                        <p style='margin-bottom: 20px;'><strong style='color: #3498db;'>Teléfono:</strong> <em>".$phone."</em></p>
                        <p style='margin-left: 40px; margin-bottom: 5px;'><strong style='color: #3498db;'>Mensaje:</strong></p>
                        <p style='margin-left: 40px;'><em>".$message."</em></p>
                    </div>";
$phpmailer->IsHTML(true);

if($phpmailer->Send()) {
    echo json_encode(["status" => "success", "message" => "Mensaje enviado satisfactoriamente."]);
} else {
    echo json_encode(["status" => "error", "message" => "Hubo un problema al enviar el mensaje. Por favor, intente nuevamente."]);
}
?>
