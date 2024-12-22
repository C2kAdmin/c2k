<?php
include "../../../utilidades/phpmailer/class.phpmailer.php";
include "../../../utilidades/phpmailer/class.smtp.php";

if (
    empty($_POST['name']) ||
    empty($_POST['email']) ||
    empty($_POST['message']) ||
    !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
) {
    echo "No arguments Provided!";
    return false;
}

$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];
$phone = $_POST['phone'];

$email_user = "info@millaestructuras.cl";
$email_password = "Admin906090.";
$the_subject = "Contacto desde la web";
$address_to = "info@millaestructuras.cl";
$from_name = $name;
$phpmailer = new PHPMailer();

$phpmailer->Username = $email_user;
$phpmailer->Password = $email_password;
$phpmailer->SMTPSecure = 'ssl';
$phpmailer->Host = "mail.millaestructuras.cl";
$phpmailer->Port = 465;
$phpmailer->IsSMTP();
$phpmailer->SMTPAuth = true;

$phpmailer->setFrom($phpmailer->Username, $from_name);
$phpmailer->AddAddress($address_to);

$phpmailer->From = $email_address;
$phpmailer->Subject = $the_subject;
$phpmailer->Body .= "<h2 style='color:#3498db;'><i>" . $name . "</i></h2>";
$phpmailer->Body .= "<p>" . $message . "</p>";
$phpmailer->Body .= "<p>_____________________________________</p>";
$phpmailer->Body .= "<p>Contacto: " . $phone . "</p>";
$phpmailer->IsHTML(true);

if (!$phpmailer->Send()) {
    echo "Mailer Error: " . $phpmailer->ErrorInfo;
} else {
    echo "Message sent!";
}
?>
